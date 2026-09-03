<?php

declare(strict_types=1);

namespace App\Security;

use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;
use PDO;
use RuntimeException;
use Throwable;

final class ContactRateLimiter
{
    private const DATE_FORMAT = 'Y-m-d H:i:s.u';
    private const DEFAULT_RETENTION_SECONDS = 172800;

    private PDO $pdo;
    private string $pepper;
    private int $maxAttempts;
    private int $windowSeconds;
    private int $blockSeconds;
    private string $route;

    public function __construct(
        PDO $pdo,
        string $pepper,
        int $maxAttempts,
        int $windowSeconds,
        int $blockSeconds,
        string $route = 'contact'
    ) {
        $pepper = trim($pepper);
        $route = trim($route);

        if (strlen($pepper) < 32) {
            throw new InvalidArgumentException(
                'The rate-limit pepper must contain at least 32 characters.'
            );
        }

        if ($maxAttempts < 1 || $maxAttempts > 65534) {
            throw new InvalidArgumentException(
                'The maximum attempt count is invalid.'
            );
        }

        if ($windowSeconds < 1 || $blockSeconds < 1) {
            throw new InvalidArgumentException(
                'Rate-limit durations must be positive.'
            );
        }

        if (
            preg_match(
                '/^[a-z0-9][a-z0-9._-]{0,99}$/',
                $route
            ) !== 1
        ) {
            throw new InvalidArgumentException(
                'The rate-limit route is invalid.'
            );
        }

        $this->pdo = $pdo;
        $this->pepper = $pepper;
        $this->maxAttempts = $maxAttempts;
        $this->windowSeconds = $windowSeconds;
        $this->blockSeconds = $blockSeconds;
        $this->route = $route;
    }

    /**
     * Enregistre une tentative.
     *
     * @return int 0 si la requête est autorisée, sinon le nombre
     *             de secondes restant avant une nouvelle tentative.
     */
    public function consume(string $clientIp): int
    {
        $canonicalIp = self::normalizeIp($clientIp);

        if ($canonicalIp === null) {
            throw new InvalidArgumentException(
                'The client IP address is invalid.'
            );
        }

        /*
         * La route est intégrée au HMAC pour empêcher la corrélation
         * directe d'un même visiteur entre plusieurs endpoints.
         */
        $keyHash = hash_hmac(
            'sha256',
            $this->route . "\0" . $canonicalIp,
            $this->pepper
        );

        $now = new DateTimeImmutable(
            'now',
            new DateTimeZone('UTC')
        );

        if ($this->pdo->inTransaction()) {
            throw new RuntimeException(
                'The rate limiter cannot use an existing transaction.'
            );
        }

        /*
 * L’upsert est volontairement effectué avant la transaction.
 *
 * Il crée la ligne si nécessaire ou rafraîchit updated_at
 * lorsqu’elle existe. Son autocommit libère immédiatement
 * le verrou et empêche le nettoyage de supprimer une ligne
 * qu’une tentative vient de réactiver.
 */
        $this->ensureRowExists($keyHash, $now);

        try {
            $this->pdo->beginTransaction();

            /*
     * À partir d’ici, chaque worker verrouille la même ligne.
     * Les workers suivants attendent le commit précédent,
     * puis lisent le compteur mis à jour.
     */
            $row = $this->lockRow($keyHash);

            $windowStartedAt = $this->parseDate(
                $row['window_started_at'] ?? null
            );

            $blockedUntil = $this->parseNullableDate(
                $row['blocked_until'] ?? null
            );

            $attemptCount = (int) (
                $row['attempt_count'] ?? -1
            );

            if ($attemptCount < 0) {
                throw new RuntimeException(
                    'The stored attempt count is invalid.'
                );
            }

            if ($blockedUntil !== null && $blockedUntil > $now) {
                $retryAfter = max(
                    1,
                    $blockedUntil->getTimestamp()
                        - $now->getTimestamp()
                );

                $this->pdo->commit();

                return $retryAfter;
            }

            $windowEndsAt = $windowStartedAt->modify(
                sprintf('+%d seconds', $this->windowSeconds)
            );

            /*
             * Une fenêtre expirée ou un ancien blocage terminé
             * démarre une nouvelle fenêtre avec la tentative actuelle.
             */
            if (
                $blockedUntil !== null
                || $now >= $windowEndsAt
            ) {
                $this->updateRow(
                    $keyHash,
                    $now,
                    1,
                    null,
                    $now
                );

                $this->pdo->commit();

                return 0;
            }

            $attemptCount++;

            /*
             * Les cinq premières tentatives sont autorisées.
             * La sixième crée le blocage.
             */
            if ($attemptCount > $this->maxAttempts) {
                $blockedUntil = $now->modify(
                    sprintf('+%d seconds', $this->blockSeconds)
                );

                $this->updateRow(
                    $keyHash,
                    $windowStartedAt,
                    $attemptCount,
                    $blockedUntil,
                    $now
                );

                $this->pdo->commit();

                return $this->blockSeconds;
            }

            $this->updateRow(
                $keyHash,
                $windowStartedAt,
                $attemptCount,
                null,
                $now
            );

            $this->pdo->commit();

            return 0;
        } catch (Throwable $exception) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            throw $exception;
        }
    }

    /**
     * Supprime un nombre borné de compteurs devenus inutiles.
     *
     * @return int Nombre de lignes supprimées.
     */
    public function cleanupExpired(
        int $retentionSeconds = self::DEFAULT_RETENTION_SECONDS
    ): int {
        $minimumRetention = max(
            $this->windowSeconds,
            $this->blockSeconds
        );

        if ($retentionSeconds < $minimumRetention) {
            throw new InvalidArgumentException(
                'The retention duration is too short.'
            );
        }

        if ($this->pdo->inTransaction()) {
            throw new RuntimeException(
                'Cleanup cannot use an existing transaction.'
            );
        }

        $now = new DateTimeImmutable(
            'now',
            new DateTimeZone('UTC')
        );

        $cutoff = $now->modify(
            sprintf('-%d seconds', $retentionSeconds)
        );

        $statement = $this->pdo->prepare(
            <<<'SQL'
            DELETE FROM contact_rate_limits
            WHERE route = :route
              AND updated_at < :cutoff
              AND (
                  blocked_until IS NULL
                  OR blocked_until <= :now
              )
            ORDER BY updated_at ASC
            LIMIT 100
        SQL
        );

        $statement->execute([
            'route' => $this->route,
            'cutoff' => self::formatDate($cutoff),
            'now' => self::formatDate($now),
        ]);

        return $statement->rowCount();
    }

    private function ensureRowExists(
        string $keyHash,
        DateTimeImmutable $now
    ): void {
        $statement = $this->pdo->prepare(
            <<<'SQL'
                INSERT INTO contact_rate_limits (
                    route,
                    key_hash,
                    window_started_at,
                    attempt_count,
                    blocked_until,
                    updated_at
                ) VALUES (
                    :route,
                    :key_hash,
                    :window_started_at,
                    0,
                    NULL,
                    :inserted_updated_at
                )
                ON DUPLICATE KEY UPDATE
                    updated_at = :existing_updated_at
            SQL
        );

        $formattedNow = self::formatDate($now);

        $statement->execute([
            'route' => $this->route,
            'key_hash' => $keyHash,
            'window_started_at' => $formattedNow,
            'inserted_updated_at' => $formattedNow,
            'existing_updated_at' => $formattedNow,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function lockRow(string $keyHash): array
    {
        $statement = $this->pdo->prepare(
            <<<'SQL'
                SELECT
                    window_started_at,
                    attempt_count,
                    blocked_until
                FROM contact_rate_limits
                WHERE route = :route
                  AND key_hash = :key_hash
                FOR UPDATE
            SQL
        );

        $statement->execute([
            'route' => $this->route,
            'key_hash' => $keyHash,
        ]);

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!is_array($row)) {
            throw new RuntimeException(
                'The rate-limit row could not be loaded.'
            );
        }

        return $row;
    }

    private function updateRow(
        string $keyHash,
        DateTimeImmutable $windowStartedAt,
        int $attemptCount,
        ?DateTimeImmutable $blockedUntil,
        DateTimeImmutable $updatedAt
    ): void {
        $statement = $this->pdo->prepare(
            <<<'SQL'
                UPDATE contact_rate_limits
                SET window_started_at = :window_started_at,
                    attempt_count = :attempt_count,
                    blocked_until = :blocked_until,
                    updated_at = :updated_at
                WHERE route = :route
                  AND key_hash = :key_hash
            SQL
        );

        $statement->execute([
            'window_started_at' =>
                self::formatDate($windowStartedAt),
            'attempt_count' => $attemptCount,
            'blocked_until' => $blockedUntil !== null
                ? self::formatDate($blockedUntil)
                : null,
            'updated_at' => self::formatDate($updatedAt),
            'route' => $this->route,
            'key_hash' => $keyHash,
        ]);

        if ($statement->rowCount() !== 1) {
            throw new RuntimeException(
                'The rate-limit row could not be updated.'
            );
        }
    }

    private function parseDate(mixed $value): DateTimeImmutable
    {
        if (!is_string($value)) {
            throw new RuntimeException(
                'The stored rate-limit date is invalid.'
            );
        }

        $date = DateTimeImmutable::createFromFormat(
            self::DATE_FORMAT,
            $value,
            new DateTimeZone('UTC')
        );

        if (!$date instanceof DateTimeImmutable) {
            throw new RuntimeException(
                'The stored rate-limit date could not be parsed.'
            );
        }

        return $date;
    }

    private function parseNullableDate(
        mixed $value
    ): ?DateTimeImmutable {
        if ($value === null) {
            return null;
        }

        return $this->parseDate($value);
    }

    private static function formatDate(
        DateTimeImmutable $date
    ): string {
        return $date->format(self::DATE_FORMAT);
    }

    private static function normalizeIp(
        mixed $address
    ): ?string {
        if (!is_string($address)) {
            return null;
        }

        $address = trim($address);

        if (
            $address === ''
            || filter_var(
                $address,
                FILTER_VALIDATE_IP
            ) === false
        ) {
            return null;
        }

        $packedAddress = inet_pton($address);

        if ($packedAddress === false) {
            return null;
        }

        $normalizedAddress = inet_ntop($packedAddress);

        return is_string($normalizedAddress)
            ? $normalizedAddress
            : null;
    }
}

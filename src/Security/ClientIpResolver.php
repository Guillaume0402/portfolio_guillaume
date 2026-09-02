<?php

declare(strict_types=1);

namespace App\Security;

use InvalidArgumentException;

final class ClientIpResolver
{
    /**
     * Réseaux ou adresses des reverse proxies autorisés.
     *
     * @var list<array{packed: string, prefix: int}>
     */
    private array $trustedProxyNetworks;

    public function __construct(array $trustedProxySources = [])
    {
        $networks = [];

        foreach ($trustedProxySources as $source) {
            $network = self::parseTrustedNetwork($source);

            if ($network === null) {
                throw new InvalidArgumentException(
                    'A trusted proxy address or network is invalid.'
                );
            }

            $key = bin2hex($network['packed'])
                . '/'
                . $network['prefix'];

            $networks[$key] = $network;
        }

        $this->trustedProxyNetworks = array_values($networks);
    }

    public function resolve(array $server): ?string
    {
        $remoteAddress = self::normalizeIp(
            $server['REMOTE_ADDR'] ?? null
        );

        if ($remoteAddress === null) {
            return null;
        }

        /*
         * Hors proxy approuvé, les en-têtes envoyés par le client
         * sont ignorés.
         */
        if (!$this->isTrustedProxy($remoteAddress)) {
            return $remoteAddress;
        }

        $forwardedFor = $server['HTTP_X_FORWARDED_FOR'] ?? null;

        if (!is_string($forwardedFor) || trim($forwardedFor) === '') {
            return $remoteAddress;
        }

        $forwardedAddresses = [];

        foreach (explode(',', $forwardedFor) as $address) {
            $normalizedAddress = self::normalizeIp($address);

            /*
             * Une chaîne partiellement invalide est ambiguë.
             * On revient à l’adresse directe du proxy.
             */
            if ($normalizedAddress === null) {
                return $remoteAddress;
            }

            $forwardedAddresses[] = $normalizedAddress;
        }

        /*
         * Parcours de droite à gauche :
         * les proxies approuvés sont ignorés jusqu’au premier
         * intermédiaire non approuvé, considéré comme le client.
         */
        for (
            $index = count($forwardedAddresses) - 1;
            $index >= 0;
            $index--
        ) {
            $address = $forwardedAddresses[$index];

            if (!$this->isTrustedProxy($address)) {
                return $address;
            }
        }

        return $forwardedAddresses[0] ?? $remoteAddress;
    }

    private function isTrustedProxy(string $address): bool
    {
        $packedAddress = inet_pton($address);

        if ($packedAddress === false) {
            return false;
        }

        foreach ($this->trustedProxyNetworks as $network) {
            if (
                self::networkContains(
                    $packedAddress,
                    $network['packed'],
                    $network['prefix']
                )
            ) {
                return true;
            }
        }

        return false;
    }

    private static function networkContains(
        string $packedAddress,
        string $packedNetwork,
        int $prefix
    ): bool {
        if (strlen($packedAddress) !== strlen($packedNetwork)) {
            return false;
        }

        $fullBytes = intdiv($prefix, 8);
        $remainingBits = $prefix % 8;

        if (
            substr($packedAddress, 0, $fullBytes)
            !== substr($packedNetwork, 0, $fullBytes)
        ) {
            return false;
        }

        if ($remainingBits === 0) {
            return true;
        }

        $mask = (0xFF << (8 - $remainingBits)) & 0xFF;

        return (
            ord($packedAddress[$fullBytes]) & $mask
        ) === (
            ord($packedNetwork[$fullBytes]) & $mask
        );
    }

    /**
     * @return array{packed: string, prefix: int}|null
     */
    private static function parseTrustedNetwork(
        mixed $source
    ): ?array {
        if (!is_string($source)) {
            return null;
        }

        $source = trim($source);

        if ($source === '') {
            return null;
        }

        $parts = explode('/', $source);

        if (count($parts) > 2) {
            return null;
        }

        $normalizedAddress = self::normalizeIp($parts[0] ?? null);

        if ($normalizedAddress === null) {
            return null;
        }

        $packedAddress = inet_pton($normalizedAddress);

        if ($packedAddress === false) {
            return null;
        }

        $maximumPrefix = strlen($packedAddress) * 8;

        if (count($parts) === 1) {
            return [
                'packed' => $packedAddress,
                'prefix' => $maximumPrefix,
            ];
        }

        $prefixText = trim($parts[1]);

        if (
            $prefixText === ''
            || preg_match('/^\d{1,3}$/', $prefixText) !== 1
        ) {
            return null;
        }

        $prefix = (int) $prefixText;

        /*
         * /0 ferait confiance à tout Internet et n’est donc
         * volontairement pas accepté.
         */
        if ($prefix < 1 || $prefix > $maximumPrefix) {
            return null;
        }

        return [
            'packed' => $packedAddress,
            'prefix' => $prefix,
        ];
    }

    private static function normalizeIp(mixed $address): ?string
    {
        if (!is_string($address)) {
            return null;
        }

        $address = trim($address);

        if (
            $address === ''
            || filter_var($address, FILTER_VALIDATE_IP) === false
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

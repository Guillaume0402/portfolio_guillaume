<?php

declare(strict_types=1);

namespace App\Security;

final class ClientIpResolver
{
    /**
     * Adresses IP des reverse proxies autorisés à transmettre
     * l'adresse réelle du visiteur.
     *
     * @var list<string>
     */
    private array $trustedProxyAddresses;

    public function __construct(array $trustedProxyAddresses = [])
    {
        $normalizedAddresses = [];

        foreach ($trustedProxyAddresses as $address) {
            $normalizedAddress = self::normalizeIp($address);

            if ($normalizedAddress !== null) {
                $normalizedAddresses[$normalizedAddress] = true;
            }
        }

        $this->trustedProxyAddresses = array_keys($normalizedAddresses);
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
         * Si la requête ne vient pas d'un proxy approuvé,
         * les en-têtes transmis par le client sont ignorés.
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
             * On revient alors à l'adresse directe du proxy.
             */
            if ($normalizedAddress === null) {
                return $remoteAddress;
            }

            $forwardedAddresses[] = $normalizedAddress;
        }

        /*
         * La chaîne est parcourue de droite à gauche.
         * On retourne le premier intermédiaire non approuvé :
         * il correspond au client vu par le dernier proxy fiable.
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
        return in_array(
            $address,
            $this->trustedProxyAddresses,
            true
        );
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
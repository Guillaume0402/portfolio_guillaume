<?php

declare(strict_types=1);

namespace App\Security;

use JsonException;

final class TurnstileVerifier
{
    private const ENDPOINT =
        'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    private const MAX_TOKEN_LENGTH = 2048;

    private string $secretKey;
    private array $allowedHostnames;
    private string $expectedAction;

    public function __construct(
        string $secretKey,
        array $allowedHostnames,
        string $expectedAction = 'contact'
    ) {
        $this->secretKey = trim($secretKey);

        $this->allowedHostnames = array_values(array_unique(array_filter(
            array_map(
                static fn (mixed $hostname): string =>
                    is_string($hostname) ? strtolower(trim($hostname)) : '',
                $allowedHostnames
            )
        )));

        $this->expectedAction = trim($expectedAction);
    }

    public function verify(mixed $token, ?string $remoteIp = null): bool
    {
        if (!is_string($token)) {
            return false;
        }

        $token = trim($token);

        if (
            $token === ''
            || strlen($token) > self::MAX_TOKEN_LENGTH
            || $this->secretKey === ''
            || $this->allowedHostnames === []
            || $this->expectedAction === ''
        ) {
            return false;
        }

        $payload = [
            'secret' => $this->secretKey,
            'response' => $token,
        ];

        if ($remoteIp !== null) {
            if (filter_var($remoteIp, FILTER_VALIDATE_IP) === false) {
                return false;
            }

            $payload['remoteip'] = $remoteIp;
        }

        $curl = curl_init(self::ENDPOINT);

        if ($curl === false) {
            return false;
        }

        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(
                $payload,
                '',
                '&',
                PHP_QUERY_RFC3986
            ),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json',
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ]);

        $responseBody = curl_exec($curl);
        $curlError = curl_errno($curl);
        $httpStatus = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);


        if (
            $responseBody === false
            || $curlError !== CURLE_OK
            || $httpStatus !== 200
        ) {
            error_log(sprintf(
                'Turnstile request failed (curl=%d, http=%d)',
                $curlError,
                $httpStatus
            ));

            return false;
        }

        try {
            $response = json_decode(
                $responseBody,
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            error_log('Turnstile returned invalid JSON');

            return false;
        }

        if (!is_array($response) || ($response['success'] ?? false) !== true) {
            return false;
        }

        $hostname = $response['hostname'] ?? null;
        $action = $response['action'] ?? null;

        return is_string($hostname)
            && in_array(strtolower($hostname), $this->allowedHostnames, true)
            && is_string($action)
            && $action === $this->expectedAction;
    }
}
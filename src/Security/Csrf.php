<?php

namespace App\Security;

// Gestion des tokens CSRF (Cross-Site Request Forgery)
final class Csrf
{
    // Génère ou retourne le token CSRF stocké en session
    public static function token(): string
    {
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf'];
    }

    // Vérifie si le token CSRF fourni correspond à celui stocké en session
    public static function check(mixed $token): bool
    {
        $sessionToken = $_SESSION['csrf'] ?? null;

        if (!is_string($token) || !is_string($sessionToken) || $sessionToken === '') {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }

    public static function regenerate(): string
    {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));

        return $_SESSION['csrf'];
    }
}

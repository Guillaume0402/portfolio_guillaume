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
    public static function check(?string $t): bool
    {
        if (!is_string($t) || empty($_SESSION['csrf']) || !is_string($_SESSION['csrf'])) {
            return false;
        }

        return hash_equals($_SESSION['csrf'], $t);
    }
}

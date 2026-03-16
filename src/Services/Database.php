<?php

declare(strict_types=1);

namespace App\Services;

use PDO;
use RuntimeException;

final class Database
{
    private static ?PDO $pdo = null;

    private static function envOrFail(string $key): string
    {
        $value = $_ENV[$key] ?? getenv($key);

        if ($value === false || $value === null || $value === '') {
            throw new RuntimeException("Missing env var: {$key}");
        }

        return $value;
    }

    public static function getConnection(): PDO
    {
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        $host = self::envOrFail('DB_HOST');
        $port = self::envOrFail('DB_PORT');
        $name = self::envOrFail('DB_NAME');
        $user = self::envOrFail('DB_USER');
        $password = self::envOrFail('DB_PASSWORD');

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $host,
            $port,
            $name
        );

        self::$pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        return self::$pdo;
    }
}
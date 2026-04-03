<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/services/db.php';

try {
    $pdo = db();

    echo '<h1>Connexion OK</h1>';
    echo '<pre>';
    echo 'Driver : ' . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . PHP_EOL;
    echo 'Version serveur : ' . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . PHP_EOL;
    echo '</pre>';
} catch (Throwable $e) {
    echo '<h1>Connexion KO</h1>';
    echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
}
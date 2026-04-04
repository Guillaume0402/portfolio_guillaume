<?php
declare(strict_types=1);

use App\Http\Router;
use App\Controllers\ErrorController;
use Throwable;


require_once __DIR__ . '/../vendor/autoload.php';

define('ROOT', dirname(__DIR__));

$appEnv = getenv('APP_ENV') ?: 'dev';
$isProd = $appEnv === 'prod';

error_reporting(E_ALL);
ini_set('display_errors', $isProd ? '0' : '1');
ini_set('display_startup_errors', $isProd ? '0' : '1');
ini_set('log_errors', '1');

$logDir = ROOT . '/var/log';
if (!is_dir($logDir)) {
    mkdir($logDir, 0775, true);
}
ini_set('error_log', $logDir . '/php-error.log');

session_start();

$router = new Router();

require ROOT . '/routes/web.php';

set_exception_handler(function (Throwable $e): void {
    error_log((string) $e);
    echo (new ErrorController())->serverError($e);
});

register_shutdown_function(function (): void {
    $error = error_get_last();
    if ($error === null) {
        return;
    }

    $fatalTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR];
    if (!in_array($error['type'] ?? 0, $fatalTypes, true)) {
        return;
    }

    error_log('Fatal error: ' . print_r($error, true));
    echo (new ErrorController())->serverError();
});

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$router->dispatch($uri, $_SERVER['REQUEST_METHOD']);

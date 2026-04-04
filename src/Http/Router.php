<?php

namespace App\Http;

use App\Controllers\ErrorController;
use Throwable;

final class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$this->normalize($path)] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$this->normalize($path)] = $handler;
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';
        $path = $this->normalize($path);
        $method = strtoupper($method);

        $methodRoutes = $this->routes[$method] ?? [];
        $handler = $methodRoutes[$path] ?? null;

        $errorController = new ErrorController();

        if (!$handler) {
            echo $errorController->notFound();
            return;
        }

        [$controllerClass, $action] = $handler;

        if (!class_exists($controllerClass)) {
            echo $errorController->serverError();
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            echo $errorController->serverError();
            return;
        }

        try {
            echo (string) $controller->$action();
        } catch (Throwable $e) {
            echo $errorController->serverError($e);
        }
    }

    private function normalize(string $path): string
    {
        $path = '/' . trim($path, '/');
        return $path === '/' ? '/' : $path;
    }
}

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
        $isHead = $method === 'HEAD';

        if ($isHead) {
            $method = 'GET';
        }

        $methodRoutes = $this->routes[$method] ?? [];
        $handler = $methodRoutes[$path] ?? null;

        $errorController = new ErrorController();

        if (!$handler) {
            $response = $errorController->notFound();
            if (!$isHead) {
                echo $response;
            }
            return;
        }

        [$controllerClass, $action] = $handler;

        if (!class_exists($controllerClass)) {
            $response = $errorController->serverError();
            if (!$isHead) {
                echo $response;
            }
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            $response = $errorController->serverError();
            if (!$isHead) {
                echo $response;
            }
            return;
        }

        try {
            $response = (string) $controller->$action();
            if (!$isHead) {
                echo $response;
            }
        } catch (Throwable $e) {
            $response = $errorController->serverError($e);
            if (!$isHead) {
                echo $response;
            }
        }
    }

    private function normalize(string $path): string
    {
        $path = '/' . trim($path, '/');
        return $path === '/' ? '/' : $path;
    }
}

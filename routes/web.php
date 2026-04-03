<?php

use App\Controllers\HomeController;
use App\Controllers\ContactController;

/** @var \App\Core\Router $router */

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact/submit', [ContactController::class, 'submit']);

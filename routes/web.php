<?php

use App\Controllers\HomeController;
use App\Controllers\ContactController;

/** @var \App\Http\Router $router */

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/portfolio', [HomeController::class, 'portfolio']);
$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact/submit', [ContactController::class, 'submit']);

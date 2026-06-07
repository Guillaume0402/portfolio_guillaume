<?php

use App\Controllers\HomeController;
use App\Controllers\ContactController;
use App\Controllers\LegalController;

/** @var \App\Http\Router $router */

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/portfolio', [HomeController::class, 'portfolio']);
$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact/submit', [ContactController::class, 'submit']);
$router->get('/mentions-legales', [LegalController::class, 'legalNotice']);
$router->get('/confidentialite', [LegalController::class, 'privacy']);
$router->get('/cookies', [LegalController::class, 'cookies']);
$router->get('/cgv', [LegalController::class, 'terms']);

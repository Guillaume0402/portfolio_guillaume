<?php

namespace App\Controllers;

use App\Http\AbstractController;
use Throwable;

final class ErrorController extends AbstractController
{
    public function notFound(): string
    {
        http_response_code(404);

        return $this->render('errors/404', [
            'pageTitle' => '404 - Page introuvable',
        ]);
    }

    public function serverError(?Throwable $e = null): string
    {
        http_response_code(500);

        // Optionnel: journaliser l'exception
        if ($e !== null) {
            error_log($e->getMessage());
        }

        return $this->render('errors/500', [
            'pageTitle' => '500 - Erreur serveur',
        ]);
    }
}
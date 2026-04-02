<?php

namespace App\Controllers;

use App\Http\AbstractController;
use App\Security\Csrf;

class ContactController extends AbstractController
{
    public function index(): string
    {
        $errors = $_SESSION['contact_errors'] ?? [];
        $old = $_SESSION['contact_old'] ?? [];
        $success = $_SESSION['contact_success'] ?? null;

        unset($_SESSION['contact_errors'], $_SESSION['contact_old'], $_SESSION['contact_success']);

        return $this->render('contact/index', [
            'errors' => $errors,
            'old' => $old,
            'success' => $success,
        ]);
    }

    public function submit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /contact');
            exit;
        }
       
        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            error_log('CSRF check failed on contact form');
            
            $_SESSION['contact_errors'] = [
                'global' => 'Le formulaire n’a pas pu être envoyé. Merci de réessayer.',
            ];

            $_SESSION['contact_old'] = [
                'nom' => trim($_POST['nom'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'sujet' => trim($_POST['sujet'] ?? ''),
                'message' => trim($_POST['message'] ?? ''),
            ];

            header('Location: /contact');
            exit;
        }

        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $sujet = trim($_POST['sujet'] ?? '');
        $message = trim($_POST['message'] ?? '');

        $errors = [];

        if ($nom === '') {
            $errors['nom'] = 'Le nom est requis.';
        } elseif (mb_strlen($nom) > 100) {
            $errors['nom'] = 'Le nom est trop long.';
        }

        if ($email === '') {
            $errors['email'] = 'L’email est requis.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Veuillez saisir un email valide.';
        }

        if ($sujet === '') {
            $errors['sujet'] = 'Le sujet est requis.';
        } elseif (mb_strlen($sujet) > 150) {
            $errors['sujet'] = 'Le sujet est trop long.';
        }

        if ($message === '') {
            $errors['message'] = 'Le message est requis.';
        } elseif (mb_strlen($message) < 10) {
            $errors['message'] = 'Le message est trop court.';
        } elseif (mb_strlen($message) > 3000) {
            $errors['message'] = 'Le message est trop long.';
        }

        if (!empty($errors)) {
            $_SESSION['contact_errors'] = $errors;
            $_SESSION['contact_old'] = [
                'nom' => $nom,
                'email' => $email,
                'sujet' => $sujet,
                'message' => $message,
            ];

            header('Location: /contact');
            exit;
        }

        $mailer = new \App\Services\MailerService();
        $isSent = $mailer->sendContactMessage($nom, $email, $sujet, $message);

        if (!$isSent) {
            $_SESSION['contact_errors'] = [
                'global' => 'Une erreur est survenue lors de l’envoi du message. Veuillez réessayer dans quelques instants.',
            ];
            $_SESSION['contact_old'] = [
                'nom' => $nom,
                'email' => $email,
                'sujet' => $sujet,
                'message' => $message,
            ];

            header('Location: /contact');
            exit;
        }

        $_SESSION['contact_success'] = 'Votre message a bien été envoyé. Je vous répondrai dès que possible.';
        header('Location: /contact');
        exit;
    }
}

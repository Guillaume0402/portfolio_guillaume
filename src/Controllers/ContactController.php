<?php

namespace App\Controllers;

use App\Http\AbstractController;
use App\Security\Csrf;

class ContactController extends AbstractController
{
    private const PROJECT_TYPES = [
        'site_vitrine' => 'Site vitrine',
        'landing_page' => 'Landing page',
        'refonte' => 'Refonte',
        'maintenance' => 'Maintenance',
        'indecis' => 'Je ne sais pas encore',
    ];

    private const BUDGET_OPTIONS = [
        '450_900' => '450 à 900 €',
        '900_1500' => '900 à 1500 €',
        '1500_plus' => '1500 € et plus',
        'indecis' => 'Je ne sais pas encore',
    ];

    private const DEADLINE_OPTIONS = [
        'urgent' => 'Urgent',
        'moins_un_mois' => 'Moins d’un mois',
        'un_a_trois_mois' => '1 à 3 mois',
        'non_defini' => 'Pas encore défini',
    ];

    public function index(): string
    {
        $errors = $_SESSION['contact_errors'] ?? [];
        $old = $_SESSION['contact_old'] ?? [];
        $success = $_SESSION['contact_success'] ?? null;

        unset($_SESSION['contact_errors'], $_SESSION['contact_old'], $_SESSION['contact_success']);

        return $this->render('contact/index', [
            'pageTitle' => 'Contact | Guillaume Maignaut',
            'pageDescription' => 'Contactez Guillaume Maignaut pour un site vitrine, une landing page, une refonte ou une mission de développement web freelance.',
            'pageCanonical' => 'https://guillaumemaignaut.com/contact',
            'errors' => $errors,
            'old' => $old,
            'success' => $success,
        ]);
    }

    public function submit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectToContact();
        }
       
        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            error_log('CSRF check failed on contact form');
            
            $_SESSION['contact_errors'] = [
                'global' => 'Le formulaire n’a pas pu être envoyé. Merci de réessayer.',
            ];

            $_SESSION['contact_old'] = [
                'nom' => $this->postString('nom'),
                'email' => $this->postString('email'),
                'sujet' => $this->postString('sujet'),
                'site_actuel' => $this->postString('site_actuel'),
                'type_projet' => $this->postString('type_projet'),
                'budget' => $this->postString('budget'),
                'delai' => $this->postString('delai'),
                'message' => $this->postString('message'),
            ];

            $this->redirectToContact();
        }

        if ($this->postString('bot_check') !== '') {
            error_log('Spam honeypot triggered on contact form');

            $_SESSION['contact_success'] = 'Votre message a bien été envoyé. Je vous répondrai dès que possible.';
            Csrf::regenerate();
            $this->redirectToContact();
        }

        $nom = $this->postString('nom');
        $email = $this->postString('email');
        $sujet = $this->postString('sujet');
        $siteActuel = $this->postString('site_actuel');
        $typeProjet = $this->postString('type_projet');
        $budget = $this->postString('budget');
        $delai = $this->postString('delai');
        $message = $this->postString('message');

        $errors = [];

        if ($nom === '') {
            $errors['nom'] = 'Le nom est requis.';
        } elseif (mb_strlen($nom) > 100) {
            $errors['nom'] = 'Le nom est trop long.';
        }

        if ($email === '') {
            $errors['email'] = 'L’email est requis.';
        } elseif (mb_strlen($email) > 254) {
            $errors['email'] = 'L’email est trop long.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Veuillez saisir un email valide.';
        }

        if ($sujet === '') {
            $errors['sujet'] = 'Le sujet est requis.';
        } elseif (mb_strlen($sujet) > 150) {
            $errors['sujet'] = 'Le sujet est trop long.';
        }

        if (mb_strlen($siteActuel) > 300) {
            $errors['site_actuel'] = 'Le lien du site actuel est trop long.';
        }

        if (!array_key_exists($typeProjet, self::PROJECT_TYPES)) {
            $errors['type_projet'] = 'Veuillez choisir un type de projet.';
        }

        if (!array_key_exists($budget, self::BUDGET_OPTIONS)) {
            $errors['budget'] = 'Veuillez choisir un budget approximatif.';
        }

        if (!array_key_exists($delai, self::DEADLINE_OPTIONS)) {
            $errors['delai'] = 'Veuillez choisir un délai souhaité.';
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
                'site_actuel' => $siteActuel,
                'type_projet' => $typeProjet,
                'budget' => $budget,
                'delai' => $delai,
                'message' => $message,
            ];

            $this->redirectToContact();
        }

        $typeProjetLabel = self::PROJECT_TYPES[$typeProjet];
        $budgetLabel = self::BUDGET_OPTIONS[$budget];
        $delaiLabel = self::DEADLINE_OPTIONS[$delai];

        $mailer = new \App\Services\MailerService();
        $isSent = $mailer->sendContactMessage(
            $nom,
            $email,
            $sujet,
            $message,
            $siteActuel,
            $typeProjetLabel,
            $budgetLabel,
            $delaiLabel
        );

        if (!$isSent) {
            $_SESSION['contact_errors'] = [
                'global' => 'Une erreur est survenue lors de l’envoi du message. Veuillez réessayer dans quelques instants.',
            ];
            $_SESSION['contact_old'] = [
                'nom' => $nom,
                'email' => $email,
                'sujet' => $sujet,
                'site_actuel' => $siteActuel,
                'type_projet' => $typeProjet,
                'budget' => $budget,
                'delai' => $delai,
                'message' => $message,
            ];

            $this->redirectToContact();
        }

        $_SESSION['contact_success'] = 'Votre message a bien été envoyé. Je vous répondrai dès que possible.';
        Csrf::regenerate();
        $this->redirectToContact();
    }

    private function postString(string $key): string
    {
        $value = $_POST[$key] ?? '';

        return is_string($value) ? trim($value) : '';
    }

    private function redirectToContact(): never
    {
        header('Location: /contact', true, 303);
        exit;
    }
}

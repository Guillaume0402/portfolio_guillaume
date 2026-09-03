<?php

namespace App\Controllers;

use App\Http\AbstractController;
use App\Security\ClientIpResolver;
use App\Security\ContactRateLimiter;
use App\Security\Csrf;
use App\Security\TurnstileVerifier;
use App\Services\Database;
use RuntimeException;
use Throwable;

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
            'turnstileSiteKey' => $this->envOrFail(
                'TURNSTILE_SITE_KEY'
            ),
            'turnstileAction' => $this->envOrFail(
                'TURNSTILE_EXPECTED_ACTION'
            ),
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

        $trustedProxySources = array_values(array_filter(
            array_map(
                'trim',
                explode(
                    ',',
                    $this->envOrDefault('CONTACT_TRUSTED_PROXIES')
                )
            ),
            static fn(string $source): bool => $source !== ''
        ));

        $clientIpResolver = new ClientIpResolver(
            $trustedProxySources
        );

        $clientIp = $clientIpResolver->resolve($_SERVER);

        if ($clientIp === null) {
            error_log('Client IP resolution failed on contact form');

            $_SESSION['contact_errors'] = [
                'global' =>
                'Le formulaire n’a pas pu être vérifié. Merci de réessayer.',
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

        try {
            $rateLimiter = new ContactRateLimiter(
                Database::getConnection(),
                $this->envOrFail('CONTACT_IP_HASH_KEY'),
                $this->positiveIntEnvOrFail(
                    'CONTACT_RATE_LIMIT_MAX_ATTEMPTS'
                ),
                $this->positiveIntEnvOrFail(
                    'CONTACT_RATE_LIMIT_WINDOW_SECONDS'
                ),
                $this->positiveIntEnvOrFail(
                    'CONTACT_RATE_LIMIT_BLOCK_SECONDS'
                ),
                'contact'
            );

            $retryAfter = $rateLimiter->consume($clientIp);
        } catch (Throwable $exception) {
            error_log(sprintf(
                'Contact rate limiter failed (%s)',
                $exception::class
            ));

            http_response_code(503);
            header('Content-Type: text/plain; charset=UTF-8');

            echo 'Le formulaire est temporairement indisponible. '
                . 'Merci de réessayer plus tard.';

            exit;
        }

        if ($retryAfter > 0) {
            error_log('Contact form rate limit exceeded');

            http_response_code(429);
            header('Retry-After: ' . $retryAfter);
            header('Content-Type: text/plain; charset=UTF-8');

            echo 'Trop de tentatives. Merci de réessayer plus tard.';

            exit;
        }

        $allowedHostnames = array_values(array_filter(
            array_map(
                'trim',
                explode(
                    ',',
                    $this->envOrFail('TURNSTILE_ALLOWED_HOSTNAMES')
                )
            ),
            static fn(string $hostname): bool => $hostname !== ''
        ));

        $turnstileVerifier = new TurnstileVerifier(
            $this->envOrFail('TURNSTILE_SECRET_KEY'),
            $allowedHostnames,
            $this->envOrFail('TURNSTILE_EXPECTED_ACTION'),
            strtolower($this->envOrFail('APP_ENV')) === 'dev'
        );

        $turnstileToken = $_POST['cf-turnstile-response'] ?? null;

        if (!$turnstileVerifier->verify($turnstileToken, $clientIp)) {
            error_log('Turnstile verification failed on contact form');

            $_SESSION['contact_errors'] = [
                'global' =>
                'Le formulaire n’a pas pu être vérifié. Merci de réessayer.',
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

    private function positiveIntEnvOrFail(string $key): int
    {
        $value = $this->envOrFail($key);

        $validatedValue = filter_var(
            $value,
            FILTER_VALIDATE_INT,
            [
                'options' => [
                    'min_range' => 1,
                ],
            ]
        );

        if ($validatedValue === false) {
            throw new RuntimeException(
                "Invalid positive integer environment variable: {$key}"
            );
        }

        return $validatedValue;
    }

    private function envOrDefault(
        string $key,
        string $default = ''
    ): string {
        $value = $_ENV[$key] ?? getenv($key);

        if (!is_string($value)) {
            return $default;
        }

        return trim($value);
    }

    private function envOrFail(string $key): string
    {
        $value = $_ENV[$key] ?? getenv($key);

        if (!is_string($value) || trim($value) === '') {
            throw new RuntimeException(
                "Missing environment variable: {$key}"
            );
        }

        return trim($value);
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

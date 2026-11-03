<?php

declare(strict_types=1);

namespace {
    final class ContactSessionFixture
    {
        public const CASES = [
            'csrf_invalid_large', 'csrf_array_large', 'oversized', 'normal_validation_error',
            'unicode_oversized', 'combining_oversized', 'arrays', 'scalars', 'invalid_choices',
            'malformed_utf8', 'unknown_fields', 'ip_failure', 'turnstile_failure',
            'smtp_failure', 'valid', 'valid_boundaries',
        ];
        public const LIMITS = ['nom' => 100, 'email' => 254, 'sujet' => 150, 'site_actuel' => 300, 'message' => 3000];
        public static string $case = '';
        public static array $headers = [];
        public static array $events = [];
        public static array $sent = [];
        public static ?string $exception = null;

        public static function ordinaryValues(): array
        {
            return [
                'nom' => 'Élodie 🚀', 'email' => 'elodie@example.test', 'sujet' => 'Création de site 漢字',
                'site_actuel' => 'https://example.test', 'type_projet' => 'site_vitrine',
                'budget' => '450_900', 'delai' => 'urgent',
                'message' => 'Bonjour, je souhaite un site vitrine. 🌍',
            ];
        }

        public static function post(string $case): array
        {
            $post = self::ordinaryValues() + [
                'csrf_token' => 'synthetic-csrf', 'bot_check' => '',
                'cf-turnstile-response' => 'synthetic-turnstile',
            ];
            foreach (['nom', 'email', 'sujet', 'site_actuel', 'message'] as $field) {
                $post[$field] = '  ' . $post[$field] . '  ';
            }
            if (str_starts_with($case, 'csrf_')) {
                foreach (self::LIMITS as $field => $limit) {
                    $post[$field] = str_repeat('x', 131072);
                }
                $post['csrf_token'] = $case === 'csrf_array_large' ? ['invalid'] : 'incorrect';
            } elseif ($case === 'oversized') {
                foreach (self::LIMITS as $field => $limit) {
                    $post[$field] = str_repeat('x', $limit + 1);
                }
            } elseif ($case === 'unicode_oversized') {
                foreach (['nom' => 100, 'sujet' => 150, 'site_actuel' => 300, 'message' => 3000] as $field => $limit) {
                    $post[$field] = str_repeat('é', $limit - 1) . '🚀Z';
                }
            } elseif ($case === 'combining_oversized') {
                $post['nom'] = str_repeat("e\u{0301}", 50) . 'Z';
            } elseif (in_array($case, ['arrays', 'scalars'], true)) {
                foreach (array_keys(self::ordinaryValues()) as $field) {
                    $post[$field] = $case === 'arrays' ? ['nested' => ['unexpected']] : 123;
                }
            } elseif ($case === 'invalid_choices') {
                foreach (['type_projet', 'budget', 'delai'] as $field) {
                    $post[$field] .= str_repeat('x', 131072);
                }
            } elseif ($case === 'malformed_utf8') {
                $post['nom'] = "Nom\xC3(";
                $post['message'] = 'court';
            } elseif ($case === 'valid_boundaries') {
                $post['nom'] = str_repeat('é', 99) . '🚀';
                $post['email'] = str_repeat('a', 64) . '@' . str_repeat('b', 63) . '.' . str_repeat('c', 63) . '.' . str_repeat('d', 61);
                $post['sujet'] = str_repeat('漢', 150);
                $post['site_actuel'] = str_repeat('s', 300);
                $post['message'] = str_repeat('🚀', 3000);
            } elseif (in_array($case, ['normal_validation_error', 'unknown_fields'], true)) {
                $post['message'] = 'court';
                if ($case === 'unknown_fields') {
                    $post['unexpected'] = str_repeat('x', 131072);
                }
            }
            return $post;
        }
    }
}

namespace App\Controllers {
    // Intercepter l'appel sans émettre de véritable réponse HTTP.
    function header(string $value, bool $replace = true, int $status = 0): void
    {
        \ContactSessionFixture::$headers[] = [$value, $replace, $status];
        if ($status !== 0) {
            http_response_code($status);
        }
    }
}

namespace App\Security {
    // Le stockage du limiteur est doublé pour ne contacter aucune base.
    final class ContactRateLimiter
    {
        public function __construct(mixed ...$arguments) {}
        public function consume(string $ip): int
        {
            \ContactSessionFixture::$events[] = 'rate.consume';
            return 0;
        }
        public function cleanupExpired(): int
        {
            \ContactSessionFixture::$events[] = 'rate.cleanup';
            return 0;
        }
    }

    final class TurnstileVerifier
    {
        public function __construct(mixed ...$arguments) {}
        public function verify(mixed $token, ?string $ip = null): bool
        {
            \ContactSessionFixture::$events[] = 'turnstile.verify';
            return \ContactSessionFixture::$case !== 'turnstile_failure';
        }
    }
}

namespace App\Services {
    final class Database
    {
        public static function getConnection(): object
        {
            \ContactSessionFixture::$events[] = 'database';
            return new \stdClass();
        }
    }

    final class MailerService
    {
        public function sendContactMessage(string $nom, string $email, string $sujet, string $message, string $site, string $project, string $budget, string $deadline): bool
        {
            \ContactSessionFixture::$events[] = 'mailer.send';
            \ContactSessionFixture::$sent[] = func_get_args();
            return \ContactSessionFixture::$case !== 'smtp_failure';
        }
    }
}

namespace {
    function expect(bool $condition, string $message): void
    {
        if (!$condition) {
            throw new \RuntimeException($message);
        }
    }

    function same(mixed $expected, mixed $actual, string $message): void
    {
        expect($expected === $actual, $message);
    }

    function sorted(array $data): array
    {
        ksort($data);
        return $data;
    }

    function runController(string $case): never
    {
        ContactSessionFixture::$case = $case;
        $_POST = ContactSessionFixture::post($case);
        $_SERVER = ['REQUEST_METHOD' => 'POST', 'REMOTE_ADDR' => '192.0.2.50'];
        if ($case === 'ip_failure') {
            unset($_SERVER['REMOTE_ADDR']);
        }
        // Toutes les valeurs consultées sont synthétiques ; aucun .env n'est chargé.
        $_ENV = [
            'CONTACT_TRUSTED_PROXIES' => '', 'CONTACT_IP_HASH_KEY' => str_repeat('p', 32),
            'CONTACT_RATE_LIMIT_MAX_ATTEMPTS' => '5', 'CONTACT_RATE_LIMIT_WINDOW_SECONDS' => '900',
            'CONTACT_RATE_LIMIT_BLOCK_SECONDS' => '3600', 'TURNSTILE_ALLOWED_HOSTNAMES' => 'example.test',
            'TURNSTILE_SECRET_KEY' => 'synthetic-value', 'TURNSTILE_EXPECTED_ACTION' => 'contact', 'APP_ENV' => 'dev',
        ];
        $_SESSION = ['csrf' => 'synthetic-csrf'];
        if (str_starts_with($case, 'csrf_')) {
            $_SESSION['contact_old'] = ['nom' => 'Ancienne saisie à supprimer'];
        }
        http_response_code(200);
        set_error_handler(static function (int $severity, string $message, string $file, int $line): never {
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });
        set_exception_handler(static function (\Throwable $error): void {
            ContactSessionFixture::$exception = $error::class . ': ' . $error->getMessage();
        });
        register_shutdown_function(static function (): void {
            $old = $_SESSION['contact_old'] ?? null;
            $validUtf8 = [];
            foreach ($old ?? [] as $field => $value) {
                $validUtf8[$field] = is_string($value) && mb_check_encoding($value, 'UTF-8');
            }
            echo json_encode([
                'old_present' => array_key_exists('contact_old', $_SESSION), 'old' => $old,
                'valid_utf8' => $validUtf8, 'errors' => $_SESSION['contact_errors'] ?? [],
                'success' => $_SESSION['contact_success'] ?? null, 'headers' => ContactSessionFixture::$headers,
                'status' => http_response_code(), 'csrf_rotated' => $_SESSION['csrf'] !== 'synthetic-csrf',
                'events' => ContactSessionFixture::$events, 'sent' => ContactSessionFixture::$sent,
                'exception' => ContactSessionFixture::$exception,
            ], JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_SUBSTITUTE);
        });
        $root = dirname(__DIR__);
        require $root . '/src/Http/AbstractController.php';
        require $root . '/src/Security/Csrf.php';
        require $root . '/src/Security/ClientIpResolver.php';
        require $root . '/src/Controllers/ContactController.php';
        (new \App\Controllers\ContactController())->submit();
        throw new \RuntimeException('Le contrôleur aurait dû terminer par une redirection.');
    }

    function executeCase(string $case): array
    {
        // Même binaire PHP, sans forcer le chargement d'un mbstring déjà intégré.
        $command = [PHP_BINARY, '-d', 'auto_prepend_file=', '-d', 'auto_append_file=', __FILE__, '--case', $case];
        $process = proc_open($command, [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes, __DIR__, ['LC_ALL' => 'C']);
        expect(is_resource($process), 'Impossible de lancer le sous-processus.');
        fclose($pipes[0]);
        $stdout = stream_get_contents($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        same(0, proc_close($process), 'Échec du sous-processus : ' . trim($stderr));
        $result = json_decode($stdout, true, 512, JSON_THROW_ON_ERROR);
        same(null, $result['exception'], 'Exception du contrôleur : ' . ($result['exception'] ?? ''));
        return $result;
    }

    function checkCase(string $case, array $result): void
    {
        $shortMessage = ['message' => 'Le message est trop court.'];
        $choiceErrors = [
            'type_projet' => 'Veuillez choisir un type de projet.',
            'budget' => 'Veuillez choisir un budget approximatif.', 'delai' => 'Veuillez choisir un délai souhaité.',
        ];
        $errors = match ($case) {
            'csrf_invalid_large', 'csrf_array_large' => ['global' => 'Le formulaire n’a pas pu être envoyé. Merci de réessayer.'],
            'oversized' => ['nom' => 'Le nom est trop long.', 'email' => 'L’email est trop long.', 'sujet' => 'Le sujet est trop long.', 'site_actuel' => 'Le lien du site actuel est trop long.', 'message' => 'Le message est trop long.'],
            'unicode_oversized' => ['nom' => 'Le nom est trop long.', 'sujet' => 'Le sujet est trop long.', 'site_actuel' => 'Le lien du site actuel est trop long.', 'message' => 'Le message est trop long.'],
            'combining_oversized' => ['nom' => 'Le nom est trop long.'],
            'arrays', 'scalars' => ['nom' => 'Le nom est requis.', 'email' => 'L’email est requis.', 'sujet' => 'Le sujet est requis.'] + $choiceErrors + ['message' => 'Le message est requis.'],
            'invalid_choices' => $choiceErrors,
            'normal_validation_error', 'malformed_utf8', 'unknown_fields' => $shortMessage,
            'ip_failure', 'turnstile_failure' => ['global' => 'Le formulaire n’a pas pu être vérifié. Merci de réessayer.'],
            'smtp_failure' => ['global' => 'Une erreur est survenue lors de l’envoi du message. Veuillez réessayer dans quelques instants.'],
            'valid', 'valid_boundaries' => [],
        };
        $valid = in_array($case, ['valid', 'valid_boundaries'], true);
        $events = match ($case) {
            'turnstile_failure' => ['database', 'rate.consume', 'rate.cleanup', 'turnstile.verify'],
            'smtp_failure', 'valid', 'valid_boundaries' => ['database', 'rate.consume', 'rate.cleanup', 'turnstile.verify', 'mailer.send'],
            default => [],
        };
        same(303, $result['status'], 'Statut 303 modifié.');
        same([['Location: /contact', true, 303]], $result['headers'], 'Redirection modifiée.');
        same($errors, $result['errors'], 'Erreurs métier modifiées ou saisies tronquées avant validation.');
        same($events, $result['events'], 'Ordre ou présence des appels modifié.');
        same($valid, $result['csrf_rotated'], 'Rotation CSRF modifiée.');
        same($valid ? 'Votre message a bien été envoyé. Je vous répondrai dès que possible.' : null, $result['success'], 'Message de succès modifié.');

        $expected = ContactSessionFixture::ordinaryValues();
        if ($case === 'valid_boundaries') {
            $expected = array_intersect_key(ContactSessionFixture::post($case), $expected);
        }
        $sent = in_array($case, ['smtp_failure', 'valid', 'valid_boundaries'], true)
            ? [[$expected['nom'], $expected['email'], $expected['sujet'], $expected['message'], $expected['site_actuel'], 'Site vitrine', '450 à 900 €', 'Urgent']]
            : [];
        same($sent, $result['sent'], 'Nombre ou contenu des envois simulés modifié.');
        if ($valid || str_starts_with($case, 'csrf_')) {
            same(false, $result['old_present'], 'Des saisies restent en session.');
            return;
        }

        same(true, $result['old_present'], 'Saisies utiles absentes.');
        same(array_keys(sorted($expected)), array_keys(sorted($result['old'])), 'Champs de session inattendus.');
        expect(!in_array(false, $result['valid_utf8'], true), 'Type non textuel ou UTF-8 invalide conservé.');
        foreach (ContactSessionFixture::LIMITS as $field => $limit) {
            expect(mb_strlen($result['old'][$field], 'UTF-8') <= $limit, 'Borne dépassée : ' . $field);
        }
        if ($case === 'oversized') {
            foreach (ContactSessionFixture::LIMITS as $field => $limit) {
                $expected[$field] = str_repeat('x', $limit);
            }
        } elseif ($case === 'unicode_oversized') {
            foreach (['nom' => 100, 'sujet' => 150, 'site_actuel' => 300, 'message' => 3000] as $field => $limit) {
                $expected[$field] = str_repeat('é', $limit - 1) . '🚀';
            }
        } elseif ($case === 'combining_oversized') {
            $expected['nom'] = str_repeat("e\u{0301}", 50);
        } elseif (in_array($case, ['arrays', 'scalars'], true)) {
            $expected = array_fill_keys(array_keys($expected), '');
        } elseif ($case === 'invalid_choices') {
            $expected['type_projet'] = $expected['budget'] = $expected['delai'] = '';
        } elseif (in_array($case, ['normal_validation_error', 'malformed_utf8', 'unknown_fields'], true)) {
            $expected['message'] = 'court';
            if ($case === 'malformed_utf8') {
                $expected['nom'] = '';
            }
        }
        same(sorted($expected), sorted($result['old']), 'Copie en session incorrecte.');
    }

    if (PHP_SAPI !== 'cli') {
        http_response_code(400);
        echo "Ces tests nécessitent PHP CLI.\n";
        exit(2);
    }
    if (!extension_loaded('mbstring') || !function_exists('proc_open')) {
        fwrite(STDERR, "Prérequis manquants : activer mbstring et proc_open dans PHP CLI.\n");
        exit(2);
    }
    $options = getopt('', ['case:']);
    if (isset($options['case'])) {
        if (!in_array($options['case'], ContactSessionFixture::CASES, true)) {
            fwrite(STDERR, "Scénario inconnu.\n");
            exit(2);
        }
        runController($options['case']);
    }
    $failed = 0;
    foreach (ContactSessionFixture::CASES as $case) {
        try {
            checkCase($case, executeCase($case));
            echo 'PASS ', $case, PHP_EOL;
        } catch (\Throwable $error) {
            $failed++;
            fwrite(STDERR, 'FAIL ' . $case . ': ' . $error->getMessage() . PHP_EOL);
        }
    }
    echo count(ContactSessionFixture::CASES) - $failed, '/', count(ContactSessionFixture::CASES), ' cas réussis (PHP ', PHP_VERSION, ').', PHP_EOL;
    exit($failed === 0 ? 0 : 1);
}

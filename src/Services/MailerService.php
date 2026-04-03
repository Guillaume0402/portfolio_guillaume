<?php

namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailerService
{
    private function env(string $key, ?string $default = null): ?string
    {
        $value = $_ENV[$key] ?? getenv($key);

        if ($value === false || $value === null || $value === '') {
            return $default;
        }

        return $value;
    }

    public function sendContactMessage(
        string $nom,
        string $email,
        string $sujet,
        string $message
    ): bool {
        $mail = new PHPMailer(true);

        try {
            $host = $this->env('SMTP_HOST', 'mailpit');
            $port = (int) $this->env('SMTP_PORT', '1025');
            $username = $this->env('SMTP_USERNAME', '');
            $password = $this->env('SMTP_PASSWORD', '');
            $encryption = $this->env('SMTP_ENCRYPTION', '');
            $fromAddress = $this->env('MAIL_FROM', 'no-reply@portfolio.local');
            $fromName = $this->env('MAIL_FROM_NAME', 'Portfolio Guillaume');
            $toAddress = $this->env('CONTACT_TO', 'g.maignaut@gmail.com');

            $mail->isSMTP();
            $mail->Host = $host;
            $mail->Port = $port;
            $mail->CharSet = 'UTF-8';

            $mail->SMTPAuth = ($username !== '' && $password !== '');

            if ($mail->SMTPAuth) {
                $mail->Username = $username;
                $mail->Password = $password;
            }

            if ($encryption === 'tls') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            } elseif ($encryption === 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            }

            $mail->setFrom($fromAddress, $fromName);
            $mail->addAddress($toAddress);
            $mail->addReplyTo($email, $nom);

            $mail->Subject = '[Contact Portfolio] ' . $sujet;

            $body = '
                <h2>Nouveau message depuis le formulaire de contact</h2>
                <p><strong>Nom :</strong> ' . htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Email :</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Sujet :</strong> ' . htmlspecialchars($sujet, ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Message :</strong><br>' . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . '</p>
            ';

            $mail->isHTML(true);
            $mail->Body = $body;
            $mail->AltBody =
                "Nouveau message depuis le formulaire de contact\n\n" .
                "Nom : {$nom}\n" .
                "Email : {$email}\n" .
                "Sujet : {$sujet}\n\n" .
                "Message :\n{$message}";

            $mail->send();

            return true;
        } catch (Exception $e) {
            error_log('Erreur envoi mail : ' . $e->getMessage());
            return false;
        }
    }
}
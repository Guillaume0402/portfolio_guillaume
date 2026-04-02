<?php

namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class MailerService
{
    public function sendContactMessage(
        string $nom,
        string $email,
        string $sujet,
        string $message
    ): bool {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'] ?? 'mailpit';
            $mail->Port = (int) ($_ENV['SMTP_PORT'] ?? 1025);
            $mail->SMTPAuth = false;

            $mail->CharSet = 'UTF-8';

            $mail->setFrom(
                $_ENV['MAIL_FROM'] ?? 'no-reply@portfolio.local',
                $_ENV['MAIL_FROM_NAME'] ?? 'Portfolio Guillaume'
            );

            $mail->addAddress($_ENV['CONTACT_TO'] ?? 'g.maignaut@gmail.com');
            $mail->addReplyTo($email, $nom);

            $mail->Subject = '[Contact Portfolio] ' . $sujet;

            $body = "
                <h2>Nouveau message depuis le formulaire de contact</h2>
                <p><strong>Nom :</strong> " . htmlspecialchars($nom) . "</p>
                <p><strong>Email :</strong> " . htmlspecialchars($email) . "</p>
                <p><strong>Sujet :</strong> " . htmlspecialchars($sujet) . "</p>
                <p><strong>Message :</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
            ";

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

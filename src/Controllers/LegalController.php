<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\AbstractController;

final class LegalController extends AbstractController
{
    private const LEGAL_INFO = [
        'site_url' => 'https://guillaumemaignaut.com',
        'editor_name' => 'Guillaume Maignaut',
        'editor_status' => 'Entrepreneur individuel / micro-entreprise - A completer',
        'editor_address' => 'A completer avant mise en ligne',
        'editor_email' => 'g.maignaut@gmail.com',
        'editor_phone' => '+33 6 50 42 80 39',
        'siret' => 'A completer',
        'vat' => 'TVA non applicable, art. 293 B du CGI - A confirmer',
        'publication_director' => 'Guillaume Maignaut',
        'host_name' => 'A completer avec le nom de l hebergeur VPS',
        'host_address' => 'A completer avec l adresse de l hebergeur',
        'host_phone' => 'A completer avec le telephone de l hebergeur',
        'retention_contact' => '3 ans apres le dernier contact entrant',
        'last_update' => '7 juin 2026',
    ];

    public function legalNotice(): string
    {
        return $this->render('legal/mentions-legales', [
            'pageTitle' => 'Mentions légales | Guillaume Maignaut',
            'pageDescription' => 'Mentions légales du site guillaumemaignaut.com : éditeur, responsable de publication, hébergement et propriété intellectuelle.',
            'pageCanonical' => 'https://guillaumemaignaut.com/mentions-legales',
            'legal' => self::LEGAL_INFO,
        ]);
    }

    public function privacy(): string
    {
        return $this->render('legal/confidentialite', [
            'pageTitle' => 'Politique de confidentialité | Guillaume Maignaut',
            'pageDescription' => 'Politique de confidentialité du site guillaumemaignaut.com : données collectées, finalités, conservation et droits RGPD.',
            'pageCanonical' => 'https://guillaumemaignaut.com/confidentialite',
            'legal' => self::LEGAL_INFO,
        ]);
    }

    public function cookies(): string
    {
        return $this->render('legal/cookies', [
            'pageTitle' => 'Cookies et traceurs | Guillaume Maignaut',
            'pageDescription' => 'Informations sur les cookies et traceurs utilisés sur le site guillaumemaignaut.com.',
            'pageCanonical' => 'https://guillaumemaignaut.com/cookies',
            'legal' => self::LEGAL_INFO,
        ]);
    }
}

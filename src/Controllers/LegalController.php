<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\AbstractController;

final class LegalController extends AbstractController
{
    private const LEGAL_INFO = [
        'site_url' => 'https://guillaumemaignaut.com',
        'editor_name' => 'Guillaume Pascal Maignaut',
        'editor_status' => 'Entrepreneur individuel',
        'editor_activity' => 'Développement web, création de sites internet, intégration d\'interfaces, maintenance et évolution de sites web, développement d\'applications web, hébergement et accompagnement technique de projets numériques.',
        'editor_address' => '5 rue du Docteur Schweitzer, 32500 Fleurance, France',
        'editor_email' => 'g.maignaut@gmail.com',
        'editor_phone' => '+33 6 50 42 80 39',
        'siren' => '105 857 130',
        'siret' => '105 857 130 00014',
        'rne' => 'Immatriculé au Registre national des entreprises le 4 juin 2026',
        'ape' => '6201Z - Programmation informatique',
        'vat' => 'TVA non applicable, art. 293 B du CGI',
        'publication_director' => 'Guillaume Pascal Maignaut',
        'host_name' => 'Hetzner Online GmbH',
        'host_address' => 'Industriestr. 25, 91710 Gunzenhausen, Allemagne',
        'host_phone' => '+49 9831 505-0',
        'mediator_name' => 'Médiateur de la consommation à désigner avant toute vente à un consommateur',
        'mediator_address' => 'A compléter après adhésion à un médiateur référencé',
        'mediator_website' => 'A compléter après adhésion à un médiateur référencé',
        'retention_contact' => '3 ans après le dernier contact entrant',
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

    public function terms(): string
    {
        return $this->render('legal/cgv', [
            'pageTitle' => 'Conditions générales de vente | Guillaume Maignaut',
            'pageDescription' => 'Conditions générales de vente des prestations de création de sites web, landing pages, refontes, maintenance et accompagnement technique.',
            'pageCanonical' => 'https://guillaumemaignaut.com/cgv',
            'legal' => self::LEGAL_INFO,
        ]);
    }
}

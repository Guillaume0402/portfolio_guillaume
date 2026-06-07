<?php
$showcaseSites = [
    [
        'title' => 'Démo Plombier',
        'sector' => 'Artisan local',
        'status' => 'Démo en ligne',
        'description' => 'Site vitrine orienté prise de contact rapide : services, zones d’intervention, avis, formulaire et appel à l’action visible.',
        'tags' => ['Urgence locale', 'Formulaire', 'Mobile first'],
        'image' => '/images/demo-plombier.webp',
        'alt' => 'Capture du site démo plombier avec hero, formulaire et services',
        'url' => 'https://demo-plombier.guillaumemaignaut.com/',
    ],
    [
        'title' => 'Démo Restaurant',
        'sector' => 'Restaurant local',
        'status' => 'Démo en ligne',
        'description' => 'Présentation chaleureuse avec carte, informations pratiques, réservation simulée et mise en avant visuelle des plats.',
        'tags' => ['Carte en ligne', 'Réservation', 'Images produit'],
        'image' => '/images/demo-restaurant.webp',
        'alt' => 'Capture du site démo restaurant avec menu et plats',
        'url' => 'https://demo-restaurant.guillaumemaignaut.com/',
    ],
    [
        'title' => 'Démo Coach Sportif',
        'sector' => 'Service indépendant',
        'status' => 'Démo en ligne',
        'description' => 'Landing page claire pour présenter une offre, rassurer avec une méthode, expliquer les tarifs et déclencher une demande de bilan.',
        'tags' => ['Landing page', 'Offres', 'Conversion'],
        'image' => '/images/demo-coach.webp',
        'alt' => 'Capture du site démo coach sportif avec hero et offres',
        'url' => 'https://demo-coach.guillaumemaignaut.com/',
    ],
];

$processSteps = [
    [
        'number' => '01',
        'title' => 'Cadrage clair',
        'description' => 'On pose vos objectifs, vos contenus importants et le parcours attendu pour transformer les visiteurs en contacts.',
    ],
    [
        'number' => '02',
        'title' => 'Maquette utile',
        'description' => 'Je prépare une structure lisible, avec les bons messages, les bons appels à l\'action et une navigation simple.',
    ],
    [
        'number' => '03',
        'title' => 'Intégration propre',
        'description' => 'Le site est responsive, rapide, maintenable et pensé pour fonctionner correctement sur mobile comme sur ordinateur.',
    ],
    [
        'number' => '04',
        'title' => 'Mise en ligne suivie',
        'description' => 'On vérifie les pages, le formulaire, les bases SEO et les points essentiels avant publication.',
    ],
];

$offers = [
    [
        'title' => 'Landing page',
        'price' => 'À partir de 450 € TTC',
        'description' => 'Une page unique pour présenter une offre, capter des contacts ou préparer une campagne.',
        'included' => [
            '1 page complète orientée conversion',
            'affichage adapté mobile, tablette et ordinateur',
            'formulaire de contact avec protection anti-spam de base',
            'optimisation des balises SEO de base',
            'mise en ligne initiale',
            '1 série de corrections après livraison',
        ],
        'excluded' => [
            'hébergement et nom de domaine',
            'rédaction complète des textes',
            'logo / identité visuelle complète',
            'maintenance mensuelle',
            'fonctionnalités avancées sur mesure',
        ],
    ],
    [
        'title' => 'Site vitrine',
        'price' => 'À partir de 900 € TTC',
        'description' => 'Un site complet pour présenter votre activité, vos services et générer des demandes de contact.',
        'label' => 'Le plus demandé',
        'featured' => true,
        'included' => [
            '4 à 5 pages principales',
            'affichage adapté mobile, tablette et ordinateur',
            'formulaire de contact avec protection anti-spam de base',
            'optimisation des balises SEO de base',
            'mise en ligne initiale',
            'accompagnement après livraison',
        ],
        'excluded' => [
            'hébergement et nom de domaine',
            'rédaction complète des textes',
            'logo / identité visuelle complète',
            'maintenance mensuelle',
            'fonctionnalités avancées sur mesure',
        ],
    ],
    [
        'title' => 'Refonte ou maintenance',
        'price' => 'Sur devis',
        'description' => 'Amélioration d\'un site existant, corrections, évolutions ou accompagnement ponctuel.',
        'included' => [
            'analyse rapide de l\'existant',
            'corrections ou améliorations ciblées',
            'ajustements responsive si nécessaire',
            'mise en ligne initiale si nécessaire',
            'optimisations simples de performance',
            'conseils pour prioriser les prochaines actions',
        ],
        'excluded' => [
            'refonte complète sans devis détaillé',
            'hébergement et nom de domaine',
            'maintenance mensuelle',
            'développement applicatif complexe',
        ],
    ],
];
?>

<section class="container-app hero-section freelance-hero">
        <div class="container hero-inner">
            <div class="hero-media reveal">
                <div class="hero-copy">
                    <p class="hero-kicker">
                        <span class="hero-kicker-text">
                            <span class="hero-kicker-name">Guillaume Maignaut</span>
                            <span class="hero-kicker-role">Développeur web junior freelance</span>
                        </span>
                    </p>

                    <h1 class="hero-title">Un site clair, rapide et professionnel pour donner confiance à vos futurs clients.</h1>

                    <p class="hero-subtitle">
                        Je crée des sites vitrines et landing pages pour professionnels, indépendants, artisans, associations et petites entreprises :
                        une présentation lisible, un parcours simple, un formulaire fonctionnel et une base technique propre.
                    </p>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="/contact">Parler de mon projet</a>
                        <a class="btn btn-ghost" href="#realisations">Voir les sites vitrines</a>
                    </div>

                    <div class="hero-badges" aria-label="Services principaux">
                        <span class="badge">Site vitrine</span>
                        <span class="badge">Responsive</span>
                        <span class="badge">SEO technique</span>
                        <span class="badge">Formulaire contact</span>
                    </div>

                    <div class="hero-proof-list" aria-label="Points de confiance">
                        <div class="hero-proof-item">
                            <strong>3 démos</strong>
                            <span>consultables en ligne pour voir mon approche</span>
                        </div>
                        <div class="hero-proof-item">
                            <strong>100%</strong>
                            <span>adapté mobile, tablette et ordinateur</span>
                        </div>
                        <div class="hero-proof-item">
                            <strong>Suivi clair</strong>
                            <span>un échange simple du cadrage à la mise en ligne</span>
                        </div>
                    </div>
                </div>

                <aside class="hero-offer-panel" aria-label="Résumé de l'offre">
                    <figure class="hero-client-visual">
                        <img
                            src="/images/hero-laptop-man.webp"
                            alt="Homme travaillant sur un ordinateur portable dans un espace de travail professionnel"
                            width="1200"
                            height="750"
                            loading="eager">
                    </figure>

                    <div class="hero-offer-content">
                        <p class="panel-kicker">Accompagnement web</p>
                        <h2>De l'idée à une page qui donne envie d'agir</h2>
                        <ul class="hero-checklist">
                            <li>Structure de page orientée conversion</li>
                            <li>Design responsive et lisible</li>
                            <li>Base SEO propre dès le départ</li>
                            <li>Formulaire de contact prêt à recevoir vos demandes</li>
                        </ul>
                        <a class="panel-link" href="#offers">Découvrir les offres</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section id="services" class="section">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Services</p>
                <h2>Ce que je peux construire pour vous</h2>
                <p>Des prestations simples à comprendre, pensées pour obtenir un site utile, fiable et facile à faire évoluer.</p>
            </header>

            <div class="service-grid">
                <article class="service-card reveal">
                    <span class="service-number">01</span>
                    <h3>Site vitrine</h3>
                    <p>Une présence professionnelle pour présenter votre activité, vos services, vos réalisations et générer des demandes de contact.</p>
                </article>

                <article class="service-card reveal">
                    <span class="service-number">02</span>
                    <h3>Landing page</h3>
                    <p>Une page ciblée pour une offre, un lancement ou une campagne, avec un message clair et un appel à l'action visible.</p>
                </article>

                <article class="service-card reveal">
                    <span class="service-number">03</span>
                    <h3>Refonte web</h3>
                    <p>Modernisation d'un site existant : structure, lisibilité, responsive, performances et parcours utilisateur plus fluide.</p>
                </article>

                <article class="service-card reveal">
                    <span class="service-number">04</span>
                    <h3>Maintenance</h3>
                    <p>Corrections, petites évolutions, mises à jour de contenu et amélioration continue pour garder un site propre dans le temps.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section process-section">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Méthode</p>
                <h2>Un déroulé simple pour avancer sans flou</h2>
                <p>Chaque étape sert à garder un site clair, utile et prêt à inspirer confiance à vos futurs clients.</p>
            </header>

            <div class="process-grid">
                <?php foreach ($processSteps as $step): ?>
                    <article class="process-card reveal">
                        <span class="process-number"><?= htmlspecialchars($step['number'], ENT_QUOTES, 'UTF-8') ?></span>
                        <h3><?= htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars($step['description'], ENT_QUOTES, 'UTF-8') ?></p>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="offers-note reveal">
                <p>Les tarifs indiqués concernent la création du site. L'hébergement, le nom de domaine et la maintenance mensuelle restent à la charge du client, avec possibilité d'accompagnement pour la mise en place.</p>
            </div>
        </div>
    </section>

    <section id="realisations" class="section section-featured">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Réalisations freelance</p>
                <h2>Trois démos concrètes pour vous projeter</h2>
                <p>Chaque démo montre un cas fréquent de site vitrine : une activité locale, une offre claire et un parcours pensé pour déclencher un contact.</p>
            </header>

            <div class="showcase-grid">
                <?php foreach ($showcaseSites as $site): ?>
                    <article class="showcase-card reveal">
                        <a class="showcase-preview" href="<?= htmlspecialchars($site['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="Voir <?= htmlspecialchars($site['title'], ENT_QUOTES, 'UTF-8') ?>">
                            <img
                                src="<?= htmlspecialchars($site['image'], ENT_QUOTES, 'UTF-8') ?>"
                                alt="<?= htmlspecialchars($site['alt'], ENT_QUOTES, 'UTF-8') ?>"
                                width="1200"
                                height="932"
                                loading="lazy">
                        </a>

                        <div class="showcase-body">
                            <p class="showcase-status"><?= htmlspecialchars($site['status'], ENT_QUOTES, 'UTF-8') ?></p>
                            <h3><?= htmlspecialchars($site['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p class="showcase-sector"><?= htmlspecialchars($site['sector'], ENT_QUOTES, 'UTF-8') ?></p>
                            <p><?= htmlspecialchars($site['description'], ENT_QUOTES, 'UTF-8') ?></p>

                            <div class="tag-row showcase-tags" aria-label="Points clés">
                                <?php foreach ($site['tags'] as $tag): ?>
                                    <span class="tag"><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?></span>
                                <?php endforeach; ?>
                            </div>

                            <div class="showcase-actions">
                                <a class="showcase-link" href="<?= htmlspecialchars($site['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Voir la démo</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="section-actions reveal">
                <a class="btn btn-primary btn-lg" href="/contact">Me confier un projet</a>
                <a class="btn btn-ghost btn-lg" href="/portfolio">Voir le portfolio technique</a>
            </div>
        </div>
    </section>

    <section id="about" class="section">
        <div class="container about-grid">
            <header class="section-header reveal">
                <p class="section-kicker">À propos</p>
                <h2>Un développeur junior sérieux, attentif au besoin réel</h2>
                <p>Je construis des sites simples à comprendre, faciles à consulter et prêts à recevoir vos premières demandes.</p>
            </header>

            <div class="about-card reveal">
                <div class="about-profile">
                    <figure class="about-photo">
                        <img
                            src="/images/photo_profil.jpg"
                            alt="Portrait de Guillaume Maignaut, développeur web junior freelance"
                            width="240"
                            height="240"
                            loading="lazy">
                    </figure>

                    <div class="about-content">
                        <p class="about-name">Guillaume Maignaut</p>
                        <p class="about-text">
                            Mon objectif n'est pas seulement de produire du code : je veux créer un site qui aide vos visiteurs à comprendre vite ce que vous proposez, à vous faire confiance et à vous contacter facilement.
                        </p>
                        <p class="about-text">
                            En tant que développeur junior, je privilégie une méthode claire : cadrage du besoin, organisation des contenus, intégration responsive, sécurité du formulaire, mise en ligne et échanges réguliers.
                        </p>
                    </div>
                </div>

                <div class="about-stats">
                    <div class="stat">
                        <span class="stat-num">PHP</span>
                        <span class="stat-label">Back-end et formulaires</span>
                    </div>
                    <div class="stat">
                        <span class="stat-num">SEO</span>
                        <span class="stat-label">Bases techniques propres</span>
                    </div>
                    <div class="stat">
                        <span class="stat-num">UX</span>
                        <span class="stat-label">Parcours clair et responsive</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="offers" class="section">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Tarifs et offres</p>
                <h2>Des bases de budget pour cadrer votre projet</h2>
                <p>Chaque projet est ajusté selon le contenu, les fonctionnalités et le niveau d'accompagnement souhaité.</p>
            </header>

            <div class="offers-grid">
                <?php foreach ($offers as $offer): ?>
                    <article class="offer-card <?= !empty($offer['featured']) ? 'offer-card-featured' : '' ?> reveal">
                        <?php if (!empty($offer['label'])): ?>
                            <p class="offer-label"><?= htmlspecialchars($offer['label'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>

                        <h3><?= htmlspecialchars($offer['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p class="offer-price"><?= htmlspecialchars($offer['price'], ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="offer-summary"><?= htmlspecialchars($offer['description'], ENT_QUOTES, 'UTF-8') ?></p>

                        <div class="offer-details">
                            <div>
                                <p class="offer-list-title">Inclus</p>
                                <ul class="offer-list">
                                    <?php foreach ($offer['included'] as $item): ?>
                                        <li><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div>
                                <p class="offer-list-title">Non inclus</p>
                                <ul class="offer-list offer-list-excluded">
                                    <?php foreach ($offer['excluded'] as $item): ?>
                                        <li><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="contact" class="section section-contact">
        <div class="container">
            <div class="contact-card reveal">
                <div class="contact-inner">
                    <div>
                        <p class="contact-kicker">Contact</p>
                        <h2 class="contact-title">Vous avez un projet de site web ?</h2>
                        <p class="contact-lead">Décrivez votre besoin, votre délai et votre objectif. Je vous répondrai avec une première lecture claire de la meilleure approche.</p>
                    </div>
                    <div class="contact-actions">
                        <a class="btn btn-primary btn-lg" href="/contact">Remplir le formulaire</a>
                        <a class="btn btn-ghost btn-lg" href="mailto:g.maignaut@gmail.com">Email direct</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

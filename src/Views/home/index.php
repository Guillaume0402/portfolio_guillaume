<?php
$showcaseSites = [
    [
        'title' => 'Atelier Belle Ligne',
        'sector' => 'Artisanat et création',
        'status' => 'Maquette vitrine en préparation',
        'description' => 'Site vitrine élégant pour présenter un savoir-faire, rassurer les visiteurs et faciliter la prise de contact.',
        'tags' => ['Présentation', 'Galerie', 'Contact'],
        'class' => 'showcase-preview-atelier',
    ],
    [
        'title' => 'Cabinet Horizon',
        'sector' => 'Accompagnement et conseil',
        'status' => 'Projet client non déployé',
        'description' => 'Structure claire pour expliquer les prestations, valoriser l’expertise et guider vers une demande de rendez-vous.',
        'tags' => ['Services', 'SEO local', 'Rendez-vous'],
        'class' => 'showcase-preview-cabinet',
    ],
    [
        'title' => 'Maison Nova',
        'sector' => 'Commerce local',
        'status' => 'Prototype vitrine',
        'description' => 'Page commerciale responsive pour mettre en avant une offre, des produits phares et un contact rapide.',
        'tags' => ['Landing page', 'Responsive', 'Conversion'],
        'class' => 'showcase-preview-nova',
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
?>

<section class="container-app hero-section freelance-hero">
        <div class="container hero-inner">
            <div class="hero-media reveal">
                <div class="hero-copy">
                    <p class="hero-kicker">
                        <span class="hero-kicker-text">
                            <span class="hero-kicker-name">Guillaume Maignaut</span>
                            <span class="hero-kicker-role">Création de sites web freelance</span>
                        </span>
                    </p>

                    <h1 class="hero-title">Un site clair, rapide et professionnel pour développer votre activité.</h1>

                    <p class="hero-subtitle">
                        J'aide les indépendants, artisans et petites entreprises à créer une présence en ligne sérieuse :
                        site vitrine, landing page, refonte, optimisation et formulaire de contact prêt à recevoir vos demandes.
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
                            <strong>7 jours</strong>
                            <span>pour recevoir une première structure claire</span>
                        </div>
                        <div class="hero-proof-item">
                            <strong>100%</strong>
                            <span>adapté mobile, tablette et ordinateur</span>
                        </div>
                        <div class="hero-proof-item">
                            <strong>1 seul</strong>
                            <span>interlocuteur du cadrage à la mise en ligne</span>
                        </div>
                    </div>
                </div>

                <aside class="hero-offer-panel" aria-label="Résumé de l'offre">
                    <figure class="hero-client-visual">
                        <img
                            src="/images/client-workspace.webp"
                            alt="Entrepreneuse travaillant sur son ordinateur pour développer son activité en ligne"
                            width="1200"
                            height="675"
                            loading="eager">
                    </figure>

                    <div class="hero-offer-content">
                        <p class="panel-kicker">Accompagnement web</p>
                        <h2>De l'idée à la mise en ligne</h2>
                        <ul class="hero-checklist">
                            <li>Structure de page orientée conversion</li>
                            <li>Design responsive et lisible</li>
                            <li>Base SEO propre dès le départ</li>
                            <li>Contact fonctionnel et suivi humain</li>
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
        </div>
    </section>

    <section id="realisations" class="section section-featured">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Réalisations freelance</p>
                <h2>Sites vitrines en préparation</h2>
                <p>Ces exemples représentent le type de sites clients que je construis. Les projets techniques restent disponibles sur le portfolio.</p>
            </header>

            <div class="showcase-grid">
                <?php foreach ($showcaseSites as $site): ?>
                    <article class="showcase-card reveal">
                        <div class="showcase-preview <?= htmlspecialchars($site['class'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true">
                            <div class="showcase-browser">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="showcase-visual">
                                <div class="showcase-line showcase-line-strong"></div>
                                <div class="showcase-line"></div>
                                <div class="showcase-line showcase-line-short"></div>
                                <div class="showcase-blocks">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>

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
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="section-actions reveal">
                <a class="btn btn-ghost btn-lg" href="/portfolio">Voir le portfolio technique</a>
            </div>
        </div>
    </section>

    <section id="about" class="section">
        <div class="container about-grid">
            <header class="section-header reveal">
                <p class="section-kicker">À propos</p>
                <h2>Un interlocuteur technique qui garde le besoin métier en tête</h2>
                <p>Je conçois des interfaces lisibles, rapides et maintenables, avec une attention particulière portée à la fiabilité.</p>
            </header>

            <div class="about-card reveal">
                <p class="about-text">
                    Mon objectif n'est pas seulement de produire du code : je veux créer un site qui aide vos visiteurs à comprendre vite ce que vous proposez, à vous faire confiance et à vous contacter facilement.
                </p>
                <p class="about-text">
                    Je travaille avec une approche structurée : cadrage du besoin, organisation des contenus, intégration responsive, sécurité du formulaire, mise en ligne et améliorations possibles après lancement.
                </p>
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
                <article class="offer-card reveal">
                    <h3>Landing page</h3>
                    <p class="offer-price">À partir de 450 €</p>
                    <p>Une page unique pour présenter une offre, capter des contacts ou préparer une campagne.</p>
                </article>

                <article class="offer-card offer-card-featured reveal">
                    <p class="offer-label">Le plus demandé</p>
                    <h3>Site vitrine</h3>
                    <p class="offer-price">À partir de 900 €</p>
                    <p>Un site complet avec pages principales, responsive, SEO de base et formulaire de contact.</p>
                </article>

                <article class="offer-card reveal">
                    <h3>Refonte ou maintenance</h3>
                    <p class="offer-price">Sur devis</p>
                    <p>Amélioration d'un site existant, corrections, évolutions ou accompagnement ponctuel.</p>
                </article>
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

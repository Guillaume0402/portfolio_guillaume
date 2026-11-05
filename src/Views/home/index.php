<?php
$showcaseSites = [
    'plombier' => [
        'title' => 'Démo Plombier',
        'sector' => 'Artisan local',
        'result' => 'Recevoir des appels rapidement',
        'image' => '/images/demo-plombier.webp',
        'url' => 'https://demo-plombier.guillaumemaignaut.com/',
    ],
    'restaurant' => [
        'title' => 'Le Jardin Gourmand',
        'sector' => 'Restaurant local',
        'image' => '/images/demo-restaurant.webp',
        'url' => 'https://demo-restaurant.guillaumemaignaut.com/',
    ],
    'coach' => [
        'title' => 'Démo Coach sportif',
        'sector' => 'Service indépendant',
        'result' => 'Expliquer l’offre et déclencher un bilan',
        'image' => '/images/demo-coach.webp',
        'url' => 'https://demo-coach.guillaumemaignaut.com/',
    ],
];

$processSteps = [
    [
        'number' => '01',
        'title' => 'Cadrer l’objectif',
        'description' => 'On clarifie votre activité, votre cible, vos contenus prioritaires et l’action attendue : appel, devis, réservation ou formulaire.',
    ],
    [
        'number' => '02',
        'title' => 'Construire la page',
        'description' => 'Je prépare une structure lisible, puis j’intègre un site adapté au mobile avec des textes courts, des appels à l’action visibles et un formulaire utilisable.',
    ],
    [
        'number' => '03',
        'title' => 'Mettre en ligne',
        'description' => 'On vérifie l’affichage mobile, le formulaire, les liens, les bases SEO et les points essentiels avant publication.',
    ],
];

$offerGroups = [
    [
        'id' => 'site-existant',
        'number' => '01',
        'title' => 'J’ai déjà un site',
        'description' => 'Réparer un problème, améliorer une page ou faire évoluer votre site.',
        'offers' => [
            [
                'id' => 'correction-express',
                'title' => 'Correction web express',
                'price' => '99 €',
                'description' => 'Pour résoudre un problème précis : un formulaire qui bloque, un bouton cassé ou un défaut d’affichage.',
                'included' => ['Un problème et un périmètre définis ensemble', 'Correction et vérification du point traité'],
                'cta' => 'Demander une correction',
            ],
            [
                'id' => 'amelioration',
                'title' => 'Amélioration de site existant',
                'price' => '199 €',
                'description' => 'Pour rendre une page ou un parcours plus clair, plus pratique sur mobile ou plus simple à utiliser.',
                'included' => ['Un objectif et des priorités définis ensemble', 'Ajustements ciblés et vérification sur mobile'],
                'cta' => 'Améliorer mon site',
            ],
            [
                'id' => 'refonte-maintenance',
                'title' => 'Refonte ou maintenance',
                'price' => null,
                'description' => 'Pour revoir plusieurs pages, faire évoluer le site ou prévoir un suivi régulier.',
                'included' => ['Analyse de l’existant et priorités', 'Périmètre, délai et mise en ligne selon le besoin'],
                'cta' => 'Discuter de mon site',
            ],
        ],
    ],
    [
        'id' => 'creation-site',
        'number' => '02',
        'title' => 'Je veux créer un site',
        'description' => 'Présenter votre activité ou donner une page dédiée à une offre.',
        'offers' => [
            [
                'id' => 'landing-page',
                'title' => 'Landing page',
                'price' => '450 €',
                'delay' => '1 à 2 semaines selon les contenus fournis.',
                'description' => 'Une page dédiée à une offre, une campagne ou un lancement.',
                'included' => ['Une page adaptée au mobile, avec boutons de contact visibles', 'Formulaire protégé et mise en ligne initiale'],
                'cta' => 'Demander une landing page',
            ],
            [
                'id' => 'site-vitrine',
                'title' => 'Site vitrine',
                'price' => '900 €',
                'delay' => '2 à 4 semaines selon les pages et les contenus.',
                'description' => 'Un site pour présenter votre activité, vos services et faciliter les demandes de contact.',
                'included' => ['4 à 5 pages et une navigation claire', 'Formulaire protégé, bases SEO et mise en ligne initiale'],
                'cta' => 'Demander un site vitrine',
            ],
        ],
    ],
];

$featuredDemo = $showcaseSites['restaurant'];
$otherDemos = [$showcaseSites['plombier'], $showcaseSites['coach']];
$escape = static fn (string $value): string => htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
?>

<div class="creative-home">
    <section class="hero" data-studio-hero aria-labelledby="studio-title">
        <div class="shell studio-hero-inner">
            <p class="studio-hero-kicker mono"><span class="signal" aria-hidden="true"></span> Développeur web indépendant <span class="hero-place">/ Fleurance, Gers</span></p>
            <div class="hero-composition">
                <div class="studio-hero-copy">
                    <h1 id="studio-title" class="headline">
                        <span class="headline-line"><span>Le web</span></span>
                        <span class="headline-line"><span>prend <em>forme.</em></span></span>
                    </h1>
                    <p class="hero-lead">Je crée, corrige et améliore les sites web des artisans, indépendants et petites entreprises du Gers.</p>
                    <div class="studio-hero-actions">
                        <a class="action" href="#realisations">Explorer le projet <span aria-hidden="true">↓</span></a>
                        <a class="text-link" href="/contact">Parlons de votre site <span aria-hidden="true">↗</span></a>
                    </div>
                </div>

                <figure class="hero-figure">
                    <svg class="orbit" viewBox="0 0 550 400" fill="none" aria-hidden="true">
                        <ellipse cx="282" cy="203" rx="258" ry="134" transform="rotate(-25 282 203)"/>
                        <ellipse cx="282" cy="203" rx="225" ry="170" transform="rotate(22 282 203)" stroke-dasharray="2 6"/>
                        <path d="M282 12v30m-15-15h30M488 55v34m-17-17h34M53 307v26m-13-13h26M492 311l31 32m-31 0 31-32"/>
                        <circle cx="477" cy="132" r="5" class="orbit-point"/>
                    </svg>
                    <div class="hero-visual">
                        <img src="<?= $escape($featuredDemo['image']) ?>" width="1200" height="933" alt="Capture du Jardin Gourmand, avec l’identité du restaurant et les plats de la carte" fetchpriority="high">
                    </div>
                    <figcaption class="hero-caption mono"><span><b>Fig. 01</b> / <?= $escape($featuredDemo['title']) ?></span><span>Démo web</span></figcaption>
                </figure>
            </div>
            <div class="hero-foot mono">
                <div class="hero-quick-links"><a href="#offers">Interventions dès 99 €</a><a href="#audit-gratuit">Audit gratuit</a></div>
                <button type="button" class="replay" hidden><span aria-hidden="true">↻</span> Rejouer l’entrée</button>
            </div>
        </div>
    </section>

    <div class="splice mono" aria-hidden="true">
        <div class="shell splice-inner"><span>Du premier écran au projet</span><span class="splice-line"></span><span>↓ &nbsp; 01</span></div>
    </div>

    <section class="project" id="realisations" aria-labelledby="projet-titre">
        <div class="shell">
            <header class="project-header" data-enter>
                <div class="project-label mono"><span class="project-index">01</span><span>Étude de démo<br>Restaurant · Carte en ligne</span></div>
                <h2 id="projet-titre">De la carte<br><em>à la réservation.</em></h2>
                <p>Donner envie de découvrir la carte et rendre la réservation facile à trouver. Trois choix d’interface structurent le parcours de cette démo.</p>
            </header>

            <div class="project-grid">
                <figure class="project-figure" data-enter>
                    <div class="project-view">
                        <div class="project-image">
                            <img src="<?= $escape($featuredDemo['image']) ?>" width="1200" height="933" alt="Démo Le Jardin Gourmand : identité du restaurant, accès à la réservation et carte avec photos, descriptions et prix" loading="lazy" decoding="async">
                            <div class="zone zone-1" aria-hidden="true"></div>
                            <div class="zone zone-2" aria-hidden="true"></div>
                            <div class="zone zone-3" aria-hidden="true"></div>
                        </div>
                    </div>
                    <figcaption class="project-caption mono"><span>Le Jardin Gourmand</span><span>Capture de la démo</span></figcaption>
                </figure>

                <div class="project-notes">
                    <p class="notes-title mono">Dans l’interface <span aria-hidden="true">↖</span></p>
                    <p class="notes-hint">Sélectionnez un repère pour le retrouver dans la capture.</p>
                    <ol class="annotations">
                        <li>
                            <button type="button" data-zone="1" aria-pressed="false">
                                <span class="annotation-index mono" aria-hidden="true">01</span>
                                <span><strong>Une identité lisible</strong><small>Le nom, le ton et le lieu donnent le contexte dès le premier écran.</small></span>
                                <span class="annotation-arrow" aria-hidden="true">↖</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" data-zone="2" aria-pressed="false">
                                <span class="annotation-index mono" aria-hidden="true">02</span>
                                <span><strong>La carte à parcourir</strong><small>Les photos, les prix et les descriptions aident à parcourir les plats.</small></span>
                                <span class="annotation-arrow" aria-hidden="true">↖</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" data-zone="3" aria-pressed="false">
                                <span class="annotation-index mono" aria-hidden="true">03</span>
                                <span><strong>Réserver facilement</strong><small>La réservation a une place dédiée dans la navigation.</small></span>
                                <span class="annotation-arrow" aria-hidden="true">↖</span>
                            </button>
                        </li>
                    </ol>
                    <a class="project-link" href="<?= $escape($featuredDemo['url']) ?>" target="_blank" rel="noopener noreferrer">Ouvrir la démo Restaurant <span aria-hidden="true">↗</span><span class="sr-only"> (nouvel onglet)</span></a>
                </div>
            </div>
            <div class="more">
                <h3 class="mono" id="autres-titre">Autres démonstrations</h3>
                <ul class="more-list" aria-labelledby="autres-titre">
                    <?php foreach ($otherDemos as $index => $demo): ?>
                        <li>
                            <a href="<?= $escape($demo['url']) ?>" target="_blank" rel="noopener noreferrer">
                                <img src="<?= $escape($demo['image']) ?>" width="1200" height="933" alt="" loading="lazy" decoding="async">
                                <span><small class="mono">0<?= $index + 2 ?> / <?= $escape($demo['sector']) ?></small><strong><?= $escape($demo['title']) ?></strong><span class="more-result"><?= $escape($demo['result']) ?></span></span>
                                <span class="more-arrow" aria-hidden="true">↗</span><span class="sr-only"> (nouvel onglet)</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

    <section id="offers" class="studio-chapter studio-offers" aria-labelledby="titre-offres">
        <div class="shell">
            <header class="chapter-heading" data-enter>
                <p class="mono chapter-label">02 / Tarifs et offres</p>
                <h2 id="titre-offres">Le bon format <em>pour votre site.</em></h2>
                <p>Les prix restent ajustés selon le contenu, les fonctionnalités et le niveau d’accompagnement attendu.</p>
            </header>

            <?php foreach ($offerGroups as $group): ?>
                <div class="offer-group" role="group" aria-labelledby="offre-<?= $escape($group['id']) ?>">
                    <header class="offer-group-heading">
                        <span class="mono" aria-hidden="true"><?= $escape($group['number']) ?></span>
                        <div>
                            <h3 id="offre-<?= $escape($group['id']) ?>"><?= $escape($group['title']) ?></h3>
                            <p><?= $escape($group['description']) ?></p>
                        </div>
                    </header>

                    <?php foreach ($group['offers'] as $offer): ?>
                        <article class="offer-row">
                            <div class="offer-intro">
                                <h4><?= $escape($offer['title']) ?></h4>
                                <p><?= $escape($offer['description']) ?></p>
                            </div>
                            <div class="offer-details">
                                <p class="mono">Inclus</p>
                                <ul>
                                    <?php foreach ($offer['included'] as $item): ?>
                                        <li><?= $escape($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if (isset($offer['delay'])): ?>
                                    <p class="offer-delay">Délai indicatif : <?= $escape($offer['delay']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="offer-quote">
                                <p class="offer-price">
                                    <?php if ($offer['price'] !== null): ?><small>Dès</small> <?= $escape($offer['price']) ?>
                                    <?php else: ?>Sur devis<?php endif; ?>
                                </p>
                                <a class="text-link" href="/contact?offre=<?= rawurlencode($offer['id']) ?>#formulaire">
                                    <?= $escape($offer['cta']) ?> <span aria-hidden="true">↗</span>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <p class="offers-note">TVA non applicable selon le régime en vigueur. Hébergement, nom de domaine, rédaction complète, identité visuelle complète et maintenance mensuelle ne sont pas inclus par défaut. Je peux vous orienter sur ces points si besoin.</p>
        </div>
    </section>

    <section id="audit-gratuit" class="studio-chapter studio-audit" aria-labelledby="titre-audit">
        <div class="shell audit-layout">
            <div class="audit-figure" aria-hidden="true"><strong>03</strong><span class="mono">Priorités par email</span></div>
            <div class="chapter-heading" data-enter>
                <p class="mono chapter-label">Audit gratuit</p>
                <h2 id="titre-audit">Que peut-on améliorer sur <em>votre site ?</em></h2>
                <p>Je regarde ce qui bloque sur mobile, ce qui manque pour rassurer vos visiteurs et ce qui peut faciliter la prise de contact. Vous recevez trois priorités concrètes par email.</p>
                <div class="chapter-actions">
                    <a class="action" href="/contact?offre=audit-gratuit#formulaire">Demander un audit gratuit <span aria-hidden="true">↗</span></a>
                    <a class="text-link" href="#offers">Voir les offres <span aria-hidden="true">↑</span></a>
                </div>
            </div>
        </div>
    </section>

    <div class="studio-paper">
        <section id="services" class="studio-chapter" aria-labelledby="titre-services">
            <div class="shell services-layout">
                <header class="chapter-heading" data-enter>
                    <p class="mono chapter-label">03 / Services</p>
                    <h2 id="titre-services">Ce que je soigne <em>sur votre site.</em></h2>
                    <p>Qu’il s’agisse d’une correction, d’une landing page ou d’un site vitrine, je travaille les points qui aident vos visiteurs à passer à l’action.</p>
                </header>
                <dl class="service-list">
                    <div><dt><span class="mono" aria-hidden="true">01</span> Lisibilité et mobile</dt><dd>Une offre facile à comprendre et une interface utilisable sur petit écran.</dd></div>
                    <div><dt><span class="mono" aria-hidden="true">02</span> Parcours de contact</dt><dd>Des actions visibles, des liens vérifiés et des formulaires protégés.</dd></div>
                    <div><dt><span class="mono" aria-hidden="true">03</span> Rapidité</dt><dd>Des pages et des images qui se chargent sans attendre inutilement.</dd></div>
                    <div><dt><span class="mono" aria-hidden="true">04</span> Bases SEO</dt><dd>Des titres, des contenus et une structure qui rendent chaque page compréhensible.</dd></div>
                </dl>
            </div>
        </section>

        <section id="methode" class="studio-chapter studio-process" aria-labelledby="titre-methode">
            <div class="shell">
                <header class="chapter-heading" data-enter>
                    <p class="mono chapter-label">04 / Méthode</p>
                    <h2 id="titre-methode">Trois étapes, <em>du brief au site.</em></h2>
                </header>
                <ol class="process-track">
                    <?php foreach ($processSteps as $step): ?>
                        <li>
                            <span class="mono" aria-hidden="true"><?= $escape($step['number']) ?></span>
                            <h3><?= $escape($step['title']) ?></h3>
                            <p><?= $escape($step['description']) ?></p>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </section>
    </div>

    <section id="about" class="studio-chapter studio-about" aria-labelledby="titre-about">
        <div class="shell about-layout">
            <figure class="about-portrait">
                <img src="/images/photo_profil.jpg" alt="Portrait de Guillaume Maignaut" width="240" height="240" loading="lazy" decoding="async">
                <figcaption class="mono">Guillaume Maignaut / Fleurance, Gers</figcaption>
            </figure>
            <div class="chapter-heading" data-enter>
                <p class="mono chapter-label">05 / À propos</p>
                <h2 id="titre-about">Des sites utiles, <em>faits dans le Gers.</em></h2>
                <p>Je suis Guillaume, développeur web indépendant à Fleurance. Je privilégie les échanges simples, les priorités concrètes et un code qui reste facile à faire évoluer.</p>
                <p>J’accompagne les professionnels autour de Fleurance, Auch, Lectoure et Condom, ainsi qu’à distance.</p>
                <a class="text-link" href="/portfolio">Consulter mes projets techniques <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </section>

    <section id="contact" class="studio-chapter studio-contact" aria-labelledby="titre-contact">
        <div class="shell contact-layout">
            <header class="chapter-heading" data-enter>
                <p class="mono chapter-label">06 / Contact</p>
                <h2 id="titre-contact">Parlons de <em>votre site.</em></h2>
                <p>Décrivez-moi votre projet, votre délai et votre objectif. Si vous avez déjà un site, je peux commencer par un audit gratuit.</p>
            </header>
            <div class="chapter-actions">
                <a class="action" href="/contact#formulaire">Remplir le formulaire <span aria-hidden="true">↗</span></a>
                <a class="text-link" href="mailto:maignaut.g@gmail.com">Envoyer un email <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </section>
</div>

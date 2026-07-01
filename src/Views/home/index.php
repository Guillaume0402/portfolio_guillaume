<?php
$showcaseSites = [
    [
        'title' => 'Démo Plombier',
        'sector' => 'Artisan local',
        'status' => 'Démo en ligne',
        'result' => 'Recevoir des appels rapidement',
        'description' => 'Un parcours court pour présenter les urgences, rassurer vite et faciliter la prise de contact depuis mobile.',
        'tags' => ['Urgence locale', 'Formulaire', 'Mobile first'],
        'image' => '/images/demo-plombier.webp',
        'alt' => 'Capture du site démo plombier avec hero, formulaire et services',
        'url' => 'https://demo-plombier.guillaumemaignaut.com/',
    ],
    [
        'title' => 'Démo Restaurant',
        'sector' => 'Restaurant local',
        'status' => 'Démo en ligne',
        'result' => 'Présenter la carte et faciliter la réservation',
        'description' => 'Une présentation claire avec carte, informations pratiques et réservation simulée pour aider les clients à passer à l’action.',
        'tags' => ['Carte en ligne', 'Réservation', 'Images produit'],
        'image' => '/images/demo-restaurant.webp',
        'alt' => 'Capture du site démo restaurant avec menu et plats',
        'url' => 'https://demo-restaurant.guillaumemaignaut.com/',
    ],
    [
        'title' => 'Démo Coach Sportif',
        'sector' => 'Service indépendant',
        'status' => 'Démo en ligne',
        'result' => 'Expliquer l’offre et déclencher un bilan',
        'description' => 'Une landing page qui met en avant l’offre, la preuve, les tarifs et un appel à l’action visible pour demander un bilan.',
        'tags' => ['Landing page', 'Offres', 'Conversion'],
        'image' => '/images/demo-coach.webp',
        'alt' => 'Capture du site démo coach sportif avec hero et offres',
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

$offers = [
    [
        'title' => 'Landing page',
        'price' => 'À partir de 450 €',
        'delay' => 'Délai indicatif : 1 à 2 semaines selon les contenus fournis.',
        'description' => 'Pour une offre précise, une campagne, un lancement ou une prise de contact rapide.',
        'included' => [
            '1 page complète orientée conversion',
            'structure claire avec boutons de contact visibles',
            'formulaire de contact protégé',
            'affichage adapté au mobile, à la tablette et à l’ordinateur',
            'mise en ligne initiale',
        ],
    ],
    [
        'title' => 'Site vitrine',
        'price' => 'À partir de 900 €',
        'delay' => 'Délai indicatif : 2 à 4 semaines selon le nombre de pages et les contenus.',
        'description' => 'Pour présenter votre activité, vos services et recevoir des demandes de contact.',
        'label' => 'Le plus demandé',
        'featured' => true,
        'included' => [
            '4 à 5 pages principales',
            'arborescence et navigation simples',
            'formulaire de contact protégé',
            'base SEO technique propre',
            'mise en ligne initiale',
        ],
    ],
    [
        'title' => 'Refonte ou maintenance',
        'price' => 'Sur devis',
        'delay' => 'Délai indicatif : selon les corrections et les évolutions à prévoir.',
        'description' => 'Pour améliorer un site existant, corriger un blocage ou ajouter une évolution ciblée.',
        'included' => [
            'analyse rapide de l’existant',
            'priorités expliquées clairement',
            'corrections ou évolutions ciblées',
            'ajustements mobile si nécessaire',
            'mise en ligne si nécessaire',
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
                            <span class="hero-kicker-role">Création de sites vitrines & landing pages</span>
                        </span>
                    </p>

                    <p class="hero-local-anchor">Développeur web freelance dans le Gers — sites vitrines pour artisans, indépendants et petites entreprises locales.</p>

                    <h1 class="hero-title">Sites vitrines pour artisans, indépendants et petites entreprises dans le Gers.</h1>

                    <p class="hero-subtitle">
                        Je crée des sites simples, rapides et adaptés au mobile pour présenter votre activité,
                        rassurer vos visiteurs et faciliter la prise de contact.
                    </p>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="/contact">Demander un premier retour</a>
                        <a class="btn btn-ghost" href="#realisations">Voir les démos</a>
                    </div>

                    <p class="hero-audit-link">
                        Vous avez déjà un site ? <a href="#audit-gratuit">Demandez un audit gratuit.</a>
                    </p>

                    <div class="hero-badges" aria-label="Services principaux">
                        <span class="badge">Site vitrine</span>
                        <span class="badge">Landing page</span>
                        <span class="badge">Adapté au mobile</span>
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

                <aside class="hero-offer-panel hero-demo-panel" aria-label="Exemples et preuves de l'offre">
                    <div class="hero-offer-content">
                        <p class="panel-kicker">Preuves visibles</p>
                        <h2>3 démos en ligne pour voir le résultat avant de me contacter.</h2>

                        <div class="hero-demo-stack">
                            <?php foreach ($showcaseSites as $index => $site): ?>
                                <a class="hero-demo-link" href="<?= htmlspecialchars($site['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">
                                    <span class="hero-demo-index">0<?= $index + 1 ?></span>
                                    <span>
                                        <strong><?= htmlspecialchars($site['sector'], ENT_QUOTES, 'UTF-8') ?></strong>
                                        <span><?= htmlspecialchars($site['result'], ENT_QUOTES, 'UTF-8') ?></span>
                                    </span>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <div class="hero-panel-metrics" aria-label="Points clés">
                            <span>Adapté au mobile</span>
                            <span>Boutons de contact visibles</span>
                            <span>Formulaire prêt</span>
                        </div>

                        <a class="panel-link" href="#realisations">Voir les démos</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section id="realisations" class="section section-featured">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Démos concrètes</p>
                <h2>Trois exemples pour voir le résultat attendu</h2>
                <p>Ces démos montrent des parcours simples : comprendre l’offre, se rassurer, puis contacter ou réserver.</p>
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
                            <div class="showcase-meta">
                                <p class="showcase-status"><?= htmlspecialchars($site['status'], ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="showcase-sector"><?= htmlspecialchars($site['sector'], ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                            <h3><?= htmlspecialchars($site['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p class="showcase-result"><?= htmlspecialchars($site['result'], ENT_QUOTES, 'UTF-8') ?></p>
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
                <a class="btn btn-primary btn-lg" href="/contact">Demander un premier retour</a>
                <a class="btn btn-ghost btn-lg" href="#offers">Voir les tarifs</a>
            </div>
        </div>
    </section>

    <section id="audit-gratuit" class="section audit-section">
        <div class="container">
            <div class="audit-card reveal">
                <div class="audit-copy">
                    <p class="section-kicker">Audit gratuit</p>
                    <h2>Vous avez déjà un site, mais il ne vous apporte pas assez de contacts ?</h2>
                    <p>
                        Je regarde votre page et je vous envoie 3 priorités concrètes :
                        ce qui bloque sur mobile, ce qui manque pour rassurer vos visiteurs
                        et ce qui peut améliorer les demandes de contact.
                    </p>
                    <p class="audit-note">Audit gratuit rapide : 3 points prioritaires envoyés par email.</p>
                </div>

                <div class="audit-actions">
                    <a class="btn btn-primary btn-lg" href="/contact">Demander un audit gratuit</a>
                    <a class="btn btn-ghost btn-lg" href="#offers">Voir les offres</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="section">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Services</p>
                <h2>Des pages faites pour aider vos clients à passer à l’action</h2>
                <p>Des prestations simples, adaptées aux besoins courants des indépendants, artisans et petites entreprises.</p>
            </header>

            <div class="service-grid">
                <article class="service-card reveal">
                    <span class="service-number">01</span>
                    <h3>Site vitrine</h3>
                    <p>Un site clair pour présenter votre activité, rassurer vos visiteurs et recevoir des demandes de contact.</p>
                </article>

                <article class="service-card reveal">
                    <span class="service-number">02</span>
                    <h3>Landing page</h3>
                    <p>Une page ciblée pour expliquer une offre, guider la lecture et mettre en avant le bon appel à l’action.</p>
                </article>

                <article class="service-card reveal">
                    <span class="service-number">03</span>
                    <h3>Refonte web</h3>
                    <p>Une amélioration ciblée de votre site : structure, lisibilité, affichage mobile, vitesse et parcours plus fluide.</p>
                </article>

                <article class="service-card reveal">
                    <span class="service-number">04</span>
                    <h3>Formulaires & SEO technique</h3>
                    <p>Des formulaires fiables et une structure saine pour être compréhensible par Google dès le départ.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section process-section">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Méthode</p>
                <h2>Une méthode courte pour avancer sans flou</h2>
                <p>Le but : garder le projet compréhensible, priorisé et prêt à être mis en ligne proprement.</p>
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

    <section id="offers" class="section">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Tarifs et offres</p>
                <h2>Des offres lisibles pour cadrer le budget</h2>
                <p>Les prix restent ajustés selon le contenu, les fonctionnalités et le niveau d’accompagnement attendu.</p>
            </header>

            <div class="offers-grid">
                <?php foreach ($offers as $offer): ?>
                    <article class="offer-card <?= !empty($offer['featured']) ? 'offer-card-featured' : '' ?> reveal">
                        <?php if (!empty($offer['label'])): ?>
                            <p class="offer-label"><?= htmlspecialchars($offer['label'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>

                        <h3><?= htmlspecialchars($offer['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p class="offer-price"><?= htmlspecialchars($offer['price'], ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="offer-delay"><?= htmlspecialchars($offer['delay'], ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="offer-summary"><?= htmlspecialchars($offer['description'], ENT_QUOTES, 'UTF-8') ?></p>

                        <div class="offer-details">
                            <p class="offer-list-title">Inclus</p>
                            <ul class="offer-list">
                                <?php foreach ($offer['included'] as $item): ?>
                                    <li><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <a class="btn btn-primary offer-cta" href="/contact">Demander un devis</a>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="offers-note reveal">
                <p>TVA non applicable selon le régime en vigueur. Hébergement, nom de domaine, rédaction complète, identité visuelle complète et maintenance mensuelle ne sont pas inclus par défaut. Je peux vous orienter sur ces points si besoin.</p>
            </div>
        </div>
    </section>

    <section id="about" class="section">
        <div class="container about-grid">
            <header class="section-header reveal">
                <p class="section-kicker">À propos</p>
                <h2>Un accompagnement simple, clair et réaliste</h2>
                <p>Je construis des sites sobres, lisibles et maintenables pour aider vos visiteurs à comprendre vite pourquoi vous contacter.</p>
            </header>

            <div class="about-card reveal">
                <div class="about-profile">
                    <figure class="about-photo">
                        <img
                            src="/images/photo_profil.jpg"
                            alt="Portrait de Guillaume Maignaut, développeur web freelance"
                            width="240"
                            height="240"
                            loading="lazy">
                    </figure>

                    <div class="about-content">
                        <p class="about-name">Guillaume Maignaut</p>
                        <p class="about-text">
                            Mon objectif est de livrer un site utile : une structure claire, des contenus bien hiérarchisés, un affichage mobile propre et un formulaire qui fonctionne.
                        </p>
                        <p class="about-text">
                            Je privilégie les échanges simples, les priorités concrètes et un code compréhensible pour que votre site reste facile à faire évoluer.
                        </p>
                        <p class="about-text">
                            Basé dans le Gers, j’accompagne les professionnels autour de Fleurance, Auch, Lectoure, Condom et les communes voisines, à distance ou avec des échanges simples par téléphone, email ou visio.
                        </p>
                        <p class="about-text">
                            Vous pouvez aussi consulter <a class="about-link" href="/portfolio">mes projets techniques</a>.
                        </p>
                    </div>
                </div>
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
                        <p class="contact-lead">Décrivez-moi votre projet, votre délai et votre objectif. Si vous avez déjà un site, je peux aussi vous envoyer un audit gratuit rapide avec 3 priorités concrètes.</p>
                    </div>
                    <div class="contact-actions">
                        <a class="btn btn-primary btn-lg" href="/contact">Remplir le formulaire</a>
                        <a class="btn btn-ghost btn-lg" href="mailto:g.maignaut@gmail.com">Envoyer un email</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

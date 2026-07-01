<?php
$safeImage = static function (?string $image): string {
    $filename = basename(trim((string) $image));

    if ($filename === '' || !preg_match('/\A[a-zA-Z0-9._-]+\.(?:avif|webp|png|jpe?g|svg)\z/i', $filename)) {
        return 'default.webp';
    }

    return $filename;
};

$safeHttpsUrl = static function (?string $url): ?string {
    $url = trim((string) $url);

    if ($url === '' || !filter_var($url, FILTER_VALIDATE_URL)) {
        return null;
    }

    return parse_url($url, PHP_URL_SCHEME) === 'https' ? $url : null;
};

$projectDescriptions = [
    'EcoRide' => 'Projet full stack avec rôles utilisateurs, trajets, crédits et notifications. Il montre ma capacité à gérer une logique métier plus complète qu’un simple site vitrine.',
    'Tichylist' => 'Application de gestion de tâches avec comptes utilisateurs, authentification et suivi de projets. Ce projet montre ma capacité à structurer une application avec espace privé et données sécurisées.',
    'TutoPHP' => 'Site pédagogique autour de PHP vanilla, pensé pour rendre des notions techniques accessibles. Il montre ma capacité à organiser du contenu, clarifier un parcours et construire une interface lisible.',
];

$skillBadges = [
    'PHP',
    'JavaScript',
    'HTML',
    'CSS / Sass',
    'Docker',
    'Linux',
    'SQL',
    'NoSQL',
];
?>

<section class="container-app hero-section portfolio-hero">
        <div class="container hero-inner">
            <div class="hero-media reveal">
                <div class="hero-copy">
                    <p class="hero-kicker">
                        <span class="hero-kicker-text">
                            <span class="hero-kicker-name">Portfolio</span>
                            <span class="hero-kicker-role">Réalisations et compétences</span>
                        </span>
                    </p>

                    <h1 class="hero-title">Projets techniques</h1>
                    <p class="hero-subtitle">
                        Une sélection de projets réalisés pour montrer ma façon de structurer une interface,
                        gérer des données et construire du code maintenable.
                    </p>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="/contact">Discuter d'un projet</a>
                        <a class="btn btn-ghost" href="/#services">Voir les services</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="projects" class="section">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Réalisations</p>
                <h2>Ce que ces projets démontrent</h2>
                <p>Chaque projet illustre une compétence utile pour construire un site fiable, clair et évolutif.</p>
            </header>

            <?php if (empty($projects)): ?>
                <p class="empty-state">Aucun projet pour le moment.</p>
            <?php else: ?>
                <div class="cards-grid">
                    <?php foreach ($projects as $project): ?>
                        <?php
                        $img = $safeImage($project['image'] ?? null);
                        $githubLink = $safeHttpsUrl($project['github_link'] ?? null);
                        $projectLink = $safeHttpsUrl($project['project_link'] ?? null);
                        $displayDescription = $projectDescriptions[$project['title'] ?? ''] ?? ($project['description'] ?? '');
                        ?>

                        <article class="card reveal">
                            <div class="card-body">
                                <div class="card-top">
                                    <h3 class="card-title">
                                        <?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>
                                    </h3>

                                    <div class="card-media">
                                        <img
                                            loading="lazy"
                                            src="/images/<?= htmlspecialchars($img, ENT_QUOTES, 'UTF-8') ?>"
                                            alt="Aperçu du projet <?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>">
                                    </div>

                                    <?php if (!empty($displayDescription)): ?>
                                        <div class="card-description">
                                            <p class="card-text">
                                                <?= htmlspecialchars($displayDescription, ENT_QUOTES, 'UTF-8') ?>
                                            </p>

                                            <button type="button" class="card-text-toggle">
                                                Lire plus
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php $stacks = array_filter(array_map('trim', explode(',', $project['tech_stack'] ?? ''))); ?>

                            <div class="tag-row" aria-label="Technologies">
                                <?php foreach ($stacks as $stack): ?>
                                    <span class="tag"><?= htmlspecialchars($stack, ENT_QUOTES, 'UTF-8') ?></span>
                                <?php endforeach; ?>
                            </div>

                            <div class="btn-projects">
                                <?php if ($githubLink !== null): ?>
                                    <div class="card-actions">
                                        <a
                                            class="card-link"
                                            href="<?= htmlspecialchars($githubLink, ENT_QUOTES, 'UTF-8') ?>"
                                            aria-label="Voir le GitHub du projet <?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>"
                                            target="_blank"
                                            rel="noopener noreferrer">
                                            GitHub
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($projectLink !== null): ?>
                                    <div class="card-actions">
                                        <a
                                            class="card-link"
                                            href="<?= htmlspecialchars($projectLink, ENT_QUOTES, 'UTF-8') ?>"
                                            aria-label="Voir le projet <?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>"
                                            target="_blank"
                                            rel="noopener noreferrer">
                                            Voir le projet
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section id="skills" class="section">
        <div class="container">
            <header class="section-header reveal">
                <p class="section-kicker">Compétences</p>
                <h2>Stack technique</h2>
                <p>Front-end, back-end PHP, base de données, affichage mobile et outils de développement.</p>
            </header>

            <div class="chips-grid" aria-label="Compétences">
                <?php foreach ($skillBadges as $skill): ?>
                    <span class="chip reveal">
                        <?= htmlspecialchars($skill, ENT_QUOTES, 'UTF-8') ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

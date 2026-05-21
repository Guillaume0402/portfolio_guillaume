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

                    <h1 class="hero-title">Des projets web concrets, pensés pour être lisibles et maintenables.</h1>
                    <p class="hero-subtitle">
                        Retrouvez ici une sélection de réalisations, avec les technologies utilisées et les liens disponibles.
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
                <h2>Projets</h2>
                <p>Une sélection de réalisations issues de la base de données.</p>
            </header>

            <?php if (empty($projects)): ?>
                <p class="empty-state">Aucun projet pour le moment.</p>
            <?php else: ?>
                <div class="cards-grid">
                    <?php foreach ($projects as $project): ?>
                        <?php $img = $project['image'] ?? 'default.webp'; ?>

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

                                    <?php if (!empty($project['description'])): ?>
                                        <div class="card-description">
                                            <p class="card-text">
                                                <?= htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8') ?>
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
                                <?php if (!empty($project['github_link'])): ?>
                                    <div class="card-actions">
                                        <a
                                            class="card-link"
                                            href="<?= htmlspecialchars($project['github_link'], ENT_QUOTES, 'UTF-8') ?>"
                                            aria-label="Voir le GitHub du projet <?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>"
                                            target="_blank"
                                            rel="noopener noreferrer">
                                            GitHub
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($project['project_link'])): ?>
                                    <div class="card-actions">
                                        <a
                                            class="card-link"
                                            href="<?= htmlspecialchars($project['project_link'], ENT_QUOTES, 'UTF-8') ?>"
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
                <p>Front-end, back-end PHP, base de données, intégration responsive et outils de développement.</p>
            </header>

            <div class="chips-grid" aria-label="Compétences">
                <?php foreach ($skills as $skill): ?>
                    <span class="chip reveal">
                        <?php if (!empty($skill['logo'])): ?>
                            <img
                                loading="lazy"
                                src="/images/<?= htmlspecialchars($skill['logo'], ENT_QUOTES, 'UTF-8') ?>"
                                alt="Logo de <?= htmlspecialchars($skill['name'], ENT_QUOTES, 'UTF-8') ?>">
                        <?php endif; ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

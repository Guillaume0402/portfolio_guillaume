<?php
use App\Security\Csrf;
?>

<section class="contact-page section">
    <div class="container contact-page-grid">
        <header class="contact-page-hero reveal">
            <p class="contact-page-kicker">Prenons contact</p>
            <h1 class="contact-page-title">Parlons de développement web, d’opportunités et de projets concrets.</h1>
            <p class="contact-page-lead">
                Tu peux me contacter pour échanger autour de mes projets, de mon parcours, d’une opportunité professionnelle, d’une collaboration ou d’un besoin en développement web. Mon objectif est de proposer des interfaces claires, fiables, maintenables et pensées pour durer.
            </p>
            <div class="contact-page-actions">
                <a class="btn btn-primary btn-lg" href="mailto:g.maignaut@gmail.com">Envoyer un email</a>
                <a class="btn btn-ghost btn-lg" href="https://www.linkedin.com/in/guillaume-maignaut-9b3464340/" target="_blank" rel="noopener noreferrer">LinkedIn</a>
            </div>
        </header>

        <aside class="contact-page-panel reveal" aria-label="Informations de contact">
            <h2>Infos directes</h2>
            <ul class="contact-list">
                <li>
                    <span class="contact-label">Email</span>
                    <a href="mailto:g.maignaut@gmail.com">g.maignaut@gmail.com</a>
                </li>
                <li>
                    <span class="contact-label">Telephone</span>
                    <a href="tel:+33650428039">+33 6 50 42 80 39</a>
                </li>
                <li>
                    <span class="contact-label">Disponibilite</span>
                    <span>Opportunités professionnelles, collaborations et missions freelance</span>
                </li>
            </ul>
        </aside>
    </div>

    <div class="container contact-form-wrap reveal">
        <article class="contact-form-card">
            <h2>Me contacter</h2>
            <p>
                Vous souhaitez me contacter à propos d'un projet, d'une opportunité professionnelle ou pour échanger sur mes compétences en développement web ? Ce formulaire est fait pour vous.
            </p>
            <?php if (!empty($errors['global'])): ?>
                <p class="form-error">
                    <?= htmlspecialchars($errors['global']) ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <p class="form-success">
                    <?= htmlspecialchars($success) ?>
                </p>
            <?php endif; ?>

            <form class="contact-form" action="/contact/submit" method="post">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <div class="field-row">
                    <label class="field" for="nom">
                        <span>Nom</span>
                        <input
                            id="nom"
                            name="nom"
                            type="text"
                            value="<?= htmlspecialchars($old['nom'] ?? '') ?>"
                            required>
                        <?php if (!empty($errors['nom'])): ?>
                            <small class="field-error"><?= htmlspecialchars($errors['nom']) ?></small>
                        <?php endif; ?>
                    </label>

                    <label class="field" for="email">
                        <span>Email</span>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                            required>
                        <?php if (!empty($errors['email'])): ?>
                            <small class="field-error"><?= htmlspecialchars($errors['email']) ?></small>
                        <?php endif; ?>
                    </label>
                </div>

                <label class="field" for="sujet">
                    <span>Sujet</span>
                    <input
                        id="sujet"
                        name="sujet"
                        type="text"
                        value="<?= htmlspecialchars($old['sujet'] ?? '') ?>"
                        required>
                    <?php if (!empty($errors['sujet'])): ?>
                        <small class="field-error"><?= htmlspecialchars($errors['sujet']) ?></small>
                    <?php endif; ?>
                </label>

                <label class="field" for="message">
                    <span>Message</span>
                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        required><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
                    <?php if (!empty($errors['message'])): ?>
                        <small class="field-error"><?= htmlspecialchars($errors['message']) ?></small>
                    <?php endif; ?>
                </label>

                <button class="btn btn-primary btn-lg" type="submit">Envoyer votre message</button>
            </form>
        </article>
    </div>
</section>
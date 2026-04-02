<?php
use App\Security\Csrf;
?>

<section class="contact-page section">
    <div class="container contact-page-grid">
        <header class="contact-page-hero reveal">
            <p class="contact-page-kicker">Discutons de votre projet</p>
            <h1 class="contact-page-title">Une idée en tete ? Je peux la transformer en site web concret et fiable.</h1>
            <p class="contact-page-lead">
                Je reponds rapidement pour cadrer votre besoin, definir les priorites
                et proposer une solution claire, performante et maintenable.
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
                    <span>Freelance, collaborations, missions ponctuelles</span>
                </li>
            </ul>
        </aside>
    </div>

    <div class="container contact-form-wrap reveal">
        <article class="contact-form-card">
            <h2>Parlez-moi de votre besoin</h2>
            <p>
                Ce formulaire prepare votre message avant l'envoi par email.
                Je vous recontacte avec une proposition adaptee.
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

                <button class="btn btn-primary btn-lg" type="submit">Preparer mon email</button>
            </form>
        </article>
    </div>
</section>
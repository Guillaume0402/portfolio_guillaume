<?php

use App\Security\Csrf;

/** @var array<string, string> $errors */
/** @var array<string, string> $old */
/** @var string|null $success */
/** @var string $turnstileSiteKey */
/** @var string $turnstileAction */
/** @var array<string, string> $projectTypes */
/** @var array<string, string> $budgetOptions */
/** @var array<string, string> $deadlineOptions */

$errorAttributes = static function (string $field) use ($errors): string {
    return empty($errors[$field]) ? '' : 'aria-invalid="true" aria-describedby="' . $field . '-error"';
};
?>

<script
    src="https://challenges.cloudflare.com/turnstile/v0/api.js"
    async
    defer></script>

<section class="contact-page section">
    <?php if (!empty($errors['global']) || !empty($success)): ?>
        <div class="container contact-feedback" role="status">
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
        </div>
    <?php endif; ?>

    <div class="container contact-page-intro">
        <header class="contact-page-hero">
            <p class="contact-page-kicker">Développeur web freelance · Fleurance, Gers</p>
            <h1 class="contact-page-title">Parlons de votre site.</h1>
            <p class="contact-page-lead">
                Une correction, une amélioration ou un nouveau site ? Décrivez votre besoin et je vous dirai comment je peux vous aider.
            </p>
        </header>
    </div>

    <div class="container contact-page-grid">
        <article class="contact-form-card" id="formulaire" tabindex="-1" aria-labelledby="formulaire-titre">
            <h2 id="formulaire-titre">Me contacter</h2>

            <form class="contact-form" action="/contact/submit" method="post">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <label class="field spam-check" for="bot_check" aria-hidden="true">
                    <span>Ne pas remplir</span>
                    <input
                        id="bot_check"
                        name="bot_check"
                        type="text"
                        value=""
                        tabindex="-1"
                        autocomplete="off">
                </label>
                <div class="field-row">
                    <label class="field" for="nom">
                        <span>Nom</span>
                        <input
                            id="nom"
                            name="nom"
                            type="text"
                            autocomplete="name"
                            <?= $errorAttributes('nom') ?>
                            value="<?= htmlspecialchars($old['nom'] ?? '') ?>"
                            maxlength="100"
                            required>
                        <?php if (!empty($errors['nom'])): ?>
                            <small class="field-error" id="nom-error"><?= htmlspecialchars($errors['nom']) ?></small>
                        <?php endif; ?>
                    </label>

                    <label class="field" for="email">
                        <span>Email</span>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            <?= $errorAttributes('email') ?>
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                            maxlength="254"
                            required>
                        <?php if (!empty($errors['email'])): ?>
                            <small class="field-error" id="email-error"><?= htmlspecialchars($errors['email']) ?></small>
                        <?php endif; ?>
                    </label>
                </div>

                <label class="field" for="sujet">
                    <span>Sujet</span>
                    <input
                        id="sujet"
                        name="sujet"
                        type="text"
                        <?= $errorAttributes('sujet') ?>
                        placeholder="Ex : mon formulaire ne fonctionne plus"
                        value="<?= htmlspecialchars($old['sujet'] ?? '') ?>"
                        maxlength="150"
                        required>
                    <?php if (!empty($errors['sujet'])): ?>
                        <small class="field-error" id="sujet-error"><?= htmlspecialchars($errors['sujet']) ?></small>
                    <?php endif; ?>
                </label>

                <label class="field" for="site_actuel">
                    <span>Lien de votre site actuel <small>(facultatif)</small></span>
                    <input
                        id="site_actuel"
                        name="site_actuel"
                        type="text"
                        <?= $errorAttributes('site_actuel') ?>
                        placeholder="Ex : https://votre-site.fr"
                        value="<?= htmlspecialchars($old['site_actuel'] ?? '') ?>"
                        maxlength="300">
                    <?php if (!empty($errors['site_actuel'])): ?>
                        <small class="field-error" id="site_actuel-error"><?= htmlspecialchars($errors['site_actuel']) ?></small>
                    <?php endif; ?>
                </label>

                <fieldset class="choice-field" <?= $errorAttributes('type_projet') ?>>
                    <legend>Type de projet</legend>
                    <div class="choice-grid">
                        <?php foreach ($projectTypes as $value => $label): ?>
                            <label class="choice-option">
                                <input
                                    type="radio"
                                    name="type_projet"
                                    value="<?= htmlspecialchars($value) ?>"
                                    <?= (($old['type_projet'] ?? '') === $value) ? 'checked' : '' ?>
                                    required>
                                <span><?= htmlspecialchars($label) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <?php if (!empty($errors['type_projet'])): ?>
                        <small class="field-error" id="type_projet-error"><?= htmlspecialchars($errors['type_projet']) ?></small>
                    <?php endif; ?>
                </fieldset>

                <div class="field-row">
                    <fieldset class="choice-field" <?= $errorAttributes('budget') ?>>
                        <legend>Budget approximatif</legend>
                        <p class="choice-help">Si vous ne connaissez pas encore votre budget exact, choisissez simplement la fourchette la plus proche.</p>
                        <div class="choice-grid choice-grid-compact">
                            <?php foreach ($budgetOptions as $value => $label): ?>
                                <label class="choice-option">
                                    <input
                                        type="radio"
                                        name="budget"
                                        value="<?= htmlspecialchars($value) ?>"
                                        <?= (($old['budget'] ?? '') === $value) ? 'checked' : '' ?>
                                        required>
                                    <span><?= htmlspecialchars($label) ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <?php if (!empty($errors['budget'])): ?>
                            <small class="field-error" id="budget-error"><?= htmlspecialchars($errors['budget']) ?></small>
                        <?php endif; ?>
                    </fieldset>

                    <fieldset class="choice-field" <?= $errorAttributes('delai') ?>>
                        <legend>Délai souhaité</legend>
                        <div class="choice-grid choice-grid-compact">
                            <?php foreach ($deadlineOptions as $value => $label): ?>
                                <label class="choice-option">
                                    <input
                                        type="radio"
                                        name="delai"
                                        value="<?= htmlspecialchars($value) ?>"
                                        <?= (($old['delai'] ?? '') === $value) ? 'checked' : '' ?>
                                        required>
                                    <span><?= htmlspecialchars($label) ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <?php if (!empty($errors['delai'])): ?>
                            <small class="field-error" id="delai-error"><?= htmlspecialchars($errors['delai']) ?></small>
                        <?php endif; ?>
                    </fieldset>
                </div>

                <label class="field" for="message">
                    <span>Message</span>
                    <textarea
                        id="message"
                        name="message"
                        <?= $errorAttributes('message') ?>
                        rows="6"
                        placeholder="Présentez votre activité, votre besoin, vos délais et votre budget indicatif si vous en avez un."
                        minlength="10"
                        maxlength="3000"
                        required><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
                    <?php if (!empty($errors['message'])): ?>
                        <small class="field-error" id="message-error"><?= htmlspecialchars($errors['message']) ?></small>
                    <?php endif; ?>
                </label>
                <div class="turnstile-field">
                    <div
                        class="cf-turnstile"
                        data-sitekey="<?= htmlspecialchars($turnstileSiteKey, ENT_QUOTES, 'UTF-8') ?>"
                        data-action="<?= htmlspecialchars($turnstileAction, ENT_QUOTES, 'UTF-8') ?>"
                        data-size="compact">
                    </div>

                    <noscript>
                        <p class="form-error">
                            JavaScript doit être activé pour envoyer le formulaire.
                        </p>
                    </noscript>
                </div>

                <button class="btn btn-primary btn-lg" type="submit">
                    Envoyer ma demande
                </button>
                <p class="form-privacy">
                    Les champs du formulaire sont nécessaires pour traiter votre demande et vous répondre.
                    Consultez la <a href="/confidentialite">politique de confidentialité</a>.
                </p>
            </form>
        </article>

        <aside class="contact-page-panel" aria-label="Informations de contact">
            <h2>Coordonnées</h2>
            <ul class="contact-list">
                <li>
                    <span class="contact-label">Email</span>
                    <a href="mailto:maignaut.g@gmail.com">maignaut.g@gmail.com</a>
                </li>
                <li>
                    <span class="contact-label">Téléphone</span>
                    <a href="tel:+33650428039">+33 6 50 42 80 39</a>
                </li>
                <li>
                    <span class="contact-label">Localisation</span>
                    <span>Fleurance, Gers · Interventions à distance</span>
                </li>
            </ul>
            <div class="contact-page-actions">
                <a class="btn btn-ghost" href="mailto:maignaut.g@gmail.com">Envoyer un email</a>
                <a class="btn btn-ghost" href="https://www.linkedin.com/in/guillaume-maignaut-9b3464340/" target="_blank" rel="noopener noreferrer">LinkedIn</a>
            </div>
        </aside>
    </div>
</section>

<?php
use App\Security\Csrf;

$projectTypes = [
    'site_vitrine' => 'Site vitrine',
    'landing_page' => 'Landing page',
    'refonte' => 'Refonte',
    'maintenance' => 'Maintenance',
    'indecis' => 'Je ne sais pas encore',
];

$budgetOptions = [
    '450_900' => '450 à 900 €',
    '900_1500' => '900 à 1500 €',
    '1500_plus' => '1500 € et plus',
    'indecis' => 'Je ne sais pas encore',
];

$deadlineOptions = [
    'urgent' => 'Urgent',
    'moins_un_mois' => 'Moins d’un mois',
    'un_a_trois_mois' => '1 à 3 mois',
    'non_defini' => 'Pas encore défini',
];
?>

<section class="contact-page section">
    <?php if (!empty($errors['global']) || !empty($success)): ?>
        <div class="container contact-feedback">
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

    <div class="container contact-page-grid">
        <header class="contact-page-hero reveal">
            <p class="contact-page-kicker">Demande de projet</p>
            <h1 class="contact-page-title">Parlons de votre site vitrine, landing page ou refonte web.</h1>
            <p class="contact-page-lead">
                Décrivez votre activité, votre objectif, vos délais et votre budget approximatif si vous en avez un. Je vous répondrai avec une première lecture claire de la meilleure approche.
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
                    <span>Sites vitrines, landing pages, refontes et accompagnement web</span>
                </li>
            </ul>
        </aside>
    </div>

    <div class="container contact-form-wrap reveal">
        <article class="contact-form-card">
            <h2>Me contacter</h2>
            <p>
                Vous souhaitez créer ou améliorer un site web ? Indiquez votre type de projet, votre budget approximatif et le délai souhaité. Je vous répondrai avec une première analyse claire.
            </p>

            <form class="contact-form" action="/contact/submit" method="post">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <label class="field spam-check" for="site_web" aria-hidden="true">
                    <span>Site web</span>
                    <input
                        id="site_web"
                        name="site_web"
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
                        placeholder="Ex : création d'un site vitrine"
                        value="<?= htmlspecialchars($old['sujet'] ?? '') ?>"
                        required>
                    <?php if (!empty($errors['sujet'])): ?>
                        <small class="field-error"><?= htmlspecialchars($errors['sujet']) ?></small>
                    <?php endif; ?>
                </label>

                <fieldset class="choice-field">
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
                        <small class="field-error"><?= htmlspecialchars($errors['type_projet']) ?></small>
                    <?php endif; ?>
                </fieldset>

                <div class="field-row">
                    <fieldset class="choice-field">
                        <legend>Budget approximatif</legend>
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
                            <small class="field-error"><?= htmlspecialchars($errors['budget']) ?></small>
                        <?php endif; ?>
                    </fieldset>

                    <fieldset class="choice-field">
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
                            <small class="field-error"><?= htmlspecialchars($errors['delai']) ?></small>
                        <?php endif; ?>
                    </fieldset>
                </div>

                <label class="field" for="message">
                    <span>Message</span>
                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        placeholder="Présentez votre activité, votre besoin, vos délais et votre budget indicatif si vous en avez un."
                        required><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
                    <?php if (!empty($errors['message'])): ?>
                        <small class="field-error"><?= htmlspecialchars($errors['message']) ?></small>
                    <?php endif; ?>
                </label>

                <button class="btn btn-primary btn-lg" type="submit">Envoyer ma demande</button>
                <p class="form-privacy">
                    Les informations envoyées via ce formulaire sont utilisées uniquement pour répondre à votre demande. Vous pouvez demander leur suppression à tout moment.
                </p>
            </form>
        </article>
    </div>
</section>

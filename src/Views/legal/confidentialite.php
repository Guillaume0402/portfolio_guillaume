<?php
/** @var array<string, string> $legal */
?>

<section class="legal-page section">
    <div class="container legal-container">
        <header class="legal-hero reveal">
            <p class="section-kicker">Données personnelles</p>
            <h1>Politique de confidentialité</h1>
            <p>
                Cette politique explique quelles données sont collectées via le site, pourquoi elles sont utilisées, combien de temps elles sont conservées et comment exercer vos droits.
            </p>
            <p class="legal-updated">Dernière mise à jour : <?= htmlspecialchars($legal['last_update'], ENT_QUOTES, 'UTF-8') ?></p>
        </header>

        <article class="legal-card legal-card-wide reveal">
            <h2>Responsable du traitement</h2>
            <p>
                Le responsable du traitement est <?= htmlspecialchars($legal['editor_name'], ENT_QUOTES, 'UTF-8') ?>, joignable à l'adresse
                <a href="mailto:<?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?></a>.
            </p>
        </article>

        <div class="legal-grid">
            <article class="legal-card reveal">
                <h2>Données collectées</h2>
                <p>Le formulaire de contact peut collecter les informations suivantes :</p>
                <ul class="legal-bullets">
                    <li>nom ;</li>
                    <li>adresse email ;</li>
                    <li>sujet et contenu du message ;</li>
                    <li>type de projet, budget approximatif et délai souhaité ;</li>
                    <li>données techniques nécessaires au bon fonctionnement du formulaire.</li>
                </ul>
            </article>

            <article class="legal-card reveal">
                <h2>Finalités</h2>
                <p>Ces données sont utilisées pour :</p>
                <ul class="legal-bullets">
                    <li>répondre aux demandes envoyées via le formulaire ;</li>
                    <li>préparer un échange commercial ou un devis ;</li>
                    <li>assurer la sécurité technique du formulaire et limiter le spam.</li>
                </ul>
            </article>
        </div>

        <div class="legal-grid">
            <article class="legal-card reveal">
                <h2>Base légale</h2>
                <p>
                    Le traitement repose sur l'intérêt légitime de répondre aux demandes entrantes et, lorsque la demande vise une prestation, sur les démarches précontractuelles demandées par l'utilisateur.
                </p>
            </article>

            <article class="legal-card reveal">
                <h2>Durée de conservation</h2>
                <p>
                    Les messages de contact sont conservés pendant <?= htmlspecialchars($legal['retention_contact'], ENT_QUOTES, 'UTF-8') ?>, sauf obligation légale imposant une durée différente.
                </p>
            </article>
        </div>

        <article class="legal-card legal-card-wide reveal">
            <h2>Destinataires et transferts</h2>
            <p>
                Les données sont destinées uniquement à <?= htmlspecialchars($legal['editor_name'], ENT_QUOTES, 'UTF-8') ?>. Elles peuvent transiter par les prestataires techniques nécessaires à l'hébergement du site et à l'envoi des emails. Aucun transfert volontaire à des tiers commerciaux n'est effectué.
            </p>
        </article>

        <article class="legal-card legal-card-wide reveal">
            <h2>Vos droits</h2>
            <p>
                Vous pouvez demander l'accès, la rectification, l'effacement ou la limitation du traitement de vos données. Vous pouvez également vous opposer au traitement lorsque les conditions légales sont réunies.
            </p>
            <p>
                Pour exercer vos droits, contactez :
                <a href="mailto:<?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?></a>.
                Vous pouvez aussi introduire une réclamation auprès de la CNIL si vous estimez que vos droits ne sont pas respectés.
            </p>
        </article>
    </div>
</section>

<?php
/** @var array<string, string> $legal */
?>

<section class="legal-page section">
    <div class="container legal-container">
        <header class="legal-hero reveal">
            <p class="section-kicker">Cookies et traceurs</p>
            <h1>Politique cookies</h1>
            <p>
                Cette page explique les cookies et traceurs utilisés sur le site. A ce jour, le site n'utilise pas de cookie publicitaire ni de solution de mesure d'audience externe.
            </p>
            <p class="legal-updated">Dernière mise à jour : <?= htmlspecialchars($legal['last_update'], ENT_QUOTES, 'UTF-8') ?></p>
        </header>

        <div class="legal-grid">
            <article class="legal-card reveal">
                <h2>Traceurs nécessaires</h2>
                <p>
                    Le site peut utiliser des mécanismes techniques strictement nécessaires à son fonctionnement, notamment la session PHP utilisée pour la sécurité du formulaire de contact et le jeton CSRF.
                </p>
                <p>
                    Ces traceurs ne sont pas utilisés à des fins publicitaires et ne nécessitent pas de consentement préalable lorsqu'ils sont strictement nécessaires au service demandé.
                </p>
            </article>

            <article class="legal-card reveal">
                <h2>Préférence d'affichage</h2>
                <p>
                    Le choix du thème clair ou sombre peut être conservé dans le navigateur via <code>localStorage</code>. Cette information reste sur votre appareil et sert uniquement à mémoriser votre préférence d'affichage.
                </p>
            </article>
        </div>

        <article class="legal-card legal-card-wide reveal">
            <h2>Mesure d'audience et publicité</h2>
            <p>
                Aucun outil de mesure d'audience externe, cookie publicitaire ou traceur de ciblage marketing n'est déclaré sur ce site à la date de mise à jour de cette page.
            </p>
            <p>
                Si un outil d'analyse ou de publicité est ajouté plus tard, cette page devra être mise à jour et un mécanisme de consentement devra être mis en place lorsque la loi l'exige.
            </p>
        </article>

        <article class="legal-card legal-card-wide reveal">
            <h2>Contact</h2>
            <p>
                Pour toute question sur les cookies et traceurs, vous pouvez écrire à
                <a href="mailto:<?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?></a>.
            </p>
        </article>
    </div>
</section>

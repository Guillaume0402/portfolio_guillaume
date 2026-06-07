<?php
/** @var array<string, string> $legal */
?>

<section class="legal-page section">
    <div class="container legal-container">
        <header class="legal-hero reveal">
            <p class="section-kicker">Informations légales</p>
            <h1>Mentions légales</h1>
            <p>
                Cette page regroupe les informations d'identification de l'éditeur du site, de son responsable de publication et de son hébergeur.
            </p>
            <p class="legal-updated">Dernière mise à jour : <?= htmlspecialchars($legal['last_update'], ENT_QUOTES, 'UTF-8') ?></p>
        </header>

        <div class="legal-grid">
            <article class="legal-card reveal">
                <h2>Editeur du site</h2>
                <dl class="legal-list">
                    <div>
                        <dt>Site</dt>
                        <dd><?= htmlspecialchars($legal['site_url'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Nom</dt>
                        <dd><?= htmlspecialchars($legal['editor_name'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Statut</dt>
                        <dd><?= htmlspecialchars($legal['editor_status'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Activité principale</dt>
                        <dd><?= htmlspecialchars($legal['editor_activity'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Adresse</dt>
                        <dd><?= htmlspecialchars($legal['editor_address'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>SIREN</dt>
                        <dd><?= htmlspecialchars($legal['siren'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>SIRET</dt>
                        <dd><?= htmlspecialchars($legal['siret'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>RNE</dt>
                        <dd><?= htmlspecialchars($legal['rne'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Code APE</dt>
                        <dd><?= htmlspecialchars($legal['ape'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>TVA</dt>
                        <dd><?= htmlspecialchars($legal['vat'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Email</dt>
                        <dd><a href="mailto:<?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?></a></dd>
                    </div>
                    <div>
                        <dt>Téléphone</dt>
                        <dd><a href="tel:+33650428039"><?= htmlspecialchars($legal['editor_phone'], ENT_QUOTES, 'UTF-8') ?></a></dd>
                    </div>
                </dl>
            </article>

            <article class="legal-card reveal">
                <h2>Publication et hébergement</h2>
                <dl class="legal-list">
                    <div>
                        <dt>Directeur de la publication</dt>
                        <dd><?= htmlspecialchars($legal['publication_director'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Hébergeur</dt>
                        <dd><?= htmlspecialchars($legal['host_name'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Adresse de l'hébergeur</dt>
                        <dd><?= htmlspecialchars($legal['host_address'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Téléphone de l'hébergeur</dt>
                        <dd><?= htmlspecialchars($legal['host_phone'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                </dl>
            </article>
        </div>

        <article class="legal-card legal-card-wide reveal">
            <h2>Propriété intellectuelle</h2>
            <p>
                Les contenus présents sur ce site, notamment les textes, visuels, interfaces, éléments graphiques et codes sources spécifiques, sont protégés par le droit d'auteur. Toute reproduction ou réutilisation non autorisée est interdite, sauf accord écrit préalable.
            </p>
            <p>
                Les visuels utilisés sur ce site ont été créés pour le site ou générés à l'aide d'outils d'intelligence artificielle, puis sélectionnés et intégrés par l'éditeur du site.
            </p>
        </article>

    </div>
</section>

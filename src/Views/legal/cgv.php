<?php
/** @var array<string, string> $legal */
?>

<section class="legal-page section">
    <div class="container legal-container">
        <header class="legal-hero reveal">
            <p class="section-kicker">Conditions contractuelles</p>
            <h1>Conditions générales de vente</h1>
            <p>
                Ces conditions générales encadrent les prestations de création de sites web, landing pages, refontes, maintenance et accompagnement technique proposées par <?= htmlspecialchars($legal['editor_name'], ENT_QUOTES, 'UTF-8') ?>.
            </p>
            <p class="legal-updated">Dernière mise à jour : <?= htmlspecialchars($legal['last_update'], ENT_QUOTES, 'UTF-8') ?></p>
        </header>

        <article class="legal-card legal-card-wide legal-warning reveal">
            <h2>Médiateur à désigner avant vente à un consommateur</h2>
            <p>
                Avant toute vente à un consommateur particulier, l'éditeur doit adhérer à un médiateur de la consommation référencé et remplacer les informations ci-dessous par les coordonnées exactes du médiateur désigné.
            </p>
        </article>

        <div class="legal-grid">
            <article class="legal-card reveal">
                <h2>Vendeur</h2>
                <dl class="legal-list">
                    <div>
                        <dt>Nom</dt>
                        <dd><?= htmlspecialchars($legal['editor_name'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Statut</dt>
                        <dd><?= htmlspecialchars($legal['editor_status'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>SIRET</dt>
                        <dd><?= htmlspecialchars($legal['siret'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Email</dt>
                        <dd><a href="mailto:<?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?></a></dd>
                    </div>
                </dl>
            </article>

            <article class="legal-card reveal">
                <h2>Prestations concernées</h2>
                <p>
                    Les prestations peuvent porter sur la création de sites vitrines, landing pages, refontes, intégrations, corrections, maintenance, accompagnement technique ou développements web spécifiques.
                </p>
                <p>
                    Les caractéristiques précises, livrables, délais, prix et modalités de paiement sont définis dans le devis ou la proposition commerciale transmis au client.
                </p>
            </article>
        </div>

        <div class="legal-grid">
            <article class="legal-card reveal">
                <h2>Devis et commande</h2>
                <p>
                    Toute commande suppose l'acceptation préalable d'un devis ou d'une proposition écrite. L'acceptation peut être formalisée par signature, validation écrite par email ou tout autre moyen écrit convenu entre les parties.
                </p>
                <p>
                    Le devis précise sa durée de validité. A défaut d'indication, il est valable pendant 30 jours à compter de son émission.
                </p>
            </article>

            <article class="legal-card reveal">
                <h2>Prix</h2>
                <p>
                    Les prix sont exprimés en euros. L'éditeur bénéficie de la franchise en base de TVA : <?= htmlspecialchars($legal['vat'], ENT_QUOTES, 'UTF-8') ?>.
                </p>
                <p>
                    Lorsque le prix ne peut pas être déterminé à l'avance, un devis personnalisé précise le mode de calcul, le périmètre et les éventuelles options.
                </p>
            </article>
        </div>

        <div class="legal-grid">
            <article class="legal-card reveal">
                <h2>Paiement</h2>
                <p>
                    Les modalités de paiement, échéances, acompte éventuel et moyens de paiement acceptés sont indiqués dans le devis. Sauf mention contraire, les factures sont payables par virement bancaire.
                </p>
                <p>
                    Pour les clients professionnels, tout retard de paiement peut entraîner l'application de pénalités de retard et de l'indemnité forfaitaire pour frais de recouvrement prévue par la réglementation applicable.
                </p>
            </article>

            <article class="legal-card reveal">
                <h2>Exécution</h2>
                <p>
                    Les délais d'exécution sont indiqués au devis à titre estimatif ou ferme selon les cas. Ils peuvent être ajustés en cas de retard de transmission des contenus, validations, accès techniques ou informations nécessaires par le client.
                </p>
                <p>
                    Le client reste responsable de la fourniture des textes, images, accès, validations et contenus nécessaires, sauf prestation contraire expressément prévue au devis.
                </p>
            </article>
        </div>

        <article class="legal-card legal-card-wide reveal">
            <h2>Validation, corrections et livraison</h2>
            <p>
                Les livrables sont soumis à validation du client. Les séries de corrections incluses sont celles prévues au devis. Toute demande hors périmètre initial peut faire l'objet d'un devis complémentaire.
            </p>
            <p>
                La livraison peut prendre la forme d'une mise en ligne, d'une remise de fichiers, d'un accès à un environnement technique ou de tout autre livrable défini au devis.
            </p>
        </article>

        <article class="legal-card legal-card-wide reveal">
            <h2>Droit de rétractation des consommateurs</h2>
            <p>
                Lorsqu'un contrat est conclu à distance avec un consommateur, celui-ci dispose en principe d'un délai de rétractation de 14 jours à compter de la conclusion du contrat de prestation de services.
            </p>
            <p>
                Si le consommateur souhaite que l'exécution commence avant la fin du délai de rétractation, il doit en faire la demande expresse. Si la prestation est pleinement exécutée avant la fin du délai avec son accord préalable et sa renonciation expresse, le droit de rétractation peut ne plus s'appliquer. Si l'exécution a commencé sans être achevée, le consommateur peut devoir payer un montant proportionnel au service déjà fourni.
            </p>
        </article>

        <div class="legal-grid">
            <article class="legal-card reveal">
                <h2>Garanties et responsabilité</h2>
                <p>
                    L'éditeur s'engage à réaliser les prestations avec diligence et conformément au périmètre accepté. Les garanties légales applicables aux consommateurs restent dues lorsqu'elles s'appliquent.
                </p>
                <p>
                    La responsabilité de l'éditeur ne peut être engagée pour les contenus fournis par le client, les services tiers, l'hébergement tiers, les modifications effectuées par un tiers ou un usage non conforme des livrables.
                </p>
            </article>

            <article class="legal-card reveal">
                <h2>Propriété intellectuelle</h2>
                <p>
                    Sauf mention contraire au devis, les droits d'utilisation des livrables sont cédés au client après paiement complet des sommes dues, pour les usages prévus au devis. Les outils, méthodes, composants génériques et savoir-faire préexistants restent la propriété de leur titulaire.
                </p>
            </article>
        </div>

        <div class="legal-grid">
            <article class="legal-card reveal">
                <h2>Réclamations</h2>
                <p>
                    Toute réclamation peut être adressée par email à
                    <a href="mailto:<?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($legal['editor_email'], ENT_QUOTES, 'UTF-8') ?></a>.
                    Le client est invité à préciser son identité, la prestation concernée et les éléments nécessaires au traitement de sa demande.
                </p>
            </article>

            <article class="legal-card reveal">
                <h2>Médiation de la consommation</h2>
                <dl class="legal-list">
                    <div>
                        <dt>Médiateur</dt>
                        <dd><?= htmlspecialchars($legal['mediator_name'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Adresse</dt>
                        <dd><?= htmlspecialchars($legal['mediator_address'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                    <div>
                        <dt>Site internet</dt>
                        <dd><?= htmlspecialchars($legal['mediator_website'], ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>
                </dl>
            </article>
        </div>

        <article class="legal-card legal-card-wide reveal">
            <h2>Droit applicable</h2>
            <p>
                Les présentes conditions sont soumises au droit français. En cas de litige, les parties recherchent d'abord une solution amiable. Les règles impératives protectrices du consommateur restent applicables lorsque le client agit en qualité de consommateur.
            </p>
        </article>
    </div>
</section>

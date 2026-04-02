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

            <form class="contact-form" action="mailto:g.maignaut@gmail.com" method="post" enctype="text/plain">
                <div class="field-row">
                    <label class="field" for="contact-name">
                        <span>Nom</span>
                        <input id="contact-name" name="Nom" type="text" required>
                    </label>

                    <label class="field" for="contact-email">
                        <span>Email</span>
                        <input id="contact-email" name="Email" type="email" required>
                    </label>
                </div>

                <label class="field" for="contact-subject">
                    <span>Sujet</span>
                    <input id="contact-subject" name="Sujet" type="text" required>
                </label>

                <label class="field" for="contact-message">
                    <span>Message</span>
                    <textarea id="contact-message" name="Message" rows="6" required></textarea>
                </label>

                <button class="btn btn-primary btn-lg" type="submit">Preparer mon email</button>
            </form>
        </article>
    </div>
</section>
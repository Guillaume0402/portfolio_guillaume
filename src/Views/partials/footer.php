<footer class="site-footer">
    <div class="container footer-inner">
        <div class="footer-brand">
            <a class="brand footer-brand-link" href="#top" aria-label="Retour en haut">
                <img class="brand-photo" src="/images/Avatar-tiny.webp" alt="Photo de Guillaume" width="40" height="40">
                <span class="brand-name">Guillaume</span>
                <span class="brand-tag">Développeur Web</span>
            </a>

            <p class="footer-text">
                Je construis des interfaces propres, rapides et maintenables.
                Disponible pour missions freelance et projets web.
            </p>

            <div class="footer-actions">
                <a class="footer-cta" href="mailto:g.maignaut@gmail.com">g.maignaut@gmail.com</a>
                <span class="footer-sep" aria-hidden="true">•</span>
                <a class="footer-link" href="tel:+33650428039">+33 6 50 42 80 39</a>
            </div>
        </div>


        <div class="footer-col">
            <h3 class="footer-title">Réseaux</h3>

            <a class="footer-social" href="https://github.com/Guillaume0402" target="_blank" rel="noopener noreferrer">
                <span class="sr-only">GitHub</span>
                <!-- GitHub SVG -->
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 .5C5.73.5.75 5.64.75 12c0 5.11 3.29 9.44 7.86 10.97.58.11.79-.26.79-.57v-2.02c-3.2.71-3.87-1.4-3.87-1.4-.53-1.36-1.29-1.72-1.29-1.72-1.05-.73.08-.72.08-.72 1.16.08 1.77 1.22 1.77 1.22 1.03 1.8 2.7 1.28 3.36.98.1-.76.4-1.28.72-1.57-2.55-.3-5.23-1.31-5.23-5.84 0-1.29.45-2.34 1.19-3.17-.12-.3-.52-1.52.11-3.16 0 0 .97-.32 3.18 1.21.92-.26 1.9-.39 2.88-.39.98 0 1.97.13 2.88.39 2.2-1.53 3.18-1.21 3.18-1.21.63 1.64.23 2.86.11 3.16.74.83 1.19 1.88 1.19 3.17 0 4.54-2.69 5.54-5.25 5.83.41.36.78 1.09.78 2.2v3.26c0 .31.21.68.8.57 4.56-1.53 7.85-5.86 7.85-10.97C23.25 5.64 18.27.5 12 .5z" />
                </svg>
                <span class="label">GitHub</span>
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 .5C5.73.5.75 5.64.75 12c0 5.11 3.29 9.44 7.86 10.97.58.11.79-.26.79-.57v-2.02c-3.2.71-3.87-1.4-3.87-1.4-.53-1.36-1.29-1.72-1.29-1.72-1.05-.73.08-.72.08-.72 1.16.08 1.77 1.22 1.77 1.22 1.03 1.8 2.7 1.28 3.36.98.1-.76.4-1.28.72-1.57-2.55-.3-5.23-1.31-5.23-5.84 0-1.29.45-2.34 1.19-3.17-.12-.3-.52-1.52.11-3.16 0 0 .97-.32 3.18 1.21.92-.26 1.9-.39 2.88-.39.98 0 1.97.13 2.88.39 2.2-1.53 3.18-1.21 3.18-1.21.63 1.64.23 2.86.11 3.16.74.83 1.19 1.88 1.19 3.17 0 4.54-2.69 5.54-5.25 5.83.41.36.78 1.09.78 2.2v3.26c0 .31.21.68.8.57 4.56-1.53 7.85-5.86 7.85-10.97C23.25 5.64 18.27.5 12 .5z" />
                </svg>
            </a>

            <a class="footer-social" href="https://www.linkedin.com/in/guillaume-maignaut-9b3464340/" target="_blank" rel="noopener noreferrer">
                <span class="sr-only">LinkedIn</span>
                <!-- LinkedIn SVG -->
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20.45 20.45H16.9v-5.6c0-1.34-.02-3.06-1.87-3.06-1.87 0-2.16 1.46-2.16 2.97v5.69H9.33V9h3.4v1.56h.05c.47-.9 1.62-1.86 3.34-1.86 3.57 0 4.23 2.35 4.23 5.41v6.34zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.11 20.45H3.56V9h3.55v11.45z" />
                </svg>
                <span class="label">LinkedIn</span>
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20.45 20.45H16.9v-5.6c0-1.34-.02-3.06-1.87-3.06-1.87 0-2.16 1.46-2.16 2.97v5.69H9.33V9h3.4v1.56h.05c.47-.9 1.62-1.86 3.34-1.86 3.57 0 4.23 2.35 4.23 5.41v6.34zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.11 20.45H3.56V9h3.55v11.45z" />
                </svg>
            </a>
        </div>

    </div>

    <div class="container footer-bottom">
        <span class="footer-copy">© <span id="year"></span> Guillaume. Tous droits réservés.</span>
        <span class="footer-mini">Fait avec HTML/CSS/JS.</span>
    </div>

    <script>
        document.querySelector("#year").textContent = new Date().getFullYear();
    </script>
</footer>
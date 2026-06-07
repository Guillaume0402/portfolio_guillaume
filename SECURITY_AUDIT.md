# Audit securite - 2026-06-07

Branche de travail : `security-audit-hardening`.

## Corrections appliquees

- Sessions PHP durcies dans `public/index.php` : cookies `HttpOnly`, `SameSite=Lax`, `Secure` en prod/HTTPS, `session.use_strict_mode`, regeneration d'ID a l'initialisation.
- Headers de securite ajoutes cote PHP, Apache et Caddy : CSP, `X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy`, HSTS en prod.
- Suppression du script public `public/test-db.php`, qui pouvait exposer des informations de connexion ou de version serveur.
- Suppression du script Bootstrap CDN inutilise et migration du script inline de theme vers `public/js/theme-init.js`, pour pouvoir appliquer une CSP plus stricte.
- Formulaire contact durci : lecture POST type-safe, limite email, redirect `303`, rotation du token CSRF apres succes ou honeypot.
- Portfolio durci : les URLs externes venant de la base doivent etre en `https`, les images/logos sont limites a des noms de fichiers attendus.
- Docker durci : ports dev binds sur `127.0.0.1`, phpMyAdmin ne recoit plus de login automatique, `no-new-privileges`, healthchecks MySQL, Node `24`, PHP `8.4`.
- Ajout de `.env.prod.example` pour documenter les variables prod sans commiter de secrets.

## Verification

- `php -l` sur les fichiers PHP modifies : OK.
- `docker compose config --quiet` : OK.
- `docker compose --env-file .env.prod -f compose.prod.yml config --quiet` : OK.
- `composer audit --format=plain` : aucune alerte.
- `npm audit --audit-level=moderate` : aucune alerte.

## References utilisees

- OWASP HTTP Headers Cheat Sheet : https://cheatsheetseries.owasp.org/cheatsheets/HTTP_Headers_Cheat_Sheet.html
- OWASP CSRF Prevention Cheat Sheet : https://cheatsheetseries.owasp.org/cheatsheets/Cross-Site_Request_Forgery_Prevention_Cheat_Sheet.html
- PHP `session_set_cookie_params` : https://www.php.net/manual/en/function.session-set-cookie-params.php
- PHP supported versions : https://www.php.net/supported-versions.php
- Node.js EOL : https://nodejs.org/en/about/eol
- Docker Compose secrets : https://docs.docker.com/reference/compose-file/secrets/
- Caddy `header` directive : https://caddyserver.com/docs/caddyfile/directives/header
- MySQL 8.0 release notes / EOL : https://downloads.mysql.com/docs/mysql-8.0-relnotes-en.a4.pdf

## Points a garder en tete

- Les secrets prod restent charges par `.env.prod`. Pour aller plus loin, Docker Compose peut gerer des `secrets`, mais il faut adapter le deploiement et, idealement, lire les secrets via fichiers dans l'application.
- MySQL reste en `8.0` pour eviter une migration implicite du volume deja deploye. Le passage vers MySQL 8.4 LTS doit etre traite plus tard comme une operation separee : backup, test sur copie, verification applicative, puis migration.
- La CSP actuelle autorise `style-src-attr 'unsafe-inline'` parce que le JavaScript de cartes met a jour des variables CSS inline au survol.

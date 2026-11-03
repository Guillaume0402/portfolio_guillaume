# Template PHP + MySQL (Docker) — Router MVC + Bootstrap SCSS

Template réutilisable pour démarrer rapidement des projets PHP (vanilla) avec :
- PHP 8.3 + Apache (Docker)
- MySQL 8.0
- phpMyAdmin
- Mailpit
- Routeur MVC simple (Front Controller)
- SCSS + Bootstrap (compilation vers `public/assets/app.css`)

---

## 1) Pré-requis

- Docker + Docker Compose
- Node.js + npm (pour SCSS/Bootstrap)

Vérification :

```bash
docker --version
docker compose version
node -v
npm -v
```

---

## 2) Créer un nouveau projet (méthode officielle)

Ce template est conçu pour être dupliqué via un script automatique.

### Emplacement attendu

- Template : `~/Projets/_template-php-mysql`
- Script : `new-project.sh` (lancé depuis l’endroit où tu l’as stocké)

### Créer un projet

```bash
./new-project.sh nom-du-projet
```

Le script :
- copie le template vers `~/Projets/nom-du-projet`
- crée `.env` à partir de `.env.example`
- trouve un bloc de ports libres (web/pma/db/mailpit)
- injecte les ports + `COMPOSE_PROJECT_NAME` dans `.env`
- affiche les URLs finales

---

## 3) Démarrer le projet

Après création :

```bash
cd ~/Projets/nom-du-projet
npm install
npm run dev
```

Dans un autre terminal (ou après) :

```bash
docker compose up -d --build
```

Accès (les ports exacts sont affichés par `new-project.sh`) :
- App : `http://localhost:WEB_PORT`
- phpMyAdmin : `http://localhost:PMA_PORT`
- Mailpit : `http://localhost:MAILPIT_UI_PORT`

---

## 4) Structure du projet

### Entrée unique (Front Controller)
- `public/index.php`
- `public/.htaccess`

### Routes
- `routes/web.php`

### Controllers
- `src/Controllers/`

### Core (infrastructure réutilisable)
- `src/Core/Router.php`
- `src/Core/AbstractController.php`

### Views
- Layout : `src/Views/layouts/main.php`
- Pages : `src/Views/...`

### Styles
- SCSS source : `assets/scss/app.scss` (+ dossiers)
- CSS généré : `public/assets/app.css`
- Bootstrap est importé via SCSS (npm)

---

## 5) Ajouter une page (route + controller + vue)

### Route
Dans `routes/web.php` :

```php
$router->get('/contact', [ContactController::class, 'index']);
```

### Controller
Créer `src/Controllers/ContactController.php` :

```php
<?php
namespace App\Controllers;

use App\Core\AbstractController;

final class ContactController extends AbstractController
{
    public function index(): string
    {
        return $this->render('contact/index', [
            'pageTitle' => 'Contact',
            'title' => 'Contact',
        ]);
    }
}
```

### Vue
Créer `src/Views/contact/index.php` :

```php
<h1><?= htmlspecialchars($title) ?></h1>
<p>Page contact</p>
```

---

## 6) Base de données

Dans Docker (depuis le container web), MySQL est accessible via :
- host : `db`
- port : `3306`
- db/user/password : via `.env`

### Base ciblée

Les deux fichiers Compose transmettent la même variable `DB_NAME` à PHP et à
`MYSQL_DATABASE` dans le service `db`. En local, sa valeur par défaut reste `app` ;
en production, elle doit être fournie explicitement. Une valeur `DB_NAME` déjà
configurée reste prioritaire et ne doit pas être changée pour mettre à jour une
base existante.

L'entrypoint de l'[image officielle MySQL](https://hub.docker.com/_/mysql) crée
`MYSQL_DATABASE` et sélectionne cette base pour chaque fichier SQL d'initialisation.
Le schéma, le seed et la migration
ne fixent donc aucun nom de base avec `USE` ou `CREATE DATABASE`. La connexion PHP
utilise ce même `DB_NAME` dans son DSN (`src/Services/Database.php`).

### Nouvelle installation Docker

Cette procédure concerne uniquement un volume MySQL qui n'a jamais été initialisé.
Choisir `DB_NAME` avant le premier démarrage, puis utiliser la procédure de
démarrage de la section 3. Pour les essais, utiliser un projet Docker isolé avec
son propre volume, sans réutiliser ni supprimer un volume existant.

Les deux fichiers Compose montent explicitement ces fichiers en lecture seule.
L'entrypoint les exécute dans cet ordre :

1. `docker/mysql/initdb/01-schema.sql` : tables `projects` et `skills`.
2. `docker/mysql/initdb/02-seed.sql` : données initiales.
3. `database/migrations/20260902_create_contact_rate_limits.sql`, monté sous
   `/docker-entrypoint-initdb.d/03-contact-rate-limits.sql` : table du compteur.

Le contenu de la migration reste dans un seul fichier. Ajouter un fichier dans
`database/migrations/` ou `docker/mysql/initdb/` ne suffit pas à le faire exécuter :
son montage doit être déclaré dans les deux fichiers Compose.

Une fois l'initialisation terminée, vérifier depuis un client MySQL connecté
explicitement à la base `DB_NAME` :

```sql
SELECT DATABASE();
SHOW TABLES;
SHOW CREATE TABLE contact_rate_limits;
```

La base sélectionnée doit correspondre à `DB_NAME` et contenir les trois tables.

### Base déjà initialisée

Un redémarrage ou une recréation du conteneur conservant le même volume ne rejoue
pas les scripts d'initialisation. Le nouveau montage n'applique donc aucune
migration automatiquement à une base existante et ne remplace pas ses données.

1. Conserver le volume et la configuration `DB_NAME` existants.
2. Se connecter explicitement à cette base et effectuer les vérifications SQL en
   lecture seule ci-dessus. Comparer la structure de `contact_rate_limits` avec
   `database/migrations/20260902_create_contact_rate_limits.sql`.
3. Si la table est présente et conforme, aucune migration n'est à rejouer.
4. Si elle est absente, planifier séparément l'application manuelle du seul fichier
   de migration à la base sélectionnée. Depuis un client MySQL dans le conteneur
   `db` disposant des nouveaux montages, la commande est :

   ```sql
   SOURCE /docker-entrypoint-initdb.d/03-contact-rate-limits.sql;
   ```

5. Après cette application, vérifier sa structure avec `SHOW CREATE TABLE`.

La migration utilise `CREATE TABLE IF NOT EXISTS` et ne supprime aucune donnée.
Elle ne corrige toutefois pas la structure d'une table existante non conforme :
ce cas nécessite une analyse séparée. Ne pas rejouer `01-schema.sql` ou
`02-seed.sql` sur une base existante : le schéma initial contient des `DROP TABLE`
et le seed est réservé aux données de démarrage. Un reset de volume n'est pas une
procédure de migration.

---

## 7) Commandes utiles

Logs web :

```bash
docker compose logs -f web
```

Stop (garde la DB) :

```bash
docker compose down
```

Reset complet (supprime DB/volumes) :

```bash
docker compose down -v --remove-orphans
```

---

## 8) Problèmes fréquents

### “Controller introuvable”
Sous Linux, attention à la casse :
- `src/Controllers` (pluriel)
- `src/Core`
- `src/Views`

### SCSS ne compile pas / Bootstrap introuvable
- vérifier `npm install`
- build test :

```bash
npm run build
```

### Conflit de ports
Le script choisit des ports libres, mais si tu modifies `.env` à la main :

```bash
ss -ltnp | grep -E ':PORT'
```

---

## 9) Notes

- Ne jamais commit `.env` (utiliser `.env.example`)
- `COMPOSE_PROJECT_NAME` isole conteneurs/volumes par projet
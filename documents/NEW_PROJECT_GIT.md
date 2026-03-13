Pour un nouveau projet sans Docker (repo GitHub créé en CLI)

Tu crées le dossier, tu rentres dedans, tu ouvres VS Code, tu initialises Git en main, tu commits, tu crées le repo GitHub et tu push.

# 1) Créer le dossier et entrer dedans
mkdir -p ~/Projets/nom_du_projet
cd ~/Projets/nom_du_projet

# 2) Ouvrir dans VS Code
code .

# 3) Git : init + branche main + premier commit
git init
git branch -m main

# (optionnel) .gitignore minimal
printf ".env\nvendor/\nnode_modules/\n.DS_Store\n.vscode/\n" > .gitignore

git add .
git commit -m "chore: initial commit"

# 4) Créer repo GitHub + push (public ou private)
gh repo create nom_du_projet --public  --source=. --remote=origin --push
# ou
gh repo create nom_du_projet --private --source=. --remote=origin --push


Pour un nouveau projet avec Docker Compose (évite les erreurs de nom)

Docker Compose veut un nom de projet en minuscules. Donc fixes ça tout de suite via .env.

# 1) Créer le dossier et entrer dedans
mkdir -p ~/Projets/Nom_Du_Projet
cd ~/Projets/Nom_Du_Projet

# 2) Fixer le nom Docker Compose en minuscules (IMPORTANT)
printf "COMPOSE_PROJECT_NAME=nom_du_projet\n" > .env

# 3) Ouvrir dans VS Code
code .

# 4) Lancer Docker
docker compose up -d --build
docker compose ps

# 5) Git : init + branche main + premier commit
git init
git branch -m main

# (recommandé) .gitignore Docker/PHP classique
printf ".env\nvendor/\nnode_modules/\n.DS_Store\n.vscode/\n\n# Docker\n**/.docker/\n" > .gitignore

git add .
git commit -m "chore: initial commit"

# 6) Repo GitHub + push
gh repo create nom_du_projet --private --source=. --remote=origin --push


Réglage global à faire une seule fois (pour ne plus voir “master”)

git config --global init.defaultBranch main


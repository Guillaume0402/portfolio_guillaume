.DEFAULT_GOAL := help

.PHONY: help start up stop restart down ps logs logs-db shell mysql mysql-root db rebuild npm-install sass build dev reset reset-force

help: ## Affiche la liste des commandes disponibles
	@echo ""
	@echo "Commandes disponibles :"
	@echo ""
	@awk 'BEGIN {FS = ":.*##"} /^[a-zA-Z0-9_-]+:.*##/ { printf "  make %-15s %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
	@echo ""

start: ## Lance les containers Docker sans rebuild
	docker compose up -d

up: ## Lance les containers Docker avec rebuild des images
	docker compose up -d --build

stop: ## Stoppe les containers sans les supprimer
	docker compose stop

restart: ## Redémarre les containers Docker
	docker compose restart

down: ## Arrête et supprime les containers sans supprimer les volumes
	docker compose down

ps: ## Affiche l'état des containers Docker
	docker compose ps

logs: ## Affiche les logs du container web
	docker compose logs -f web --tail=200

logs-db: ## Affiche les logs du container db
	docker compose logs -f db --tail=200

shell: ## Ouvre un terminal bash dans le container web
	docker compose exec web bash

mysql: ## Ouvre MySQL avec l'utilisateur défini dans le fichier .env
	@DB_USER=$$(grep -E '^DB_USER=' .env | cut -d= -f2-); \
	DB_PASSWORD=$$(grep -E '^DB_PASSWORD=' .env | cut -d= -f2-); \
	DB_NAME=$$(grep -E '^DB_NAME=' .env | cut -d= -f2-); \
	docker compose exec db mysql -u"$$DB_USER" -p"$$DB_PASSWORD" "$$DB_NAME"

mysql-root: ## Ouvre MySQL en root avec le mot de passe défini dans le fichier .env
	@ROOT_PASS=$$(grep -E '^MYSQL_ROOT_PASSWORD=' .env | cut -d= -f2-); \
	docker compose exec db mysql -uroot -p"$$ROOT_PASS"

db: mysql ## Alias de make mysql

rebuild: ## Arrête les containers puis relance avec rebuild complet
	docker compose down
	docker compose up -d --build

npm-install: ## Installe les dépendances npm
	npm install

sass: ## Lance Sass en mode développement avec surveillance des fichiers
	npm run dev

build: ## Compile les assets pour la production
	npm run build

dev: start npm-install ## Lance les containers, installe npm puis démarre Sass
	npm run dev

reset: ## Demande confirmation avant de supprimer containers, volumes et orphelins
	@echo "Attention : cette commande va supprimer les volumes Docker."
	@echo "Si ta base MySQL est dans un volume Docker, elle sera supprimée."
	@read -p "Confirmer le reset complet ? [y/N] " confirm; \
	if [ "$$confirm" = "y" ] || [ "$$confirm" = "Y" ]; then \
		docker compose down -v --remove-orphans; \
	else \
		echo "Reset annulé."; \
	fi

reset-force: ## Supprime directement containers, volumes et orphelins sans confirmation
	docker compose down -v --remove-orphans
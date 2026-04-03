# syntax=docker/dockerfile:1

FROM php:8.3-apache AS php_base

# Dépendances système + extensions PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Apache vhost -> /public
COPY docker/php/apache-vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# =========================
# DEV
# =========================
FROM php_base AS dev

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist

COPY . .
RUN chown -R www-data:www-data /var/www/html

# =========================
# COMPOSER PROD
# =========================
FROM composer:2 AS composer_prod

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# =========================
# FRONTEND PROD (SASS)
# =========================
FROM node:20-alpine AS frontend_prod

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY assets ./assets

RUN mkdir -p public/assets \
    && npx sass \
    --no-source-map \
    --style=compressed \
    --load-path=node_modules \
    assets/scss/app.scss \
    public/assets/app.css

# =========================
# PROD
# =========================
FROM php_base AS prod

COPY . .

COPY --from=composer_prod /app/vendor ./vendor
COPY --from=frontend_prod /app/public/assets/app.css ./public/assets/app.css

RUN chown -R www-data:www-data /var/www/html
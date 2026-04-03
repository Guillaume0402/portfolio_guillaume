FROM php:8.3-apache

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

# Installer les dépendances PHP d'abord
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copier ensuite le projet
COPY . .

# Permissions de base
RUN chown -R www-data:www-data /var/www/html

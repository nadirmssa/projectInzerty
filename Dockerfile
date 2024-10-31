# Utiliser l'image PHP de base avec FPM
FROM php:8.2-fpm

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances système et les extensions PHP
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install mysqli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
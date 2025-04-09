FROM php:7.4-apache

RUN apt-get update && apt-get install -y unzip

RUN apt-get update && apt-get install -y apt-transport-https

RUN apt-get update && apt-get install -y libmcrypt-dev \
    mariadb-client zlib1g-dev libmagickwand-dev libzip-dev --no-install-recommends \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mysqli calendar zip -j$(nproc) gd

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite
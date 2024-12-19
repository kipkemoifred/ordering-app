# Dockerfile
FROM php:8.1-fpm
WORKDIR /var/www
COPY . .
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

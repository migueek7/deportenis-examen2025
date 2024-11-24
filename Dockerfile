FROM php:7.4-apache

RUN a2enmod rewrite

RUN pecl install xdebug \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo

COPY src/ /var/www/html/

EXPOSE 80
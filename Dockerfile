FROM php:7.4-fpm-alpine

RUN apk --update add composer curl && rm /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN docker-php-ext-install \
    opcache \
    pdo \
    pdo_mysql

WORKDIR /app

RUN composer global require hirak/prestissimo

RUN mkdir -p var/cache var/log var/sessions \
	&& chown -R www-data var

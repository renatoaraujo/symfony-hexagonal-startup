FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
	libssh-dev \
    libxslt-dev \
    libzip-dev \
    git \
    curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
	zip \
    pdo \
    pdo_mysql

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

RUN composer global require hirak/prestissimo

RUN mkdir -p var/cache var/log var/sessions \
	&& chown -R www-data var

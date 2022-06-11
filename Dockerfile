FROM php:7.2.18-apache

RUN apt-get update
RUN apt-get install -y vim
RUN apt-get install -y zip unzip git
RUN git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis

RUN docker-php-ext-install pdo_mysql redis

COPY . /var/www/html/
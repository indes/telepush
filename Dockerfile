FROM php:7-alpine as base
WORKDIR /var/www
COPY . .
RUN wget https://getcomposer.org/composer.phar\
    &&php composer.phar install\
    &&cp .env.example .env
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
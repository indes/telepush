FROM php:7.1-fpm as base

COPY . /srv/app
COPY Caddyfile /etc/Caddyfile

WORKDIR /srv/app/
RUN chown -R www-data:www-data /srv/app

COPY . .
RUN apt update && apt install -y wget git zip unzip \
    &&wget https://getcomposer.org/composer.phar\
    &&php composer.phar install\
    &&cp .env.example .env\
    &&curl https://getcaddy.com | bash -s personal \
    && /usr/local/bin/caddy -version \
    && docker-php-ext-install mbstring pdo pdo_mysql

EXPOSE 443
CMD ["/usr/local/bin/caddy", "--conf", "/etc/Caddyfile", "--log", "stdout"]
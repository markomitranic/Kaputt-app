## Build
FROM php:7.3-fpm AS build

RUN apt-get update
RUN apt-get install -y wget zip unzip libzip-dev
RUN docker-php-ext-install zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ADD ./app/macura /app/macura
WORKDIR /app/macura/
# RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-scripts --no-plugins

## Runtime
FROM php:7.3-fpm AS prod

USER root
RUN apt-get update
COPY ./Docker/php/conf/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-app-fpm.conf
COPY ./Docker/php/conf/php.ini /usr/local/etc/php/conf.d/app-php.ini

ADD ./app/macura /app/macura/
COPY --from=build /app/macura/vendor/ /app/macura/vendor/
RUN mkdir -p /app/macura/var/cache

COPY ./Docker/php/entrypoint.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]

WORKDIR /app/macura

FROM prod AS dev
RUN apt-get install -y wget zip unzip libzip-dev git
RUN docker-php-ext-install zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./Docker/php/entrypoint-dev.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]

ARG XDEBUG_ACTIVE
ENV XDEBUG_ACTIVE=${XDEBUG_ACTIVE}
RUN if [ "$XDEBUG_ACTIVE" -eq 1 ] ; then \
        yes | pecl install xdebug \
        && PHP_IDE_CONFIG="serverName=kaputtweather.com" \
        && echo "zend_extension=xdebug.so" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.idekey=KAPUTT-DEBUG" >> /usr/local/etc/php/conf.d/xdebug.ini \
    ; fi

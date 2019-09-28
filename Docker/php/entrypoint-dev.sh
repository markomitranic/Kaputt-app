#!/bin/bash
set -e

COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-plugins --no-scripts

php-fpm -F -R

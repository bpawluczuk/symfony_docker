#!/usr/bin/env bash

PHP_NAME=$(grep PHP_NAME .env | xargs)
PHP_NAME=${PHP_NAME#*=}

sudo docker exec -it ${PHP_NAME} composer install
sudo docker exec -it ${PHP_NAME} php bin/console doctrine:migrations:migrate --no-interaction
#!/usr/bin/env bash

sleep 30

./bin/console doctrine:schema:update --force

php-fpm -R

FROM php:7.1.7-fpm

RUN apt-get update && docker-php-ext-install  pdo_mysql

WORKDIR /app
CMD ["bash", "/app/bin/boot.bash"]

COPY php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./app /app/
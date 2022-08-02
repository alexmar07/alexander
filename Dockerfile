FROM webdevops/php:8.1

COPY . /app

RUN composer install -d /app

WORKDIR /app
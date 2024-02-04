FROM php:8.2-fpm
RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install -j$(nproc) pdo pdo_pgsql
WORKDIR /app
CMD php -S 0.0.0.0:8080
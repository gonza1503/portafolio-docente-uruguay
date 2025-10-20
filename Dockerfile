# Stage 1: Build PHP dependencies using Composer
FROM composer:2 AS composer-deps
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Stage 2: Build assets using Node
FROM node:18 AS node-build
WORKDIR /var/www/html
COPY package.json package-lock.json ./
RUN npm install
COPY resources resources
COPY vite.config.js tailwind.config.js ./
RUN npm run build

# Stage 3: Prepare production image with PHP-FPM
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libzip-dev \
        unzip \
        git \
        curl \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy application source
COPY . .

# Copy composer dependencies
COPY --from=composer-deps /var/www/html/vendor ./vendor

# Copy built assets
COPY --from=node-build /var/www/html/public ./public

# Expose port 8000 for php built-in server
EXPOSE 8000

# Command to run migrations and start the server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000

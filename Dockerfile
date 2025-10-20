# Stage 1: instala dependencias PHP usando Composer
FROM composer:2 AS composer-deps
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Stage 2: compila los assets con Node
FROM node:18 AS node-build
WORKDIR /var/www/html
COPY package.json ./
RUN npm install
COPY resources resources
COPY vite.config.js tailwind.config.js ./
RUN npm run build

# Stage 3: imagen final con PHP-FPM
FROM php:8.3-fpm

# Instala extensiones y utilidades del sistema
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

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia el código de la aplicación
COPY . .

# Copia las dependencias de Composer desde la etapa 1
COPY --from=composer-deps /var/www/html/vendor ./vendor

# Copia los assets compilados desde la etapa 2
COPY --from=node-build /var/www/html/public ./public

# Expone el puerto 8000 para el servidor de desarrollo
EXPOSE 8000

# Ejecuta migraciones y lanza el servidor
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000


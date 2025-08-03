FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libxml2-dev \
  && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html/backend

COPY backend/ ./

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
  && composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/backend

CMD ["php-fpm"]

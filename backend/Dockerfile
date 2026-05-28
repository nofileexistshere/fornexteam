FROM php:8.3-fpm-alpine

# Install system packages
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    zip \
    unzip \
    sqlite \
    sqlite-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    linux-headers \
    libxml2-dev \
    fontconfig \
    ttf-dejavu

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_sqlite \
        pdo_mysql \
        mbstring \
        zip \
        bcmath \
        gd \
        intl \
        pcntl \
        exif \
        dom \
        xml \
        xmlwriter

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application source
COPY . .

# Install PHP dependencies (production)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Create all required storage directories
RUN mkdir -p /var/www/html/storage/app/livewire-tmp \
    && mkdir -p /var/www/html/storage/app/public \
    && mkdir -p /var/www/html/storage/framework/cache/data \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/logs

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# PHP config
COPY docker/php.ini /usr/local/etc/php/conf.d/app.ini

# Nginx config
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Supervisor config
COPY docker/supervisord.conf /etc/supervisord.conf

# Entrypoint
COPY deploy.sh /deploy.sh
RUN chmod +x /deploy.sh

RUN mkdir -p /var/log/supervisor /run/nginx \
    && mkdir -p /tmp/nginx_client_body /tmp/nginx_proxy /tmp/nginx_fastcgi \
    && chmod -R 777 /tmp/nginx_client_body /tmp/nginx_proxy /tmp/nginx_fastcgi

EXPOSE 80

ENTRYPOINT ["/deploy.sh"]

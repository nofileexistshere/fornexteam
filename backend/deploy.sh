#!/bin/sh
set -e

echo "==> Running migrations..."
php artisan migrate

echo "==> Clearing all caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
php artisan optimize:clear

echo "==> Creating storage symlink..."
php artisan storage:link || true

echo "==> Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "==> Starting services..."
exec supervisord -c /etc/supervisord.conf

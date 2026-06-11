#!/bin/sh
set -e

cd /var/www/html

echo "==> Clearing old caches..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

echo "==> Initializing packages..."
php artisan package:discover --ansi

echo "==> Running migrations..."
php artisan migrate --force || true

echo "==> Building caches..."
php artisan filament:optimize
php artisan config:cache
php artisan view:cache
php artisan storage:link 2>/dev/null || true

echo "==> Starting PHP-FPM..."
php-fpm -D

# Wait for PHP-FPM to be ready
sleep 2

echo "==> Checking PHP-FPM..."
if ! pgrep php-fpm > /dev/null; then
    echo "ERROR: PHP-FPM failed to start"
    exit 1
fi

echo "==> Starting Nginx on port 10000..."
exec nginx -g "daemon off;"

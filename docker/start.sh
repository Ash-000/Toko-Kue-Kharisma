#!/bin/sh
set -e

cd /var/www/html

echo "==> Running artisan commands..."
php artisan package:discover --ansi || true
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true
php artisan migrate --force || true
php artisan storage:link || true

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

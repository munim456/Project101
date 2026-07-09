#!/bin/bash
set -e

cd /home/u927333385/domains/unipexel.org/cgmp_app

echo "==> Pulling latest master..."
git pull origin master

echo "==> Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "==> Rebuilding caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Deploy complete."
echo "NOTE: frontend assets (public/build) are NOT rebuilt by this script -- node_modules isn't installed on this server."
echo "If this deploy includes JS/CSS/Blade-component-that-imports-assets changes, run 'npm run build' locally and scp the public/build directory over separately."

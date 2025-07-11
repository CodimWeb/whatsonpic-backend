#!/bin/bash
set -e
chmod 777 -R ./
echo "🎯 Запуск инициализации Laravel..."

composer install
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
echo "🚀 Запуск PHP-FPM..."
exec php-fpm


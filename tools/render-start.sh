#!/bin/sh
set -eu

mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

if [ -z "${APP_KEY:-}" ]; then
  export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
  echo "APP_KEY was missing; generated a temporary application key for this container."
fi

php artisan optimize:clear || true
php artisan storage:link || true
php artisan migrate --force || true
php artisan db:seed --force || true

exec php artisan serve --host=0.0.0.0 --port="${PORT:-80}"

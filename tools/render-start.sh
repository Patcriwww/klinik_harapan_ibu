#!/bin/sh
set -eu

mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

if [ -z "${DB_CONNECTION:-}" ]; then
  if [ -n "${DATABASE_URL:-}" ] || [ -n "${PGHOST:-}" ] || [ -n "${POSTGRES_HOST:-}" ]; then
    export DB_CONNECTION=pgsql
  fi
fi

if [ -z "${DB_HOST:-}" ]; then
  if [ -n "${PGHOST:-}" ]; then
    export DB_HOST="${PGHOST}"
  elif [ -n "${POSTGRES_HOST:-}" ]; then
    export DB_HOST="${POSTGRES_HOST}"
  fi
fi

if [ -z "${DB_PORT:-}" ]; then
  if [ -n "${PGPORT:-}" ]; then
    export DB_PORT="${PGPORT}"
  elif [ -n "${POSTGRES_PORT:-}" ]; then
    export DB_PORT="${POSTGRES_PORT}"
  fi
fi

if [ -z "${DB_DATABASE:-}" ]; then
  if [ -n "${PGDATABASE:-}" ]; then
    export DB_DATABASE="${PGDATABASE}"
  elif [ -n "${POSTGRES_DB:-}" ]; then
    export DB_DATABASE="${POSTGRES_DB}"
  fi
fi

if [ -z "${DB_USERNAME:-}" ]; then
  if [ -n "${PGUSER:-}" ]; then
    export DB_USERNAME="${PGUSER}"
  elif [ -n "${POSTGRES_USER:-}" ]; then
    export DB_USERNAME="${POSTGRES_USER}"
  fi
fi

if [ -z "${DB_PASSWORD:-}" ]; then
  if [ -n "${PGPASSWORD:-}" ]; then
    export DB_PASSWORD="${PGPASSWORD}"
  elif [ -n "${POSTGRES_PASSWORD:-}" ]; then
    export DB_PASSWORD="${POSTGRES_PASSWORD}"
  fi
fi

if [ -z "${DB_SSLMODE:-}" ]; then
  if [ -n "${PGSSLMODE:-}" ]; then
    export DB_SSLMODE="${PGSSLMODE}"
  elif [ -n "${DATABASE_URL:-}" ] || [ -n "${PGHOST:-}" ] || [ -n "${POSTGRES_HOST:-}" ]; then
    export DB_SSLMODE=require
  fi
fi

if [ -z "${APP_KEY:-}" ]; then
  export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
  echo "APP_KEY was missing; generated a temporary application key for this container."
fi

php artisan optimize:clear || true
php artisan storage:link || true
php artisan migrate --force || true
php artisan db:seed --force || true

exec php artisan serve --host=0.0.0.0 --port="${PORT:-80}"

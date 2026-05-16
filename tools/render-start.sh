#!/bin/sh
set -eu

mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache
mkdir -p database

DB_RUNTIME_SOURCE="unknown"

if [ -z "${DB_CONNECTION:-}" ]; then
  if [ -n "${DATABASE_URL:-}" ] || [ -n "${PGHOST:-}" ] || [ -n "${POSTGRES_HOST:-}" ]; then
    export DB_CONNECTION=pgsql
    DB_RUNTIME_SOURCE="postgres-env"
  fi
fi

if [ -z "${DB_HOST:-}" ]; then
  if [ -n "${PGHOST:-}" ]; then
    export DB_HOST="${PGHOST}"
    DB_RUNTIME_SOURCE="postgres-env"
  elif [ -n "${POSTGRES_HOST:-}" ]; then
    export DB_HOST="${POSTGRES_HOST}"
    DB_RUNTIME_SOURCE="postgres-env"
  fi
fi

if [ -z "${DB_PORT:-}" ]; then
  if [ -n "${PGPORT:-}" ]; then
    export DB_PORT="${PGPORT}"
    DB_RUNTIME_SOURCE="postgres-env"
  elif [ -n "${POSTGRES_PORT:-}" ]; then
    export DB_PORT="${POSTGRES_PORT}"
    DB_RUNTIME_SOURCE="postgres-env"
  fi
fi

if [ -z "${DB_DATABASE:-}" ]; then
  if [ -n "${PGDATABASE:-}" ]; then
    export DB_DATABASE="${PGDATABASE}"
    DB_RUNTIME_SOURCE="postgres-env"
  elif [ -n "${POSTGRES_DB:-}" ]; then
    export DB_DATABASE="${POSTGRES_DB}"
    DB_RUNTIME_SOURCE="postgres-env"
  fi
fi

if [ -z "${DB_USERNAME:-}" ]; then
  if [ -n "${PGUSER:-}" ]; then
    export DB_USERNAME="${PGUSER}"
    DB_RUNTIME_SOURCE="postgres-env"
  elif [ -n "${POSTGRES_USER:-}" ]; then
    export DB_USERNAME="${POSTGRES_USER}"
    DB_RUNTIME_SOURCE="postgres-env"
  fi
fi

if [ -z "${DB_PASSWORD:-}" ]; then
  if [ -n "${PGPASSWORD:-}" ]; then
    export DB_PASSWORD="${PGPASSWORD}"
    DB_RUNTIME_SOURCE="postgres-env"
  elif [ -n "${POSTGRES_PASSWORD:-}" ]; then
    export DB_PASSWORD="${POSTGRES_PASSWORD}"
    DB_RUNTIME_SOURCE="postgres-env"
  fi
fi

if [ -z "${DB_SSLMODE:-}" ]; then
  if [ -n "${PGSSLMODE:-}" ]; then
    export DB_SSLMODE="${PGSSLMODE}"
    DB_RUNTIME_SOURCE="postgres-env"
  elif [ -n "${DATABASE_URL:-}" ] || [ -n "${PGHOST:-}" ] || [ -n "${POSTGRES_HOST:-}" ]; then
    export DB_SSLMODE=require
    DB_RUNTIME_SOURCE="postgres-env"
  fi
fi

if [ "${DB_CONNECTION:-}" = "pgsql" ] && [ -z "${DATABASE_URL:-}" ] && [ -z "${DB_HOST:-}" ]; then
  export DB_CONNECTION=sqlite
  export DB_DATABASE=/var/www/html/database/database.sqlite
  unset DB_HOST DB_PORT DB_USERNAME DB_PASSWORD DB_SSLMODE
  DB_RUNTIME_SOURCE="sqlite-fallback"
fi

if [ "${DB_CONNECTION:-}" = "sqlite" ] && [ -z "${DB_DATABASE:-}" ]; then
  export DB_DATABASE=/var/www/html/database/database.sqlite
  DB_RUNTIME_SOURCE="sqlite-fallback"
fi

if [ "${DB_CONNECTION:-}" = "sqlite" ]; then
  touch "${DB_DATABASE}"
fi

if [ -z "${APP_KEY:-}" ]; then
  export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
  echo "APP_KEY was missing; generated a temporary application key for this container."
fi

echo "Booting with DB connection '${DB_CONNECTION:-unset}' from ${DB_RUNTIME_SOURCE}."

php artisan optimize:clear || true
php artisan storage:link || true
php artisan migrate --force || true
php artisan db:seed --force || true

exec php artisan serve --host=0.0.0.0 --port="${PORT:-80}"

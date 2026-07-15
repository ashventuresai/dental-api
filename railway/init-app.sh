#!/bin/bash

set -e

php artisan migrate --force

php artisan tenants:migrate --force
echo "Migrations completed successfully."

php artisan optimize:clear

php artisan config:cache

php artisan route:cache

php artisan view:cache

#!/bin/bash

set -e

php artisan migrate  --seed --force

php artisan optimize:clear

php artisan config:cache

php artisan route:cache

php artisan view:cache

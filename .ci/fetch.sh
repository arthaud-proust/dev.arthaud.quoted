#!/bin/sh

php artisan down

git reset --hard origin/release/production

# update database
php artisan migrate --force

php artisan up

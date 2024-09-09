#!/bin/sh

php artisan down

git fetch
git reset --hard origin/release/main

# update database
php artisan migrate --force

php artisan up

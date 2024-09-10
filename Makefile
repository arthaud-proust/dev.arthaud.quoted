deploy:
	php artisan down
	git fetch
	git reset --hard origin/release/main
	composer install
	php artisan migrate --force
	php artisan up

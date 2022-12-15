start:
	php artisan serve --host=0.0.0.0
install:
	composer install
validate:
	composer validate
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app config routes
lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app config routes
phpstan:
	composer exec phpstan analyse
test:
	php artisan optimize:clear && php artisan test
start-db:
	sudo service postgresql start
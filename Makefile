start:
	php artisan serve --host=0.0.0.0
install:
	composer install
validate:
	composer validate
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app tests config
lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app tests config
phpstan:
	composer exec phpstan analyse
test:
	php artisan test
setup-ci:
	install key database-prepare
env-prepare:
	php -r "file_exists('.env') || copy('.env.example', '.env');"
key: 
	php artisan key:gen --ansi
database-prepare:
	php artisan migrate:fresh --seed
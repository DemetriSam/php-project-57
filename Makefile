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
	env-prepare install key database-prepare
env-prepare:
	cp -n .env.example .env || true
key: 
	php artisan key:gen --ansi
database-prepare:
	php artisan migrate:fresh --seed
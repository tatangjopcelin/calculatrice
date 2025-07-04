test:
	vendor/bin/phpunit --testdox

serve:
	php -S localhost:8000 -t public

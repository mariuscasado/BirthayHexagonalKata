test:
	docker-compose run phpunit

start:
	docker-compose run composer install

init: start test

install:
	docker-compose run composer require $(dependency)
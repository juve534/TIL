container=app

init:
	docker-compose up -d
	docker-compose exec $(container) composer install

up:
	docker-compose up -d

down:
	docker-compose down

composer:
	docker-compose exec $(container) composer $(CMD)

build:
	docker-compose build
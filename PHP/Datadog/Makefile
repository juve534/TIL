container=app

init:
	docker-compose up -d
	docker-compose exec $(container) composer install
	sh init.sh "docker-compose exec app"

up:
	docker-compose up -d

down:
	docker-compose down

composer:
	docker-compose exec $(container) composer $(CMD)

bref:
	docker-compose exec $(container) vendor/bin/bref $(CMD)
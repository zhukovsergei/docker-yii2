up: docker-up
down: docker-down
build: docker-build
rest: restart
restb: docker-down docker-build docker-up
restart: docker-down docker-up
bash: docker-bash
test: nginx-test

docker-up:
	docker compose up -d

docker-down:
	docker compose down --remove-orphans

docker-build:
	docker compose build

docker-bash:
	docker compose exec -it php-fpm bash

nginx-test:
	docker compose exec -it nginx nginx -t

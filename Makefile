up: docker-up
down: docker-down
build: docker-build
rest: restart
restb: docker-down docker-build docker-up
restart: docker-down docker-up
bash: docker-bash

docker-up:
	sudo docker compose up -d

docker-down:
	sudo docker compose down --remove-orphans

docker-build:
	sudo docker compose build

docker-bash:
	sudo docker compose exec -it php-fpm bash

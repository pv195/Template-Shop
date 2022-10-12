MAKEFLAGS += --silent

.PHONY: build up down logs reset exec
build:
	docker-compose build --no-cache

up:
	docker-compose up -d

stop:
	docker compose stop

down:
	docker compose down --remove-orphans

logs:
	docker-compose logs -f

reset: down build up

exec:
	docker compose exec app bash

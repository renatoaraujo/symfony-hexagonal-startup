.PHONY: setup build up down vendor test diff migrate fixtures stats cache destroy database environment-file sleep
setup: build up vendor cache stats environment-file sleep database test

build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

vendor:
	docker-compose exec app composer install --no-scripts

test: migrate fixtures
	docker-compose exec app bin/phpunit --configuration phpunit.xml

diff:
	docker-compose exec app bin/console doctrine:migrations:diff -n

migrate:
	docker-compose exec app bin/console doctrine:migrations:migrate -n

fixtures:
	docker-compose exec app bin/console doctrine:fixtures:load -n

stats:
	docker-compose ps

cache:
	docker-compose exec app bin/console cache:clear
	docker-compose exec app bin/console cache:warmup

destroy:
	docker-compose down
	rm -rf vendor
	rm -rf bin/*
	rm -f .env.local

sleep:
	sleep 25

database:
	docker-compose exec app bin/console doctrine:migrations:migrate -n
	docker-compose exec app bin/console doctrine:fixtures:load -n

environment-file:
	docker-compose exec app cp -u .env .env.local

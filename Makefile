.PHONY: setup build up down vendor test diff migrate fixtures stats cache destroy environment-file sleep fix-permissions
setup: build up fix-permissions vendor cache environment-file sleep migrate fixtures stats

build:
	@set -o allexport; source .env; set +o allexport
	@docker-compose build

up:
	@set -o allexport; source .env; set +o allexport
	@docker-compose up -d

down:
	@docker-compose down

vendor:
	@docker-compose exec app composer install --no-scripts

vendor-update:
	@docker-compose exec app composer update --no-scripts

test:
	@docker-compose exec app rm -rf tests/migrations var/db
	@docker-compose exec app mkdir var/db
	@docker-compose exec app chmod -R 777 var/db
	@docker-compose exec app bin/console --env test doctrine:migrations:diff -n
	@docker-compose exec app bin/console --env test doctrine:migrations:migrate -n
	@docker-compose exec app vendor/bin/phpunit --configuration phpunit.xml

diff:
	@docker-compose exec app bin/console doctrine:migrations:diff -n

migrate:
	@docker-compose exec app bin/console doctrine:migrations:migrate -n

fixtures:
	@docker-compose exec app bin/console doctrine:fixtures:load -n

stats:
	@docker-compose ps

cache:
	@docker-compose exec app bin/console cache:clear
	@docker-compose exec app bin/console cache:warmup

destroy:
	@docker-compose down
	@rm -rf vendor
	@rm -rf var/*
	@rm -f .env.local

sleep:
	@sleep 25

environment-file:
	@docker-compose exec app cp -u .env .env.local

create-missing-dir:
	@docker-compose exec app mkdir -p /app/var/cache /app/var/log

fix-permissions:
	@docker-compose exec app chmod -R 777 /app/bin /app/var

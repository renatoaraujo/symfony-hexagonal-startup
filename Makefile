.PHONY: setup
setup: build up vendor cache environment-file test-configuration-file database

.PHONY: setup-n-test
setup-n-test: setup test

.PHONY: build
build:
	docker-compose build

.PHONY: up
up:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down

.PHONY: stats
stats:
	docker-compose ps

.PHONY: destroy
destroy:
	docker-compose exec app rm -rf ./vendor
	docker-compose exec app rm -rf ./bin/.phpunit
	docker-compose exec app rm -f ./.env.local
	docker-compose exec app rm -f ./phpunit.xml
	docker-compose down

.PHONY: vendor
vendor:
	docker-compose exec app composer install --no-scripts

.PHONY: test
test:
	docker-compose exec app bin/console doctrine:schema:update --force --env test
	docker-compose exec app bin/console doctrine:fixtures:load --no-interaction --env test
	docker-compose exec app bin/phpunit --configuration phpunit.xml
	docker-compose exec app bin/console doctrine:schema:drop --force --env test

.PHONY: diff
diff:
	docker-compose exec app bin/console doctrine:migrations:diff --no-interaction

.PHONY: migrate
migrate:
	docker-compose exec app bin/console doctrine:migrations:migrate --no-interaction

.PHONY: fixtures
fixtures:
	docker-compose exec app bin/console doctrine:fixtures:load --no-interaction

.PHONY: cache
cache:
	docker-compose exec app bin/console cache:clear --env test
	docker-compose exec app bin/console cache:warmup --env test

.PHONY: database
database:
	sleep 10
	docker-compose exec app bin/console doctrine:migrations:migrate --no-interaction --env dev
	docker-compose exec app bin/console doctrine:fixtures:load --no-interaction --env dev

.PHONY: environment-file
environment-file:
	docker-compose exec app cp -n .env .env.local

.PHONY: test-configuration-file
test-configuration-file:
	docker-compose exec app cp -n phpunit.xml.dist phpunit.xml
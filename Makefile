.PHONY: setup
setup: build up vendor cache stats environment-file test-configuration-file test

.PHONY: build
build:
	docker-compose build

.PHONY: up
up:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down

.PHONY: vendor
vendor:
	docker-compose exec app composer install --no-scripts

.PHONY: test
test: migrate fixtures
	docker-compose exec app bin/phpunit -c phpunit.xml

.PHONY: diff
diff:
	docker-compose exec app bin/console doctrine:migrations:diff -n

.PHONY: migrate
migrate:
	docker-compose exec app bin/console doctrine:migrations:migrate -n

.PHONY: fixtures
fixtures:
	docker-compose exec app bin/console doctrine:fixtures:load -n

.PHONY: stats
stats:
	docker-compose ps

.PHONY: cache
cache:
	docker-compose exec app bin/console cache:clear
	docker-compose exec app bin/console cache:warmup

.PHONY: destroy
destroy:
	docker-compose down
	rm -rf vendor
	rm -rf bin/.phpunit
	rm -f .env.local
	rm -f phpunit.xml

.PHONY: database
database:
	sleep 25
	docker-compose exec app bin/console doctrine:migrations:migrate -n
	docker-compose exec app bin/console doctrine:fixtures:load -n

.PHONY: environment-file
environment-file:
	docker-compose exec app cp -n .env .env.local

.PHONY: test-configuration-file
test-configuration-file:
	docker-compose exec app cp -n phpunit.xml.dist phpunit.xml


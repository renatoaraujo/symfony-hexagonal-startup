.PHONY: setup
setup: build up vendor clear-cache stats

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
test:
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

.PHONY: db
db: migrate load-data

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


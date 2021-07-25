install:
	docker-compose build
	docker-compose up -d
	docker-compose exec php-fpm composer install
	docker-compose exec php-fpm supervisorctl start all

update:
	docker-compose build
	docker-compose up -d
	docker-compose exec php-fpm composer update
	docker-compose exec php-fpm supervisorctl start all

client-order-receipt:
	docker-compose exec php-fpm php bin/console client:order:receipt

supervisord-start:
	docker-compose exec php-fpm supervisorctl start all

supervisord-restart:
	docker-compose exec php-fpm supervisorctl restart all

supervisord-stop:
	docker-compose exec php-fpm supervisorctl stop all

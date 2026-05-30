init:
	docker compose up --build -d
	docker compose exec app composer install
	chmod -R 777 runtime web/assets

start:
	docker compose up -d

test:
	docker compose exec app vendor/bin/codecept build
	docker compose exec app vendor/bin/codecept run Unit Models/EvenSumRequestFormTest.php
	docker compose exec app vendor/bin/codecept run tests/Unit/Services/EvenSumCalculatorTest.php

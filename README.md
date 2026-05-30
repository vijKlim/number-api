# Backend Lab API

Small REST API built with **PHP 8.3** and **Yii2 Basic**.

The API accepts a JSON request with an array of numbers and returns the sum of even numbers.

## Features

- REST API endpoint
- JSON request/response
- Yii2 request validation model
- DTO for data transfer
- Service layer with interface
- Unit tests with Codeception/PHPUnit
- Docker-based setup
- Nginx reverse proxy
- API key authentication
- Basic production-oriented protections:
    - request validation
    - request body size limit
    - request timeout
    - rate limiting on reverse proxy level

## API Endpoint

```http
POST /api/even-sum
```

### Headers

```http
Content-Type: application/json
X-API-Key: dev-secret-key
```

### Request Example

```json
{
  "numbers": [1, 2, 3, 4, 5, 6]
}
```

### Response Example

```json
{
  "sum": 12
}
```

### Validation Error Example

```json
{
  "errors": {
    "numbers": "All numbers must be integers."
  }
}
```

## Project Structure

```text
controllers/
  EvenSumController.php

models/
  EvenSumRequestForm.php

dto/
  EvenSumRequestDto.php
  EvenSumResponseDto.php

services/
  EvenSumCalculator.php
  contracts/
    EvenSumCalculatorInterface.php

components/
  auth/
    ApiKeyAuth.php

tests/
  Unit/
    Models/
      EvenSumRequestFormTest.php
    Services/
      EvenSumCalculatorTest.php
```

## Architecture

```text
HTTP Request
  ↓
ApiKeyAuth
  ↓
EvenSumRequestForm
  ↓
EvenSumRequestDto
  ↓
EvenSumCalculatorInterface
  ↓
EvenSumCalculator
  ↓
EvenSumResponseDto
  ↓
JSON Response
```

### Design Principles

- Thin Controller
- Separation of Concerns
- Dependency Injection
- Interface-based Service Layer
- DTO Pattern
- Request Validation
- Unit Testing

## Performance

The calculation is performed in a single pass over the input array.

Time complexity:

```text
O(n)
```

Memory complexity:

```text
O(1)
```

## Security

Implemented:

- API Key Authentication
- Request Validation
- Request Body Size Limit
- Request Timeout
- Nginx Rate Limiting

Production recommendations:

- Store API keys in secrets manager
- Add JWT/OAuth2 authentication
- Add monitoring and logging
- Add centralized rate limiting

## Installation

```bash
make init
```

### Makefile

```makefile
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
```

## Start Application

```bash
make start
```

Application URL:

```text
http://localhost:8000
```

## Run Tests

```bash
make test
```

## cURL Example

```bash
curl -X POST http://localhost:8000/api/even-sum \
  -H "Content-Type: application/json" \
  -H "X-API-Key: dev-secret-key" \
  -d '{"numbers":[1,2,3,4,5,6]}'
```

Expected response:

```json
{
  "sum": 12
}
```

# Example for cloudpack/rorschach

Run API server and API test with cloudpack/rorschach.

## About Rorschach

Look [this](https://github.com/cloudpack/Rorschach) !

## Install

Install package.
```bash
composer install
```

## Usage

Run PHP built-in server.
```bash
php -S localhost:8888 server.php
```

Run API test with rorschach.
```bash
composer exec rorschach inspect -- --file='test-api.yml' --bind='{"port": 8888}' --saikou
```

## Expect result
```
GET /items/1
	[has]	PASSED.	code
	[has]	PASSED.	name
	[has]	PASSED.	size
	[value]	PASSED.	MBA
GET /users
	[code]	PASSED.	200
	[has]	PASSED.	.id
	[has]	PASSED.	.name
	[type]	PASSED.	integer
	[type]	PASSED.	string
	[value]	PASSED.	1
	[value]	PASSED.	Michel
GET /redirect
	[code]	PASSED.	302
GET /redirect
	[code]	PASSED.	200
Congrats!!🍻 
```
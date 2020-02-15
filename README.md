<center><h1>sb-Flip</h1></center>

sb-Flip is a service to help e-commerce seller disburse their credit into money via designated bank. The service provide APIs to store disbursements, and check the status of each disbursement.

## Built With
[![PHP](https://img.shields.io/badge/PHP-7.3.x-purple.svg?style=rounded-square)](https://www.php.net/)

## Requirement
* PHP Server (e.g XAMPP)
* [Postmant](https://www.getpostman.com/) or [Insomnia](https://insomnia.rest/) (API Tester, Optional)

## Setup
1. Clone this repository to your local directory (e.g  C:\xampp\htdocs\sb-flip)
2. Create database in your local machine (e.g `flip_test`) via phpmyadmin or any other DBMS
3. Go to the project directory and open file `config.php` inside config folder to set your database connection. [See here](#database-setup)
4. Open Command Prompt or Terminal and move to project directory
5. Type `php config\migrate.php` to run database migration

## Database Setup
Open `config.php` file inside config to seup your database.
```
public $DB_HOST = "localhost"; 
public $DB_USER = "root";
public $DB_PASS = "";
public $DB_NAME = "flip_test";
```

## End Point
1. Create Disbursement
	* cURL
	Open Command Prompt or Terminal and Type :
	```
	curl -i -X POST -d "{\"bank_code\":\"bni\",\"account_number\":9872837982,\"amount\":40000,\"remark\":\"Sample Remark\"}" http://localhost/sb-flip/service/disbursement/create.php
	```
	* API Tester
	```
	URL:	http://localhost/sb-flip/service/disbursement/create.php
	Method: POST
	Header: 
	{
		Content-Type: application/json
	}
	URL Params: 
		-
	Body Params:
	{
		"bank_code": "bni",
		"account_number": 102937987,
		"amount": 40000,
		"remark": "Sample"
	}
	```

2. Check Disbursement Status
	* cURL
	Open Command Prompt or Terminal and Type :
	```
	curl -i -X GET http://localhost/sb-flip/service/disbursement/check.php?id=998738298
	```
	* API Tester
	```
	URL:	http://localhost/sb-flip/service/disbursement/check.php?id=998738298
	Method: GET
	Header: 
	{
		Content-Type: application/json
	}
	URL Params: 
		id: disbursement transaction id
	Body Params:
		-
	```

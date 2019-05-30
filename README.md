
TODO CRUD Application (partial)
===

This repo houses the beginning of a simple CRUD application, using tools like `composer` and `phpunit` + two interfaces `InterfaceTodo` and `InterfaceTodoList`.

The goal is to create a simple TODO CRUD application and extend the current codebase. You should make use of any (and all) modern development practices, as well as following [PSR-2](https://www.php-fig.org/psr/psr-2/) and [PSR-4](https://www.php-fig.org/psr/psr-4/). You should use PDO and an sqlite file for the database. 

The application will not be judged on its user interface. You will be judged on the quality of your server-side code. This includes:

1. The code functions correctly
1. The code is easy to read
1. The code is well documented
1. The code is unit tested
1. The code contains no security issues (the inputs are santized and the outputs are escaped)
1. The code uses modern OOP

## Getting started

1. Clone the repo locally

2. Run `composer install` do download all the dependancies

3. `cd` into the `public` directory from this repo and start the application from the terminal using `php -S localhost:8000`

4. Navigate to `localhost:8000` in your browser to execute your application

## Unit Testing

The key components of your application should be unit tested. 

Place your tests in the `tests` directory.

To run the tests, from the root of the repo, run `vendor/bin/phpunit --bootstrap vendor/autoload.php tests` from the terminal to execute the unit tests. 

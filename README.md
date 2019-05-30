
TODO CRUD Application (partial)
===

This repo houses the beginning of a simple CRUD application, using tools like `composer` and `phpunit` + two interfaces `InterfaceTodo` and `InterfaceTodoList`.

The goal is to create a simple TODO CRUD application and extend the current codebase. You should make use of any (and all) modern development practices. 

## Getting started

1. Clone the repo locally

2. Run `composer install` do download all the dependancies

3. `cd` into the `public` directory from this repo and start the application from the terminal using `php -S localhost:8000`

4. Navigate to `localhost:8000` in your browser to execute your application

## Unit Testing

The key components of your application should be unit tested. 

Place your tests in the `tests` directory.

To run the tests, from the root of the repo, run `vendor/bin/phpunit --bootstrap vendor/autoload.php tests` from the terminal to execute the unit tests. 

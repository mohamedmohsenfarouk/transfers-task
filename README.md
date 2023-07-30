## Installation Steps

-   Clone project
-   Run this commands in terminal
    -   composer update
    -   php artisan migrate

- Here's the documentation for the Postman collection to test API Requests:
  - [ Postman Documentation ](https://documenter.getpostman.com/view/25685260/2s9Xxtxb4N).

- Run this command to serve
    - sudo php -S localhost:8003 -t public 

- Run this command for unit testing
    - vendor/bin/phpunit --filter=testShouldReturnAllTransactions
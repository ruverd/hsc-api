# hsc-api
API made in Laravel with architecture DDD (Domain Driven Design)

## Dependencies
  - php 7.2
  - mysql 5.7
  - yarn
  - composer

## How to install

Clone repository and install dependencies
```shell
git clone git@github.com:ruverd/hsc-api.git hsc-api
composer install
```

Rename your file `.env.example` to `.env`

Create JWT key and APP key
```shell
php artisan key:generate 
php artisan jwt:secret
```

Configure the `.env` file after configuring run the command below to create the database and initial seed:

```shell
php artisan migrate --seed
```

Run server

```shell
php artisan serve
```

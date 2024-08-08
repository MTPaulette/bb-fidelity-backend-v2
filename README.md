# BB-FIDELITY-SYST

Concerned about customer loyalty, the company Brain-booster had the idea of setting up a reward system for its customers. The system designed here was created for this purpose.

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/)

# Languages and dependencies

Project built using [Laravel](https://laravel.com/docs). This project is also running [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) for setup authentification and authorization.

## Project Setup

```sh
composer install
```

### Starting server

```sh
docker compose up
```

### set database

```sh
php artisan migrate
```

### Fill the database tables using seeders

```sh
php artisan db:seed --class=RoleSeeder &&
php artisan db:seed --class=UserSeeder &&
php artisan db:seed --class=ServiceSeeder &&
php artisan db:seed --class=PurchaseSeeder &&
```


### Compile and Hot-Reload for Development

```sh
php artisan serve
```


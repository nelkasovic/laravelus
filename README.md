# drehbu.ch
A basic laravel start package.

* User Management<br>
Manage users/companies which are able to sign in and use the application.
* Person Management<br>
Manage persons/customers with basic contact data.

# Settings
* Create DB "drehbuch" and edit the .env file

# Run following commands
* /opt/php73/bin/php artisan route:clear
* /opt/php73/bin/php artisan config:clear
* /opt/php73/bin/php artisan view:clear
* /opt/php73/bin/php artisan cache:clear
* /opt/php73/bin/php down
* /opt/php73/bin/php migrate:install
* /opt/php73/bin/php migrate
* /opt/php73/bin/php db:seed
* /opt/php73/bin/php up

# Laravel cheat sheet
- Install:      php artisan migrate:install [ --env="production" ]
- Migrate:      php artisan migrate
- Refresh:      php artisan migrate:refresh [ --seed ]
- Seed one:     php artisan db:seed --class=UsersTableSeeder
- Seed:         php artisan db:seed
- Clear:        php artisan config:clear
- Dump:         composer dump-autoload
- Seeder:       php artisan make:seeder OrdersTableSeeder
- Controller:   php artisan make:controller OrderController
- Resource:     php artisan make:controller Client --resource
- Pivot:        php artisan make:migration:pivot clients orders
- Model:        php artisan make:model Order --migration
- Policy:       php artisan make:policy PersonPolicy --model=Person
- Laravel:      composer require akaunting/language
- Provider:     php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
- Auth:         php artisan make:auth
- Routes:       php artisan route:list
- Search:       php artisan scout:import "App\Role"

# Vendors info
- php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
- php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"

# Requirements info
- composer require spatie/laravel-permission
- composer require laravel/scout
- composer require algolia/algoliasearch-client-php

# Enable Search Scope
- php artisan scout:import "App\Role"

# Spatie permissions
- https://stackoverflow.com/questions/37260860/laravel-rolemiddleware-class-role-not-found
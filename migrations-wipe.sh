#!/bin/bash
php artisan db:wipe
php artisan migrate --path=/database/migrations/Default
php artisan migrate --path=/database/migrations
php artisan migrate --path=/database/migrations/Aux
php artisan migrate --path=/database/migrations/Setting
php artisan migrate --path=/database/migrations/Website
php artisan migrate --path=/database/migrations/Auth
php artisan migrate --path=/database/migrations/Crm
php artisan migrate --path=/database/migrations/School
php artisan migrate --seed

#!/bin/bash
php artisan db:wipe
php artisan migrate --path=/database/migrations/Default
php artisan migrate --path=/database/migrations
php artisan migrate --path=/database/migrations/Aux
php artisan migrate --path=/database/migrations/School
php artisan migrate --path=/database/migrations/Auth
php artisan migrate --seed

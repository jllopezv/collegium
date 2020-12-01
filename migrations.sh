#!/bin/bash
php artisan db:wipe
php artisan migrate --path=/database/migrations/default
php artisan migrate --path=/database/migrations
php artisan migrate --path=/database/migrations/aux
php artisan migrate --path=/database/migrations/school
php artisan migrate --path=/database/migrations/auth
php artisan migrate --seed

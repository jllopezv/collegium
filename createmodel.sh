#!/bin/bash

if [ $1 ]
then
    if [ $1 = "-h" ]
    then
        echo "createmodel model [module] [ref views.models.ref to copy] [model in plural]"
        echo "Create Language Model in Aux folder: createmodel.sh Language Aux Countries Languages"
        exit
    fi
fi
string1=$1
string2=$2
string3=$3
string4=$4
php artisan make:migration Create$4Table --path=database/migrations/$2
php artisan make:model $2/$1
php artisan make:livewire $2/$1Component
rm ./resources/views/livewire/"${string2,,}"/"${string1,,}"-component.blade.php
php artisan make:controller $2/$1Controller -r
mkdir ./resources/views/models/"${string2,,}"/"${string4,,}"
cp ./resources/views/models/"${string2,,}"/"${string3,,}"/* ./resources/views/models/"${string2,,}"/"${string4,,}"
mkdir ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"
cp ./resources/views/livewire/tables/"${string2,,}"/"${string3,,}"/* ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"
mv ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/"${string3,,}"-index.blade.php  ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/"${string4,,}"-index.blade.php
mv ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/"${string3,,}"-create.blade.php  ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/"${string4,,}"-create.blade.php
mv ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/"${string3,,}"-edit.blade.php  ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/"${string4,,}"-edit.blade.php
mv ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/"${string3,,}"-show.blade.php  ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/"${string4,,}"-show.blade.php
mv ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/indexbody.blade.php  ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/indexbody.blade.php
mv ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/indexbodyxs.blade.php  ./resources/views/livewire/tables/"${string2,,}"/"${string4,,}"/indexbodyxs.blade.php

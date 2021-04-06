<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('website.welcome');
})->name('website');

Route::get('/aboutus', function() {
    return "About us";
})->name('aboutus');

Route::get('/contactus', function() {
    return "Contact us";
})->name('contactus');

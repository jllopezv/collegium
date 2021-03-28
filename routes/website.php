<?php

use Illuminate\Support\Facades\Route;


Route::get('/aboutus', function() {
    return "About us";
})->name('aboutus');

Route::get('/contactus', function() {
    return "Contact us";
})->name('contactus');

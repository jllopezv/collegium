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


Route::get('/showpost/{id}', function($id) {
    return view('website.html.showpost', ['id' => $id ]);
})->name('website.showpost');

Route::get('/showadvertisement/{id}', function($id) {
    return view('website.html.showadvertisement', ['id' => $id ]);
})->name('website.showadvertisement');

Route::get('/shownews/{id}', function($id) {
    return view('website.html.shownews', ['id' => $id ]);
})->name('website.shownews');

<?php

use Illuminate\Support\Facades\Route;

Route::get('/aboutus', function() {
    return "About us";
})->name('aboutus');

Route::get('/contactus', function() {
    return "Contact us";
})->name('contactus');

Route::get('/websiteshowpage/{id}', function($id) {
    return view('website.html.showpage', ['id' => $id ]);
})->name('website.showpage');

Route::get('/websiteshowpost/{id}', function($id) {
    return view('website.html.showpost', ['id' => $id ]);
})->name('website.showpost');

Route::get('/websiteshowadvertisement/{id}', function($id) {
    return view('website.html.showadvertisement', ['id' => $id ]);
})->name('website.showadvertisement');

Route::get('/websiteshownews/{id}', function($id) {
    return view('website.html.shownews', ['id' => $id ]);
})->name('website.shownews');

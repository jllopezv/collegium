<?php

use Illuminate\Support\Facades\Route;

Route::get('/aboutus', function() {
    return "About us";
})->name('website.aboutus');

Route::get('/contact', function() {
    return view('website.contact');
})->name('website.contact');

Route::get('/contactus', function() {
    return view('website.contactus');
})->name('website.contactus');

Route::get('/contactussended', function() {
    return view('website.contactussended');
})->name('website.contactus.sended');

Route::get('/websiteshowpage/{id}', function($id) {
    return view('website.html.showpage', ['id' => $id ]);
})->name('website.showpage');

Route::get('/websiteshowpost/{id}', function($id) {
    return view('website.html.showpost', ['id' => $id ]);
})->name('website.showpost');

Route::get('/websiteshowadvertisement/{id}', function($id) {
    return view('website.html.showadvertisement', ['id' => $id ]);
})->name('website.showadvertisement');

Route::get('/websiteshowsection/{id}', function($id) {
    return view('website.html.showsection', ['id' => $id ]);
})->name('website.showsection');

Route::get('/websiteshownews/{id}', function($id) {
    return view('website.html.shownews', ['id' => $id ]);
})->name('website.shownews');

<?php

use App\Http\Controllers\ContactController;


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/', function () {
    return view('business-over-tea');
});
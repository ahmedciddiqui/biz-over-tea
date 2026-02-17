<?php

use App\Http\Livewire\Admin\InvestorsRequest;
use App\Http\Livewire\Admin\Settings\Notification;
use App\Http\Livewire\Admin\Venture\Investors;
use App\Http\Livewire\Admin\VenturesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/', function () {
    return view('business-over-tea');
});

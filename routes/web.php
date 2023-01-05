<?php

use Illuminate\Support\Facades\Route;

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

Route::get('{any}', function () {
    return view('layouts.app');
})->where('any', '.*');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return "Cache and Config is cleared";
});


// SAMPLE TEST
Route::get('/sample', 'ShopController@test');

//CHECK SESSION FUNCTION
Route::get('/check/stocks', function () {
    dd(session('stocklists'));
});

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['api'])->group(function() {
    Route::post('/verify',      'LoginController@verify');
    Route::any('/book/search',  'BookController@search');
    Route::post('/book/store',  'BookController@store');
});

Route::middleware(['api', 'auth.bearer'])->group(function() {
    Route::get('/me', 'LoginController@showUser');
});

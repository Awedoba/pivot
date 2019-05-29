<?php

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


// all route that are for guest users should go into the middleware guest group
Route::middleware(['guest'])->group(function () {
    // login route, to return login view  and to accept login post request
    Route::match(['get', 'post'], '/', ['uses' => 'LoginController@login', 'as' => 'login']);
});
// all route that are for logged in users should go into the middleware auth group
Route::middleware(['auth'])->group(function () {
    Route::get('/home', ['uses' => 'DashboardController@dashboard', 'as' => 'home']);
    Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'logout']);
});
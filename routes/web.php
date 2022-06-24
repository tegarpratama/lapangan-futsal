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

// Login
Route::group(['prefix' => 'login', 'as' => 'login.', 'middleware' => 'guest'], function () {
    Route::get('/', 'LoginController@showLogin')
        ->name('index');
    Route::post('/', 'LoginController@postLogin')
        ->name('post');
});
// Route::get('/', 'LoginController@showLogin')
//         ->name('login');

// Register
Route::group(['prefix' => 'register/', 'as' => 'register.', 'middleware' => 'guest'],function () {
    Route::get('/', 'RegisterController@index')
        ->name('index');
    Route::post('/', 'RegisterController@register')
        ->name('post');
});


// Logout
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::group(['prefix' => '/', 'as' => 'user.', 'middleware' => 'auth:user'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/location', 'HomeController@store')->name('location');
    Route::get('/nearby', 'HomeController@nearby')->name('nearby');
});

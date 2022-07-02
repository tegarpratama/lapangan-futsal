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

// Register
Route::group(['prefix' => 'register', 'as' => 'register.', 'middleware' => 'guest'],function () {
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
    Route::post('/calculate', 'HomeController@calculate')->name('calculate');
    Route::get('/hasil', 'HomeController@hasil')->name('hasil');
    Route::get('/{id}/detail', 'HomeController@detail')->name('detail');
});

Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => 'auth:admin'],function () {
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
    Route::resource('futsal', 'Admin\FutsalController');
    Route::resource('admin', 'Admin\AdminController');
    Route::resource('pengguna', 'Admin\PenggunaController');
    Route::resource('profile', 'Admin\ProfileController');
});

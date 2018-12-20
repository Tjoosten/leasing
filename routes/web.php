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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Administrator routes
Route::get('admins', 'Users\AdminController@index')->name('admins.index');

// Account settings routes 
Route::get('/account-settings', 'Users\SettingsController@index')->name('account.settings');
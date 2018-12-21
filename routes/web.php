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
Route::match(['get', 'delete'], 'admins/delete/{admin}', 'Users\AdminController@destroy')->name('admins.destroy');
Route::get('admins/delete/{admin}/undo', 'Users\AdminController@undoDeleteRoute')->name('admins.delete.undo');
// Account settings routes 
Route::get('/account-settings', 'Users\SettingsController@index')->name('account.settings');
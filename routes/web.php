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

Auth::routes();
Route::get('/', 'ItemController@index')->name('items');

Route::resource('items', 'ItemController');
Route::resource('types', 'TypeController');
Route::resource('vendors', 'VendorController');
Route::resource('users', 'UserController');

Route::post('users/change_user_role', 'UserController@change_user_role')->name('users.change_user_role');
Route::post('users/change_user_active', 'UserController@change_user_active')->name('users.change_user_active');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
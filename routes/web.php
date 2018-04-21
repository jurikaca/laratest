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


Route::get('/items', 'ItemController@index')->name('items');
Route::get('/types', 'TypeController@index')->name('types');
Route::get('/vendors', 'VendorController@index')->name('vendors');
Route::get('/users', 'UserController@index')->name('users.index');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
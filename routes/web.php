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

Route::get('/','HomeController@dashboard');
Route::get('/login','LoginController@index');
Route::get('/dashboard','HomeController@dashboard');

//Routes for Excel Exporting
Route::get('service/export','ServiceController@export');
Route::get('purchases/export','PurchasesController@export');
Route::get('sales/export','SalesController@export');
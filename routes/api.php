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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Role APIs
Route::get('role', 'RoleController@read');
Route::post('role', 'RoleController@add');
Route::post('role/update', 'RoleController@update');
Route::delete('role/{id}', 'RoleController@delete');

//Technician APIs
Route::get('technician', 'TechnicianController@read');
Route::post('technician', 'TechnicianController@add');
Route::post('technician/update', 'TechnicianController@update');
Route::delete('technician/{id}', 'TechnicianController@delete');

//Supplier APIs
Route::get('supplier', 'SupplierController@read');
Route::post('supplier', 'SupplierController@add');
Route::post('supplier/update', 'SupplierController@update');
Route::delete('supplier/{id}', 'SupplierController@delete');

//Spare Part Category APIs
Route::get('spcategory', 'SparePartCategoryController@read');
Route::post('spcategory', 'SparePartCategoryController@add');
Route::post('spcategory/update', 'SparePartCategoryController@update');
Route::delete('spcategory/{id}', 'SparePartCategoryController@delete');

//Spare Part APIs including Purchase APIs
Route::get('spart', 'SparePartController@read');
Route::post('spart/update', 'SparePartController@update');
Route::delete('spart/{id}', 'SparePartController@delete');
Route::get('purchases', 'PurchasesController@read');
Route::post('purchases', 'PurchasesController@add');

//Service Job APIs
Route::get('sjob', 'ServiceJobController@read');
Route::post('sjob', 'ServiceJobController@add');
Route::post('sjob/update', 'ServiceJobController@update');
Route::delete('sjob/{id}', 'ServiceJobController@delete');

//Service Category APIs
Route::get('scat', 'ServiceCategoryController@read');
Route::post('scat', 'ServiceCategoryController@add');
Route::post('scat/update', 'ServiceCategoryController@update');
Route::delete('scat/{id}', 'ServiceCategoryController@delete');

//Service APIs
Route::get('service', 'ServiceController@read');
Route::get('service/{id}', 'ServiceDetailController@read');
Route::get('servicesjob/{id}', 'ServiceSjobController@readservicejob');
Route::get('servicespart/{id}', 'ServiceSpartController@readservicespart');
Route::post('service', 'ServiceDetailController@add');
Route::post('service/finish', 'ServiceDetailController@finish');
Route::post('servicespart', 'ServiceDetailController@upSpart');
Route::post('servicesjob', 'ServiceDetailController@upSjob');

//Customer APIs
Route::get('customer', 'CustomerController@read');
Route::post('customer', 'CustomerController@add');
Route::post('customer/update', 'CustomerController@update');
Route::delete('customer/{id}', 'CustomerController@delete');

//Sales APIs
Route::get('sales', 'SalesController@read');
Route::post('sales/getspart', 'SalesController@getspart');
Route::post('sales', 'SalesController@add');

//User APIs
Route::post('register', 'LoginController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');
Route::get('users', 'UserController@read');
Route::delete('users/{id}', 'UserController@delete');

//Example APIs
Route::get('cekdata', 'HomeController@cekData');
Route::get('auth','HomeController@dataAuth');
Route::get('user', 'LoginController@getAuthenticatedUser');

//DEBUGGING APIs

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
Route::get('role', 'RoleController@read')->middleware('jwt.verify');
Route::post('role', 'RoleController@add')->middleware('jwt.verify');
Route::post('role/update', 'RoleController@update')->middleware('jwt.verify');
Route::delete('role/{id}', 'RoleController@delete')->middleware('jwt.verify');

//Technician APIs
Route::get('technician', 'TechnicianController@read')->middleware('jwt.verify');
Route::get('technicianauth', 'TechnicianController@readAuth')->middleware('jwt.verify');
Route::post('technician', 'TechnicianController@add')->middleware('jwt.verify');
Route::post('technician/update', 'TechnicianController@update')->middleware('jwt.verify');
Route::delete('technician/{id}', 'TechnicianController@delete')->middleware('jwt.verify');

//Supplier APIs
Route::get('supplier', 'SupplierController@read')->middleware('jwt.verify');
Route::post('supplier', 'SupplierController@add')->middleware('jwt.verify');
Route::post('supplier/update', 'SupplierController@update')->middleware('jwt.verify');
Route::delete('supplier/{id}', 'SupplierController@delete')->middleware('jwt.verify');

//Spare Part Category APIs
Route::get('spcategory', 'SparePartCategoryController@read')->middleware('jwt.verify');
Route::post('spcategory', 'SparePartCategoryController@add')->middleware('jwt.verify');
Route::post('spcategory/update', 'SparePartCategoryController@update')->middleware('jwt.verify');
Route::delete('spcategory/{id}', 'SparePartCategoryController@delete')->middleware('jwt.verify');

//Spare Part APIs including Purchase APIs
Route::get('spart', 'SparePartController@read')->middleware('jwt.verify');
Route::post('spart/update', 'SparePartController@update')->middleware('jwt.verify');
Route::delete('spart/{id}', 'SparePartController@delete')->middleware('jwt.verify');
Route::get('spart/brand', 'SparePartController@brand')->middleware('jwt.verify');
Route::get('purchases', 'PurchasesController@read')->middleware('jwt.verify');
Route::post('purchases', 'PurchasesController@add')->middleware('jwt.verify');

//Service Job APIs
Route::get('sjob', 'ServiceJobController@read')->middleware('jwt.verify');
Route::post('sjob', 'ServiceJobController@add')->middleware('jwt.verify');
Route::post('sjob/update', 'ServiceJobController@update')->middleware('jwt.verify');
Route::delete('sjob/{id}', 'ServiceJobController@delete')->middleware('jwt.verify');

//Service Category APIs
Route::get('scat', 'ServiceCategoryController@read')->middleware('jwt.verify');
Route::post('scat', 'ServiceCategoryController@add')->middleware('jwt.verify');
Route::post('scat/update', 'ServiceCategoryController@update')->middleware('jwt.verify');
Route::delete('scat/{id}', 'ServiceCategoryController@delete')->middleware('jwt.verify');

//Service APIs
Route::get('service', 'ServiceController@read')->middleware('jwt.verify');
Route::get('service/{id}', 'ServiceDetailController@read')->middleware('jwt.verify');
Route::get('servicesjob/{id}', 'ServiceSjobController@readservicejob')->middleware('jwt.verify');
Route::get('servicespart/{id}', 'ServiceSpartController@readservicespart')->middleware('jwt.verify');
Route::post('service', 'ServiceDetailController@add')->middleware('jwt.verify');
Route::post('service/finish', 'ServiceDetailController@finish')->middleware('jwt.verify');
Route::post('servicespart', 'ServiceDetailController@upSpart')->middleware('jwt.verify');
Route::post('servicesjob', 'ServiceDetailController@upSjob')->middleware('jwt.verify');
Route::get('servicehistory', 'ServiceController@readhistory')->middleware('jwt.verify');
Route::post('servicesjob/delete', 'ServiceDetailController@delSjob')->middleware('jwt.verify');
Route::post('servicespart/delete', 'ServiceDetailController@delSpart')->middleware('jwt.verify');

//Customer APIs
Route::get('customer', 'CustomerController@read')->middleware('jwt.verify');
Route::post('customer', 'CustomerController@add')->middleware('jwt.verify');
Route::post('customer/update', 'CustomerController@update')->middleware('jwt.verify');
Route::delete('customer/{id}', 'CustomerController@delete')->middleware('jwt.verify');

//Sales APIs
Route::get('sales', 'SalesController@read')->middleware('jwt.verify');
Route::get('salesd', 'SalesController@read_details')->middleware('jwt.verify');
Route::post('sales/getspart', 'SalesController@getspart')->middleware('jwt.verify');
Route::post('sales', 'SalesController@add')->middleware('jwt.verify');

//User APIs
Route::post('register', 'LoginController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');
Route::get('users', 'UserController@read')->middleware('jwt.verify');
Route::delete('users/{id}', 'UserController@delete')->middleware('jwt.verify');

//Example APIs
Route::get('cekdata', 'HomeController@cekData');
Route::get('auth','HomeController@dataAuth');
Route::get('user', 'LoginController@getAuthenticatedUser');

//DEBUGGING APIs

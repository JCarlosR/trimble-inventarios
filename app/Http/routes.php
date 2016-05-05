<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'HomeController@index');


// Ingresos
Route::get('/ingreso/listar/retorno', 'EntryController@getListaRetorno');
Route::get('/ingreso/retorno', 'EntryController@getRetorno');
Route::get('/ingreso/listar/compra', 'EntryController@getListaCompra');
Route::get('/ingreso/compra', 'EntryController@getCompra');
Route::get('/ingreso/listar/reutilizacion', 'EntryController@getListaReutilizacion');
Route::get('/ingreso/reutilizacion', 'EntryController@getReutilizacion');

// Salidas
Route::get('/salida/venta', 'OutputController@getVenta');
Route::get('/salida/listar/venta', 'OutputController@getListaVenta');
Route::get('/salida/alquiler', 'OutputController@getAlquiler');
Route::get('/salida/listar/alquiler', 'OutputController@getListaAlquiler');
Route::get('/salida/baja', 'OutputController@getBaja');
Route::get('/salida/listar/baja', 'OutputController@getListaBaja');


// Customers
Route::get('/clientes', 'CustomerController@index');
Route::get('/clientes/registrar', 'CustomerController@create');
Route::post('/clientes/registrar', 'CustomerController@store');
// Customer types
Route::get('/clientes/tipos', 'CustomerTypeController@create');

// Providers


// Products
Route::get('/product/category/index', 'CategoryController@index');
Route::get('/product/category/create', 'CategoryController@create');
Route::get('/product/subcategory/index', 'SubcategoryController@index');
Route::get('/product/subcategory/create', 'SubcategoryController@create');
Route::get('/product/brand/index', 'BrandController@index');
Route::get('/product/brand/create', 'BrandController@create');
Route::get('/product/model/index', 'ModelController@index');
Route::get('/product/model/create', 'ModelController@create');
Route::get('/product/product/index', 'ProductController@index');
Route::get('/product/product/create', 'ProductController@create');
Route::get('/package/index', 'PackageController@index');
Route::get('/package/create', 'PackageController@create');

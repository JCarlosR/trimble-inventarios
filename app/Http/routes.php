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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


//Ingresos a almacen
Route::get('/ingreso/retorno', 'EntryController@getRetorno');
Route::get('/ingreso/compra', 'EntryController@getCompra');
Route::get('/ingreso/reutilizacion', 'EntryController@getReutilizacion');

//Salidas de almacen
Route::get('/salida/venta', 'OutputController@getVenta');
Route::get('/salida/alquiler', 'OutputController@getAlquiler');
Route::get('/salida/baja', 'OutputController@getBaja');

// Customers
Route::get('/clientes', 'CustomerController@index');
Route::get('/clientes/registrar', 'CustomerController@create');
Route::post('/clientes/registrar', 'CustomerController@store');
// Customer types
Route::get('/clientes/tipos', 'CustomerTypeController@create');

// Providers


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
Route::get('/salida/alquiler', 'OutputController@getAlquiler');
Route::get('/salida/baja', 'OutputController@getBaja');


// Customers
Route::get('/clientes', 'CustomerController@index');
Route::get('/clientes/registrar', 'CustomerController@create');
Route::post('/clientes/registrar', 'CustomerController@store');
// Customer types
Route::get('/clientes/tipos', 'CustomerTypeController@create');

// Providers


// Products
Route::get('/productos/categorias', 'ProductController@categorias');
Route::get('/productos/subcategorias', 'ProductController@subcategorias');
Route::get('/productos/marcas', 'ProductController@marcas');
Route::get('/productos/modelos', 'ProductController@modelos');
Route::get('/productos/leerProductos', 'ProductController@leerProductos');
Route::get('/productos/productos', 'ProductController@productos');
Route::get('/productos/leerPaquetes', 'ProductController@leerPaquetes');
Route::get('/productos/paquetes', 'ProductController@paquetes');

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

Route::get('/ingreso/listar/compra', 'EntryController@getCompras');
Route::get('/ingreso/listar/compra/{proveedor}/{inicio}/{fin}', 'EntryController@getComprasFiltro');
Route::get('/ingreso/listar/detalles/{id}', 'EntryController@getCompraDetalles');
Route::get('/ingreso/compra', 'EntryController@getRegistroCompra');

Route::get('/ingreso/listar/reutilizacion', 'EntryController@getReutilizacion');
Route::get('/ingreso/listar/reutilizacion/{inicio}/{fin}', 'EntryController@getReutilizacionFiltro');
Route::get('/ingreso/reutilizacion', 'EntryController@getRegistroReutilizacion');

Route::post('/ingreso/compra', 'EntryController@postRegistroCompra');
Route::post('/ingreso/reutilizacion', 'EntryController@postRegistroReutilizacion');

// Salidas
Route::get('/salida/venta', 'OutputController@getRegistroVenta');
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
Route::get('/categoria', 'CategoryController@index');
Route::get('/categoria/registrar', 'CategoryController@create');
Route::get('/subcategoria', 'SubcategoryController@index');
Route::get('/subcategoria/registrar', 'SubcategoryController@create');
Route::get('/marca', 'BrandController@index');
Route::get('/marca/registrar', 'BrandController@create');
Route::get('/modelo', 'ModelController@index');
Route::get('/modelo/registrar', 'ModelController@create');
Route::get('/producto', 'ProductController@index');
Route::get('/producto/registrar', 'ProductController@create');
Route::get('/paquete', 'PackageController@index');
Route::get('/paquete/registrar', 'PackageController@create');

// Search
Route::get('/producto/buscar/{name}', 'ProductController@search');

Route::get('/items/producto/{id}', 'ItemController@searchItems');

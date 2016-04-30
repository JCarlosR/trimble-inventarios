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

// Customers
Route::get('/clientes', 'CustomerController@index');
Route::get('/clientes/registrar', 'CustomerController@create');
Route::post('/clientes/registrar', 'CustomerController@store');
// Customer types
Route::get('/clientes/tipos', 'CustomerTypeController@create');

// Providers


//Productos
Route::get('/productos/categorias', 'ProductoController@categorias');
Route::get('/productos/subcategorias', 'ProductoController@subcategorias');
Route::get('/productos/marcas', 'ProductoController@marcas');
Route::get('/productos/modelos', 'ProductoController@modelos');
Route::get('/productos/productos', 'ProductoController@productos');
Route::get('/productos/paquetes', 'ProductoController@paquetes');
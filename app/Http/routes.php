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

Route::group(['middleware' => 'auth'], function () {
    // Ingresos
    Route::get('/ingreso/listar/retorno', 'EntryController@getRetornos');
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
    Route::get('/salida/listar/venta', 'OutputController@getVentas');
    Route::get('/salida/listar/venta/{cliente}/{inicio}/{fin}', 'OutputController@getVentasFiltro');
    Route::post('/salida/venta', 'OutputController@postRegistroVenta');
    Route::get('/salida/listar/detalles/{id}', 'OutputController@getVentaDetalles');

    Route::get('/salida/alquiler', 'OutputController@getAlquiler');
    Route::get('/salida/listar/alquiler', 'OutputController@getListaAlquiler');

    Route::get('/salida/baja', 'OutputController@getBaja');
    Route::get('/salida/listar/baja', 'OutputController@getListaBaja');


// Customers
    Route::get('/clientes', 'CustomerController@index');
    Route::get('/clientes/registrar', 'CustomerController@create');
    Route::post('/clientes/registrar', 'CustomerController@store');
    Route::post('/clientes/modificar', 'CustomerController@edit');
    Route::post('/clientes/eliminar', 'CustomerController@delete');
    Route::get('/clientes/eliminados', 'CustomerController@back');
    Route::post('/clientes/restablecer', 'CustomerController@giveBack');

// Customer types
    Route::get('/clientes/tipos', 'CustomerTypeController@create');
    Route::post('/clientes/tipos/modificar', 'CustomerTypeController@edit');
    Route::post('/clientes/tipos/registrar', 'CustomerTypeController@created');
    Route::post('/clientes/tipos/eliminar', 'CustomerTypeController@delete');

// Providers
    Route::get('/proveedores', 'ProviderController@index');
    Route::get('/proveedores/registrar', 'ProviderController@create');
    Route::post('/proveedores/registrar', 'ProviderController@store');
    Route::post('/proveedores/modificar', 'ProviderController@edit');
    Route::post('/proveedores/eliminar', 'ProviderController@delete');
    Route::get('/proveedores/eliminados', 'ProviderController@back');
    Route::post('/proveedores/restablecer', 'ProviderController@giveBack');

// Provider types
    Route::get('/proveedores/tipos', 'ProviderTypeController@create');
    Route::post('/proveedores/tipos/modificar', 'ProviderTypeController@edit');
    Route::post('/proveedores/tipos/registrar', 'ProviderTypeController@created');
    Route::post('/proveedores/tipos/eliminar', 'ProviderTypeController@delete');

    // Products
//Categorías
    Route::get('/categoria', 'CategoryController@index');
    Route::get('/categoria/registrar', 'CategoryController@create');
    Route::post('/categoria/registrar', 'CategoryController@created');
    Route::post('categoria/modificar','CategoryController@edit');
    Route::post('categoria/eliminar','CategoryController@delete');
//Subcategorías
    Route::get('/subcategoria', 'SubcategoryController@index');
    Route::get('/subcategoria/registrar', 'SubcategoryController@create');
    Route::post('/subcategoria/registrar', 'SubcategoryController@created');
    Route::get('subcategoria/dropdown','SubcategoryController@dropdown');
    Route::post('subcategoria/modificar','SubcategoryController@edit');
    Route::post('subcategoria/eliminar','SubcategoryController@delete');
//Marcas
    Route::get('/marca', 'BrandController@index');
    Route::get('/marca/registrar', 'BrandController@create');
    Route::post('/marca/registrar', 'BrandController@created');
    Route::post('marca/modificar','BrandController@edit');
    Route::post('marca/eliminar','BrandController@delete');
//Modelos
    Route::get('/modelo', 'ExemplarController@index');
    Route::get('/modelo/registrar', 'ExemplarController@create');
    Route::post('/modelo/registrar', 'ExemplarController@created');
    Route::get('modelo/dropdown','ExemplarController@dropdown');
    Route::post('modelo/modificar','ExemplarController@edit');
    Route::post('modelo/eliminar','ExemplarController@delete');
//Productos
    Route::get('/producto', 'ProductController@index');
    Route::get('/producto/registrar', 'ProductController@create');
    Route::post('/producto/registrar', 'ProductController@created');
    Route::get('/producto/categoria', 'ProductController@categoria');
    Route::get('/producto/marca', 'ProductController@marca');
    Route::get('producto/subcategoria/{categoria}','ProductController@subcategoria');
    Route::get('producto/modelo/{marca}','ProductController@modelo');
    Route::post('producto/modificar','ProductController@edit');
    Route::post('producto/eliminar','ProductController@delete');
//Paquetes
    Route::get('/paquete', 'PackageController@index');
    Route::get('/paquete/registrar', 'PackageController@create');

// Search
    Route::get('/producto/buscar/{name}', 'ProductController@search');

    Route::get('/items/producto/{id}', 'ItemController@searchItems');

});



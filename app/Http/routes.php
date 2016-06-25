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
    Route::get('/ingreso/listar/compra', 'EntryController@getCompras');
    Route::get('/ingreso/listar/compra/{proveedor}/{inicio}/{fin}', 'EntryController@getComprasFiltro');
    Route::get('/ingreso/listar/detalles/{id}', 'EntryController@getCompraDetalles');
    Route::get('/ingreso/compra', 'EntryController@getRegistroCompra');
    Route::post('/ingreso/compra/anular', 'EntryController@deleteCompra');

    Route::get('/ingreso/listar/reutilizacion', 'EntryController@getReutilizacion');
    Route::get('/ingreso/listar/reutilizacion/{inicio}/{fin}', 'EntryController@getReutilizacionFiltro');
    Route::get('/ingreso/reutilizacion', 'EntryController@getRegistroReutilizacion');
    Route::post('/ingreso/reutilizacion/anular', 'EntryController@delete');

    Route::post('/ingreso/compra', 'EntryController@postRegistroCompra');
    Route::post('/ingreso/reutilizacion', 'EntryController@postRegistroReutilizacion');

// Salidas
    Route::get('/salida/venta', 'OutputController@getRegistroVenta');
    Route::get('/salida/listar/venta', 'OutputController@getVentas');
    Route::get('/salida/listar/venta/{cliente}/{inicio}/{fin}', 'OutputController@getVentasFiltro');
    Route::post('/salida/venta', 'OutputController@postRegistroVenta');
    Route::get('/salida/listar/detalles/{id}', 'OutputController@getVentaDetalles');
    Route::post('/salida/venta/anular', 'OutputController@delete');

    Route::get('/salida/alquiler', 'OutputController@getAlquiler');
    Route::get('/salida/listar/alquiler', 'OutputController@getListaAlquiler');

    Route::get('/salida/baja', 'OutputController@getBaja');
    Route::post('/salida/baja', 'OutputController@postBaja');
    Route::get('productos/disponibles', 'OutputController@getProductosDisponibles');
    Route::get('paquetes/disponibles', 'OutputController@getPaquetesDisponibles');

// Rental
    Route::post('alquiler/registrar', 'RentalController@store');
    Route::get('/alquiler/listar/detalles/{id}', 'RentalController@getRentalDetails');

// Devolution
    Route::get('/ingreso/listar/retorno', 'DevolutionController@index');
    Route::get('/ingreso/listar/retorno/{id}', 'DevolutionController@details');
    Route::post('/ingreso/listar/retorno/{id}', 'DevolutionController@store');
    Route::put('/ingreso/listar/retorno/parcial', 'DevolutionController@partial');

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

// Users
    Route::get('/usuarios', 'UserController@index');
    Route::put('/usuarios/{id}', 'UserController@edit');
    Route::post('/usuarios', 'UserController@store');
    Route::delete('/usuarios', 'UserController@delete');

// Products
    // Categories
    Route::get('/categoria', 'CategoryController@index');
    Route::get('/categoria/registrar', 'CategoryController@create');
    Route::post('/categoria/registrar', 'CategoryController@created');
    Route::post('categoria/modificar','CategoryController@edit');
    Route::post('categoria/eliminar','CategoryController@delete');
    // Subcategories
    Route::get('/subcategoria', 'SubcategoryController@index');
    Route::get('/subcategoria/registrar', 'SubcategoryController@create');
    Route::post('/subcategoria/registrar', 'SubcategoryController@created');
    Route::get('subcategoria/dropdown','SubcategoryController@dropdown');
    Route::post('subcategoria/modificar','SubcategoryController@edit');
    Route::post('subcategoria/eliminar','SubcategoryController@delete');
    // Brands
    Route::get('/marca', 'BrandController@index');
    Route::get('/marca/registrar', 'BrandController@create');
    Route::post('/marca/registrar', 'BrandController@created');
    Route::post('marca/modificar','BrandController@edit');
    Route::post('marca/eliminar','BrandController@delete');
    // Models
    Route::get('/modelo', 'ExemplarController@index');
    Route::get('/modelo/registrar', 'ExemplarController@create');
    Route::post('/modelo/registrar', 'ExemplarController@created');
    Route::get('modelo/dropdown','ExemplarController@dropdown');
    Route::post('modelo/modificar','ExemplarController@edit');
    Route::post('modelo/eliminar','ExemplarController@delete');
    // Products
    Route::get('/producto', 'ProductController@index');
    Route::get('/producto/inactivos', 'ProductController@show_disabled');
    Route::post('/producto/habilitar', 'ProductController@enable');
    Route::get('/producto/registrar', 'ProductController@create');
    Route::post('/producto/registrar', 'ProductController@store');
    Route::get('/producto/categoria', 'ProductController@categoria');
    Route::get('/producto/marca', 'ProductController@marca');
    Route::get('producto/subcategoria/{categoria}','ProductController@subcategoria');
    Route::get('producto/modelo/{marca}','ProductController@modelo');
    Route::post('producto/modificar','ProductController@edit');
    Route::post('producto/eliminar','ProductController@delete');

    // Packages
    Route::get('/paquete', 'PackageController@index');
    Route::get('/paquete/registrar', 'PackageController@create');
    Route::post('/paquete/registrar', 'PackageController@store');
    Route::post('/paquete/modificar', 'PackageController@edit');
    Route::get('/paquete/descomponer/{id}', 'PackageController@destroy');
    Route::get('/paquete/productos', 'PackageController@items');


// Search
    // Search product by name
    Route::get('/producto/buscar/{name}', 'ProductController@search');
    Route::get('/paquete/ubicaciones', 'PackageController@locations');
    Route::get('/paquete/detalles/{id}', 'PackageController@searchDetails');

    Route::get('/productos/names', 'ProductController@searchAll');

    // Search for a specific item
    Route::get('/items/producto/{id}', 'ItemController@searchItems');



// Locations
    // Locals
    Route::get('/local', 'LocalController@index');
    Route::get('/local/registrar', 'LocalController@create');
    Route::post('/local/registrar', 'LocalController@store');
    Route::post('local/modificar','LocalController@edit');
    Route::post('local/eliminar','LocalController@delete');

    // Shelves
    Route::get('/anaquel/{local}', 'ShelfController@index');
    Route::get('/anaquel/registrar/{local}', 'ShelfController@create');
    Route::post('/anaquel/registrar/{local}', 'ShelfController@store');
    Route::post('anaquel/modificar/{local}','ShelfController@edit');
    Route::post('anaquel/eliminar/{local}','ShelfController@delete');

    // Levels
    Route::get('/nivel/{shelf}/{local}', 'LevelController@index');
    Route::get('/nivel/registrar/{shelf}/{local}', 'LevelController@create');
    Route::post('/nivel/registrar/{shelf}/{local}', 'LevelController@store');
    Route::post('nivel/modificar/{shelf}/{local}','LevelController@edit');
    Route::post('nivel/eliminar/{shelf}/{local}','LevelController@delete');

    // Boxes
    Route::get('/caja/{level}/{shelf}/{local}', 'BoxController@index');
    Route::get('/caja/registrar/{level}/{shelf}/{local}', 'BoxController@create');
    Route::post('/caja/registrar/{level}/{shelf}/{local}', 'BoxController@store');
    Route::post('caja/modificar/{level}/{shelf}/{local}','BoxController@edit');
    Route::post('caja/eliminar/{level}/{shelf}/{local}','BoxController@delete');

    // Products contained in a box
    Route::get('ubicacion/{box}/{level}/{shelf}/{local}','BoxController@location');
    
    // Reportes
    Route::get('reporte/existencias', 'ReportController@getItems');

    // WebServices to reports
    Route::get('/locals/shelves/{local}', 'ReportController@shelves');
    Route::get('/shelves/levels/{shelf}', 'ReportController@levels');
    Route::get('/levels/boxes/{level}', 'ReportController@boxes');
    Route::get('/boxes/items/{full_name}', 'ReportController@items');

});

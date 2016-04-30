<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductoController extends Controller
{
    public function categorias()
    {
        return view('productos.categorias');
    }

    public function subcategorias()
    {
        return view('productos.subcategorias');
    }

    public function marcas()
    {
        return view('productos.marcas');
    }

    public function modelos()
    {
        return view('productos.modelos');
    }

    public function productos()
    {
        return view('productos.productos');
    }

    public function paquetes()
    {
        return view('paquetes.paquetes');
    }
}
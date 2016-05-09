<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;

class EntryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getRetorno()
    {
        return view('ingreso.retorno');
    }
    public function getListaRetorno()
    {
        return view('ingreso.listaretorno');
    }

    public function getCompra()
    {
        $productos = Product::all();
        $proveedores = Provider::all();
        return view('ingreso.compra')->with(compact('productos', 'proveedores'));
    }

    public function getListaCompra()
    {

        return view('ingreso.listacompra');
    }

    public function getReutilizacion()
    {
        return view('ingreso.reutilizacion');
    }

    public function getListaReutilizacion()
    {
        return view('ingreso.listareutilizacion');
    }


}

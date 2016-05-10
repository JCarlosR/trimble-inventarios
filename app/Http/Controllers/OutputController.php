<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegistroVenta()
    {
        $productos = Product::select('name')->lists('name')->toJson();
        $clientes = Customer::select('name')->lists('name')->toJson();
        return view('salida.venta')->with(compact('productos', 'clientes'));
    }
    public function getListaVenta()
    {
        return view('salida.listaventa');
    }
    public function getAlquiler()
    {
        return view('salida.alquiler');
    }
    public function getListaAlquiler()
    {
        return view('salida.listaalquiler');
    }
    public function getBaja()
    {
        return view('salida.baja');
    }
    public function getListaBaja()
    {
        return view('salida.listabaja');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
        return view('ingreso.compra');
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

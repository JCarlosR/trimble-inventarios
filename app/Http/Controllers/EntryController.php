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

    public function getCompra()
    {
        return view('ingreso.compra');
    }

    public function getReutilizacion()
    {
        return view('ingreso.reutilizacion');
    }

}

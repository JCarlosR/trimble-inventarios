<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
    public function getVenta()
    {
        return view('salida.venta');
    }
    public function getAlquiler()
    {
        return view('salida.alquiler');
    }
    public function getBaja()
    {
        return view('salida.baja');
    }
}

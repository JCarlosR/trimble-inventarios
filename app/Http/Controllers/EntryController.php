<?php

namespace App\Http\Controllers;

use App\Entry;
use App\EntryDetail;
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

    public function getRegistroCompra()
    {
        $productos = Product::select('name')->lists('name')->toJson();
        $proveedores = Provider::select('name')->lists('name')->toJson();
        return view('ingreso.compra')->with(compact('productos', 'proveedores'));
    }

    public function getCompras()
    {
        $providers = Provider::select('name')->lists('name')->toJson();
        $entries = Entry::all();
        return view('ingreso.listacompra')->with(compact(['entries', 'providers']));
    }

    public function getComprasFiltro($proveedor, $inicio, $fin)
    {
        $providers = Provider::select('name')->lists('name')->toJson();
        $provider = Provider::where('name', $proveedor)->first();
        if (!$provider)
            return back();
        $id = $provider->id;
        $entries = Entry::where('provider_id', $id)->get();
         return view('ingreso.listacompra')->with(compact(['entries', 'providers']));
    }

    public function getCompraDetalles($id)
    {
        $details = EntryDetail::where('entry_id',$id)->get(['product_id', 'series', 'quantity', 'price']);

        $array = $details->toArray();
        foreach($array as $k => $detail) {
            $array[$k]['name'] = Product::find($detail['product_id'])->name;
        }

        return $array;
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

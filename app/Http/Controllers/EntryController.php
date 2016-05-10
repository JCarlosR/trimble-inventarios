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
        $entries = Entry::whereNotNull('provider_id')->get();
        return view('ingreso.listacompra')->with(compact(['entries', 'providers']));
    }

    public function getComprasFiltro($proveedor, $inicio, $fin)
    {
        $providers = Provider::select('name')->lists('name')->toJson();
        $provider = Provider::where('name', $proveedor)->first();
        if (!$provider)
            return back();
        $id = $provider->id;
        $entries = Entry::where('provider_id', $id)->whereBetween('created_at', [$inicio, $fin])->get();
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

    public function getRegistroReutilizacion()
    {
        $productos = Product::select('name')->lists('name')->toJson();
        return view('ingreso.reutilizacion')->with(compact('productos'));
    }

    public function getReutilizacion()
    {
        $entries = Entry::whereNull('provider_id')->get();
        return view('ingreso.listareutilizacion')->with(compact(['entries']));
    }

    public function getReutilizacionFiltro($inicio, $fin)
    {
        $entries = Entry::whereNull('provider_id')->whereBetween('created_at', [$inicio, $fin])->get();
        return view('ingreso.listareutilizacion')->with(compact(['entries']));
    }


}

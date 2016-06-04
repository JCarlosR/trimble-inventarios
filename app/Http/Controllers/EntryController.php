<?php

namespace App\Http\Controllers;

use App\Entry;
use App\EntryDetail;
use App\Http\Requests;
use App\Item;
use App\Output;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EntryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getRetornos()
    {
        $clientes = Provider::select('name')->lists('name')->toJson();
        //$outputs = Output::
        return view('ingreso.retorno')->with(compact(['entries', 'clientes', 'datefin', 'dateinicio']));;
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
        $entries = Entry::whereNotNull('provider_id')->where('active', true)->get();
        $carbon = new Carbon();
        $datefin = $carbon->now();
        $dateinicio = $carbon->now()->subDays(7);
        $datefin = $datefin->format('Y-m-d');
        $dateinicio = $dateinicio->format('Y-m-d');
       // dd($datefin);
        return view('ingreso.listacompra')->with(compact(['entries', 'providers', 'datefin', 'dateinicio']));
    }

    public function getComprasFiltro($proveedor, $inicio, $fin)
    {
        $providers = Provider::select('name')->lists('name')->toJson();
        $provider = Provider::where('name', $proveedor)->first();
        if (!$provider)
            return back();
        $id = $provider->id;
        $entries = Entry::where('provider_id', $id)->whereBetween('created_at', [$inicio, $fin])->get();
        $datefin = $fin;
        $dateinicio = $inicio;
        return view('ingreso.listacompra')->with(compact(['entries', 'providers', 'dateinicio', 'datefin']));
    }

    public function getCompraDetalles($id)
    {
        $details = EntryDetail::where('entry_id',$id)->get();
        return $details;
    }

    public function getRegistroReutilizacion()
    {
        $productos = Product::select('name')->lists('name')->toJson();
        return view('ingreso.reutilizacion')->with(compact('productos'));
    }

    public function getReutilizacion()
    {
        $entries = Entry::whereNull('provider_id')->where('active', true)->get();
        $carbon = new Carbon();
        $datefin = $carbon->now();
        $dateinicio = $carbon->now()->subDays(7);
        $datefin = $datefin->format('Y-m-d');
        $dateinicio = $dateinicio->format('Y-m-d');
        return view('ingreso.listareutilizacion')->with(compact(['entries', 'datefin', 'dateinicio']));
    }

    public function getReutilizacionFiltro($inicio, $fin)
    {
        $entries = Entry::whereNull('provider_id')->whereBetween('created_at', [$inicio, $fin])->paginate(3);
        $datefin = $fin;
        $dateinicio = $inicio;
        return view('ingreso.listareutilizacion')->with(compact(['entries', 'dateinicio', 'datefin']));
    }


    public function postRegistroReutilizacion(Request $request)
    {
        $items = json_decode($request->get('items'));

        $destino = $request->get('destino');
        $observacion = $request->get('observacion');

        if (sizeof($items) == 0)
        {
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar detalles para la compra.']);
        }

        // Create Entry Header

        $entry = Entry::create([
            'provider_id' => null,
            'destination' => $destino,
            'comment' => $observacion
        ]);


        foreach($items as $item)
        {
            // Create Entry Details
            EntryDetail::create([
                'entry_id' => $entry->id,
                'product_id' => $item->id,
                'series' => $item->series,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);

            // Create Items
            for ($i = 0; $i<$item->quantity; ++$i)
                Item::create([
                    'product_id' => $item->id,
                    'series' => $item->series,
                    'state' => 'available',
                    'package_id' => null
                ]);
        }

        // Update Stock product

        return response()->json(['error' => false]);
    }

    public function postRegistroCompra(Request $request)
    {
        //dd($items->all());
        $items = json_decode($request->get('items'));

        $proveedor = $request->get('proveedor');
        $tipo = $request->get('tipo');
        $observacion = $request->get('observacion');

        $provider = Provider::where('name', $proveedor)->first();

        if(!$provider)
        {
            return response()->json(['error' => true, 'message' => 'Proveedor indicado no existe.']);
        }

        if (sizeof($items) == 0)
        {
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar detalles para la compra.']);
        }

        // Create Entry Header

        $providerId = $provider->id;
        $entry = Entry::create([
            'provider_id' => $providerId,
            'type' => $tipo,
            'comment' => $observacion
        ]);


        foreach($items as $item)
        {
            // Create Entry Details
            EntryDetail::create([
                'entry_id' => $entry->id,
                'product_id' => $item->id,
                'series' => $item->series,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);

            // Create Items
            for ($i = 0; $i<$item->quantity; ++$i)
                Item::create([
                    'product_id' => $item->id,
                    'series' => ($item->series == 'S/S'? null:$item->series),
                    'state' => 'available',
                    'package_id' => null
                ]);
        }

        // Update Stock product

        return response()->json(['error' => false]);

    }

    public function delete( Request $request )
    {
        // Make validator using rules and custom messages
        $validator = Validator::make($request->all(), [
            'id' => 'exists:entries,id'
        ],[
            'id.exists' => 'La reutilización no puede ser eliminada porque no existe.'
        ]);

        // Get the target entry
        $entry = Entry::find($request->get('id'));

        // Are all the details still available?
        $allAvailable = true;
        foreach($entry->details as $detail)
        {
            $item = Item::where('series', $detail->series)->first();
            if ($item->state != 'available')
            {
                $allAvailable = false;
                break;
            }
        }

        // If not, add an error
        $validator->after(function($validator) use ($allAvailable) {
            if ($allAvailable == false) {
                $validator->errors()->add('available', 'Es imposible anular la operación porque generaría inconsistencias en el sistema.');
            }
        });

        // Return errors if it fails
        if ($validator->fails())
        {
            $data['errors'] = $validator->errors();

            return back()
                ->withInput($request->all())
                ->with($data);
        }

        // It's OK. Let's update and undo the operation
        $entry->active = false;
        $entry->save();
        foreach($entry->details as $detail)
        {
            $item = Item::where('series', $detail->series)->first();
            $item->state = 'annulled';
            $item->save();
        }

        return back();
    }

    public function deleteCompra( Request $request )
    {
        // Make validator using rules and custom messages
        $validator = Validator::make($request->all(), [
            'id' => 'exists:entries,id'
        ],[
            'id.exists' => 'La compra no puede ser eliminada porque no existe.'
        ]);

        // Get the target entry
        $entry = Entry::find($request->get('id'));

        // Are all the details still available?
        $allAvailable = true;
        foreach($entry->details as $detail)
        {
            $item = Item::where('series', $detail->series)->first();
            if ($item->state != 'available')
            {
                $allAvailable = false;
                break;
            }
        }

        // If not, add an error
        $validator->after(function($validator) use ($allAvailable) {
            if ($allAvailable == false) {
                $validator->errors()->add('available', 'Es imposible anular la operación porque generaría inconsistencias en el sistema.');
            }
        });

        // Return errors if it fails
        if ($validator->fails())
        {
            $data['errors'] = $validator->errors();

            return back()
                ->withInput($request->all())
                ->with($data);
        }

        // It's OK. Let's update and undo the operation
        $entry->active = false;
        $entry->save();
        foreach($entry->details as $detail)
        {
            $item = Item::where('series', $detail->series)->first();
            $item->state = 'annulled';
            $item->save();
        }

        return back();
    }

}

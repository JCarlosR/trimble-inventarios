<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use App\Item;
use App\Output;
use App\Package;
use App\Product;
use App\OutputDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OutputController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getRegistroVenta()
    {
        $productos = Product::select('name')->lists('name')->toJson();
        $clientes = Customer::select('name')->lists('name')->toJson();
        return view('salida.venta')->with(compact('productos', 'clientes'));
    }

    public function postRegistroVenta(Request $request)
    {
        $items = json_decode($request->get('items'));

        $cliente = $request->get('cliente');
        $type = $request->get('type');
        $observacion = $request->get('observacion');

        $customer = Customer::where('name', $cliente)->first();

        if(!$customer)
        {
            return response()->json(['error' => true, 'message' => 'Cliente indicado no existe.']);
        }

        if (sizeof($items) == 0)
        {
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar detalles para la venta.']);
        }

        DB::beginTransaction();

        try {
            // Create Output Header
            $customerId = $customer->id;
            $output = Output::create([
                'customer_id' => $customerId,
                'type' => $type,
                'reason' => 'sale',
                'comment' => $observacion
            ]);

            foreach($items as $item)
            {
                // Update Items
                // Si tiene serie lo buscamos y actualizamos(crear un ouputDetail)
                // Sino tomamos los primeros dependiendo cantidad y lo actualizamos(crear los outputDetails correspondiente)


                $realItem = Item::where('product_id', $item->id)->where('state', 'available')->where('series', $item->series)->first();

                if(!$realItem)
                    throw new \Exception('No se ha encontrado el item con serie ' . $item->series);
                $realItem->state = 'sold';

                $realItem->save();

                // Create one Output Detail
                OutputDetail::create([
                    'output_id' => $output->id,
                    'item_id' => $realItem->id,
                    'price' => $item->price
                ]);

            }

            DB::commit();
            return response()->json(['error' => false]);
            // all good
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function getVentas()
    {
        $customers = Customer::select('name')->lists('name')->toJson();
        $outputs = Output::where('reason', 'sale')->where('active', true)->paginate(3);

        $carbon = new Carbon();
        $datefin = $carbon->now();
        $dateinicio = $carbon->now()->subDays(7);
        $datefin = $datefin->format('Y-m-d');
        $dateinicio = $dateinicio->format('Y-m-d');

        return view('salida.listaventa')->with(compact(['customers', 'outputs', 'datefin', 'dateinicio']));
    }

    public function getVentaDetalles($id)
    {
        $details = OutputDetail::where('output_id',$id)->get(['item_id', 'price']);
        $array = $details->toArray();
        //dd($array);
        foreach($array as $k => $detail) {
            $productoID = Item::find($detail['item_id'])->product_id;
            $array[$k]['product_id'] = $productoID;
            $array[$k]['quantity'] = Item::find($detail['item_id'])->quantity;
            $array[$k]['series'] = Item::find($detail['item_id'])->series;
            $array[$k]['name'] = Product::find($productoID)->name;
        }

        //dd($array);

        return $array;
    }

    public function getVentasFiltro($cliente, $inicio, $fin)
    {
        $customers = Customer::select('name')->lists('name')->toJson();
        $customer = Customer::where('name', $cliente)->first();
        $datefin = $fin;
        $dateinicio = $inicio;
        if (!$customer)
            return back();
        $id = $customer->id;
        $outputs = Output::where('customer_id', $id)->whereBetween('created_at', [$inicio, $fin])->paginate(3);
        return view('salida.listaventa')->with(compact(['outputs', 'customers', 'datefin', 'dateinicio']));
    }

    public function getAlquiler()
    {
        $carbon = new Carbon();
        $date = $carbon->now();
        $currentDate = $date->format('Y-m-d');
        $clientes = Customer::where('enable', 1)->select('name')->lists('name')->toJson();
        //dd($clientes);
        return view('salida.alquiler')->with(compact(['clientes', 'currentDate']));
    }
    public function getListaAlquiler()
    {
        return view('salida.listaalquiler');
    }
    public function getBaja()
    {
        $carbon = new Carbon();
        $date = $carbon->now();
        $currentDate = $date->format('Y-m-d');
        return view('salida.baja')->with(compact('currentDate'));
    }

    public function postBaja( Request $request)
    {
        $code = $request->get('codigoDarBaja');
        $type = $request->get('tipo');
        if ($type == 'Product')
        {
            $product = Item::where('series', $code)->first();
            if(!$product)
                return redirect('salida/baja')->with('error', 'No existe un producto con la serie '.$code);
            $product->state = 'low';
            $product->save();
        }else {
            $package = Package::where('code', $code)->first();
            if(! $package)
                return redirect('salida/baja')->with('error', 'No existe un paquete con la serie '.$code);
            $package->state = 'low';
            $details = $package->details;
            $package->save();

            foreach ($details as $detail)
            {
                $detail->state = 'low';
                $detail->save();
            }
        }
                    
        return redirect('salida/baja');
    }

    public function getListaBaja()
    {
        return view('salida.listabaja');
    }

    public function getProductosDisponibles()
    {
        
        $products = Item::where('state', 'available')->whereNotNull('series')->whereNull('package_id')->lists('series');
        $data['products'] = $products;
        return $data;
    }

    public function getPaquetesDisponibles()
    {
        $packages = Package::where('state', 'available')->lists('code');
        $data['packages'] = $packages;
        return $data;
    }

    public function delete( Request $request )
    {
        // Make validator using rules and custom messages
        $validator = Validator::make($request->all(), [
            'id' => 'exists:outputs,id'
        ],[
            'id.exists' => 'La venta no puede ser eliminada porque no existe.'
        ]);

        // Get the target entry
        $output = Output::find($request->get('id'));

        // Are all the details still available?
        $allSold = true;
        foreach($output->details as $detail)
        {
            $item = $detail->item;
            if ($item->state != 'sold')
            {
                $allSold = false;
                break;
            }
        }

        // If not, add an error
        $validator->after(function($validator) use ($allSold) {
            if ($allSold == false) {
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
        $output->active = false;
        $output->save();
        foreach($output->details as $detail)
        {
            $item = $detail->item;
            $item->state = 'available';
            $item->save();
        }

        return back();
    }
}

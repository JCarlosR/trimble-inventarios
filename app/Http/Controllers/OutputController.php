<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use App\Item;
use App\Output;
use App\Product;
use App\OutputDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutputController extends Controller
{

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

    public function postRegistroVenta(Request $request)
    {
        //dd($request->all());
        $items = json_decode($request->get('items'));

        $cliente = $request->get('cliente');
        $tipo = $request->get('tipo');
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
                'type' => $tipo,
                'comment' => $observacion
            ]);

            foreach($items as $item)
            {
                // Update Items
                // Si tiene serie lo buscamos y actualizamos(crear un ouputDetail)
                // Sino tomamos los primeros dependiendo cantidad y lo actualizamos(crear los outputDetails correspondiente)


                if ($item->series != 'S/S') {
                    // Find the specific item
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

                    // Update stock product
                } else {

                    // Primeros items que han coincidido con el producto indicado
                    $firstItems = Item::where('product_id', $item->id)->where('state', 'available')->where('package_id', null)->take($item->quantity)->get();

                    if($firstItems->count() < $item->quantity) {
                        $productName = Product::find($item->id)->name;
                        throw new \Exception('No se cuenta con stock suficiente para el producto '. $productName);
                    }

                    // Enough stock
                    foreach($firstItems as $selectedItem) {
                        $selectedItem->state = 'sold';
                        $selectedItem->save();

                        // Create one Output Detail per item
                        OutputDetail::create([
                            'output_id' => $output->id,
                            'item_id' => $selectedItem->id,
                            'price' => $item->price
                        ]);
                    }

                    // Update stock
                }
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
        $outputs = Output::whereNotNull('customer_id')->paginate(3);
        //dd($outputs);
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

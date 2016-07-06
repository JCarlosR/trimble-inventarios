<?php

namespace App\Http\Controllers;

use App\Box;
use App\Customer;
use App\Entry;
use App\Http\Requests;
use App\Item;
use App\Output;
use App\OutputPackage;
use App\OutputPackageDetail;
use App\Package;
use App\Product;
use App\OutputDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
        //dd($request->all());

        $cliente = $request->get('cliente');
        $type = $request->get('tipo');
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
                if($item->type=='prod')
                {
                    $realItem = Item::where('product_id', $item->id)->where('state', 'available')->where('series', $item->series)->first();

                    if(!$realItem)
                        throw new \Exception('No se ha encontrado el item con serie ' . $item->series);
                    $realItem->state = 'sold';

                    $realItem->save();
                    //dd($output->id);
                    // Create one Output Detail = OutputDetailItem
                    OutputDetail::create([
                        'output_id' => $output->id,
                        'item_id' => $realItem->id,
                        'price' => $item->price
                    ]);
                } else {
                    $realpackage = Package::find($item->id);

                    if(!$realpackage)
                        throw new \Exception('No se ha encontrado el paquete con serie ' . $item->series);
                    if($realpackage->state != 'available')
                        throw new \Exception('El paquete '. $item->series .'no esta habilitado para hacer operaciones.');

                    $realpackage->state = 'sold';

                    $realpackage->save();
                    //dd($output->id);

                    $outputPackage = OutputPackage::create([
                        'output_id' => $output->id,
                        'package_id' => $realpackage->id,
                        'price' => $item->price
                    ]);

                    $itemsPackageNotAvailble = Item::where('package_id', $realpackage->id)->where('state', '<>', 'available')->get();

                    if( count($itemsPackageNotAvailble) != 0 )
                        throw new \Exception('El paquete '. $item->series .' no está habilitado para hacer operaciones.');

                    $itemsPackage = Item::where('package_id', $realpackage->id)->where('state', 'available')->get();
                    foreach ($itemsPackage as $itemPaq)
                    {
                        OutputPackageDetail::create([
                            'output_package_id' => $outputPackage->id,
                            'item_id' => $itemPaq->id,
                            'price' => $itemPaq->price
                        ]);
                        $itemPaq->state = 'sold';
                        $itemPaq->save();
                    }

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
        $outputs = Output::where('reason', 'sale')->where('active', true)->paginate(3);

        $carbon = new Carbon();
        $datefin = $carbon->now();
        $dateinicio = $carbon->now()->subDays(7);
        $datefin = $datefin->format('Y-m-d');
        $dateinicio = $dateinicio->format('Y-m-d');

        return view('salida.listaventa')->with(compact('customers', 'outputs', 'datefin', 'dateinicio'));
    }

    public function getVentaDetalles($id)
    {
        $details = OutputDetail::where('output_id',$id)->get(['item_id', 'price']);
        $detailspackage = OutputPackage::where('output_id', $id)->get(['package_id', 'price']);
        $array = $details->toArray();
        $array2 = $detailspackage->toArray();

        foreach($array as $k => $detail) {
            $item = Item::find($detail['item_id']);
            $productID = $item->product_id;
            $array[$k]['product_id'] = $productID;
            $array[$k]['quantity'] = $item->quantity;
            $array[$k]['series'] = $item->series;
            $array[$k]['name'] = Product::find($productID)->name;
            $array[$k]['location'] = $item->box->full_name;
        }

        foreach($array2 as $k => $detail) {
            $package = Package::find($detail['package_id']);
            $array2[$k]['package_id'] = $package->id;
            $array2[$k]['quantity'] = 1;
            $array2[$k]['code'] = $package->code;
            $array2[$k]['name'] = 'Paquete';
            $box = Box::find($package->box_id);
            $array2[$k]['location'] = $box->full_name;
        }

        $data['items'] = $array;
        $data['packages'] = $array2;
        return $data;
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
        return view('salida.listaventa')->with(compact('outputs', 'customers', 'datefin', 'dateinicio'));
    }

    public function getAlquiler()
    {
        $carbon = new Carbon();
        $date = $carbon->now();
        $currentDate = $date->format('Y-m-d');
        $clientes = Customer::where('enable', 1)->select('name')->lists('name')->toJson();

        return view('salida.alquiler')->with(compact('clientes', 'currentDate'));
    }

    public function getListaAlquiler()
    {
        $carbon = new Carbon();
        $datefin = $carbon->now();
        $dateinicio = $carbon->now()->subDays(7);
        $datefin = $datefin->format('Y-m-d');
        $dateinicio = $dateinicio->format('Y-m-d');
        $customers = Customer::where('enable', 1)->select('name')->lists('name')->toJson();

        $outputs = Output::where('reason', 'rental')->where('active', true)->paginate(3);

        return view('salida.listaalquiler')->with(compact('customers', 'dateinicio', 'datefin', 'outputs'));
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
        } else {
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

    public function reportRange() {
        /*Excel::create('Salidas', function ($excel){
            $excel->sheet('Salidas', function($sheet) {

                //$outputs = Output::all();

                $outputs[0] = ['dat1', 'data11'];
                $outputs[1] = ['dat2', 'data22'];
                $outputs[2] = ['dat3', 'data33'];

                $sheet->fromArray($outputs);

            });

        })->export('xlsx');*/
        Excel::create('Salidas', function ($excel){
            $excel->sheet('Salidas', function($sheet) {
                $dataexcel = [];

                $outputs = Output::with('customers')->with('items')->with('packages')->get();
                //dd($outputs);
                array_push($dataexcel, ['ID Salida', 'Cliente', 'Tipo', 'Comentario']);
                foreach($outputs as $output) {
                    echo ('Id: '.$output->id.' -- Cliente: '.$output->customers->name. ' -- Tipo: '.$output->reason.' -- Comentario: '.$output->comment);
                    array_push($dataexcel, [$output->id, $output->customers->name, $output->reason, $output->comment]);
                    echo('<br>');
                    array_push($dataexcel, ['Nombre/Producto', 'Codigo/Serie', 'Cantidad', 'Precio', 'Ubicacion']);
                    foreach ($output->items as $item) {
                        $ite = Item::find($item->item_id);
                        $producto = Product::find($ite->product_id);
                        $box = Box::find($ite->box_id);
                        echo ('Nombre/Producto: '.$producto->name.' -- Codigo: '.$ite->series. ' -- Cantidad: 1 -- Precio: '.$item->price.' -- Ubicación: '. $box->full_name);
                        array_push($dataexcel, [$producto->name, $ite->series, '1', $item->price, $box->full_name]);
                        echo ('<br>');
                    }
                    foreach ($output->packages as $package) {
                        $pack = Package::find($package->package_id);
                        $box = Box::find($pack->box_id);
                        echo ('Nombre/Producto: paquete -- Codigo: '.$pack->code. ' -- Cantidad: 1 -- Precio: '.$package->price.' -- Ubicación: '. $box->full_name);
                        array_push($dataexcel, ['Paquete', $pack->code, '1', $package->price, $box->full_name]);
                        echo ('<br>');
                    }
                    echo('<br>');
                    echo ('<br>');
                }

                //dd($dataexcel);



                $sheet->fromArray($dataexcel);
                var_dump($dataexcel);

            });

        })->export('xlsx');

    }
}

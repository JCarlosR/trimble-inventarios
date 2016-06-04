<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Item;
use App\Output;
use App\OutputDetail;
use App\OutputPackage;
use App\OutputPackageDetail;
use App\Package;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function store(Request $request) {
        //dd($request->all());
        $items = json_decode($request->get('items'));

        $cliente = $request->get('cliente');
        $destination = $request->get('destination');
        $fechaAlquiler = $request->get('fechaAlquiler');
        $fechaRetorno = $request->get('fechaRetorno');
        $observacion = $request->get('observacion');

        $customer = Customer::where('name', $cliente)->first();

        if(!$customer)
        {
            return response()->json(['error' => true, 'message' => 'Cliente indicado no existe.']);
        }

        if($fechaRetorno<$fechaAlquiler)
        {
            return response()->json(['error' => true, 'message' => 'Inconsistencia de fechas, la fecha de retorno debe ser posterior a la fecha de alquiler.']);
        }

        if (sizeof($items) == 0)
        {
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar detalles para el alquiler.']);
        }

        DB::beginTransaction();

        try {
            // Create Output Header
            $customerId = $customer->id;
            //dd($destination);
            $output = Output::create([
                'customer_id' => $customerId,
                'destination' => $destination,
                'reason' => 'rental',
                'comment' => $observacion,
                'fechaAlquiler' => $fechaAlquiler,
                'fechaRetorno' => $fechaRetorno
            ]);
            //dd($output);
            foreach($items as $item)
            {
                if($item->type=='prod')
                {
                    $realItem = Item::where('product_id', $item->id)->where('state', 'available')->where('series', $item->series)->first();

                    if(!$realItem)
                        throw new \Exception('No se ha encontrado el item con serie ' . $item->series);
                    $realItem->state = 'rented';

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

                    $realpackage->state = 'rented';

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
                        $itemPaq->state = 'rented';
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

    public function getRentalDetails($id)
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
            $array[$k]['location'] = $item->box->code;
        }

        foreach($array2 as $k => $detail) {
            $package = Package::find($detail['package_id']);
            $array2[$k]['package_id'] = $package->id;
            $array2[$k]['quantity'] = 1;
            $array2[$k]['code'] = $package->code;
            $array2[$k]['name'] = 'Paquete';
            $array2[$k]['location'] = $package->box_id;
        }

        $data['items'] = $array;
        $data['packages'] = $array2;
        return $data;
    }

}
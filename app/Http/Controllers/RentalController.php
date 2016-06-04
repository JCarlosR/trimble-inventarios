<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Item;
use App\Output;
use App\OutputDetail;
use App\OutputPackage;
use App\OutputPackageDetail;
use App\Package;
use Illuminate\Http\Request;

use App\Http\Requests;

class RentalController extends Controller
{
    public function store(Request $request) {
        dd($request->all());
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
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar detalles para la venta.']);
        }

        DB::beginTransaction();

        try {
            // Create Output Header
            $customerId = $customer->id;
            $output = Output::create([
                'customer_id' => $customerId,
                'destination' => $destination,
                'reason' => 'rental',
                'comment' => $observacion
            ]);

            foreach($items as $item)
            {
                if($item->type=='prod')
                {
                    $realItem = Item::where('product_id', $item->id)->where('state', 'available')->where('series', $item->series)->first();

                    if(!$realItem)
                        throw new \Exception('No se ha encontrado el item con serie ' . $item->series);
                    $realItem->state = 'rented';

                    $realItem->save();

                    // Create one Output Detail
                    OutputDetail::create([
                        'output_id' => $output->id,
                        'item_id' => $realItem->id,
                        'price' => $item->price
                    ]);
                }else{
                    $realpackage = Package::find($item->id);

                    if(!$realpackage)
                        throw new \Exception('No se ha encontrado el paquete con serie ' . $item->series);
                    if($realpackage->state != 'available')
                        throw new \Exception('El paquete '. $item->series .'no esta habilitado para hacer operaciones.');

                    $realpackage->state = 'rented';

                    $realpackage->save();

                    $outputPackage = OutputPackage::create([
                        'output_id' => $output->id,
                        'package_id' => $realpackage->id,
                        'price' => $item->price
                    ]);

                    $itemsPackageNotAvailble = Item::where('package_id', $realpackage->id)->where('state', '<>', 'available')->get();

                    if( count($itemsPackageNotAvailble) != 0 )
                        throw new \Exception('El paquete '. $item->series .'no esta habilitado para hacer operaciones.');

                    $itemsPackage = Item::where('package_id', $realpackage->id)->where('state', 'available')->get();
                    foreach ($itemsPackage as $itemPaq)
                    {
                        $outputPackageDetail = OutputPackageDetail::create([
                            'output_package_id' => $outputPackage->id,
                            'item_id' => $itemPaq->id,
                            'price' => $itemPaq->price
                        ]);
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

    public function index(Request $request)
    {

    }

    public function edit($id, Request $request) {

    }



    public function delete() {

    }

}

<?php

namespace App\Http\Controllers;

use App\Box;
use App\Customer;
use App\Item;
use App\Output;
use App\OutputDetail;
use App\OutputPackage;
use App\OutputPackageDetail;
use App\Package;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function store(Request $request) {
        $items = json_decode($request->get('items'));

        $invoiceDate = $request->get('invoice_date');
        $invoiceNumber = $request->get('invoice');
        $igv = $request->get('igv');
        $total = $request->get('total');
        $envio = $request->get('envio');
        $cliente = $request->get('cliente');
        $destination = $request->get('destination');
        $fechaAlquiler = $request->get('fechaAlquiler');
        $fechaRetorno = $request->get('fechaRetorno');
        $observacion = $request->get('observacion');
        $type_doc = $request->get('documento');
        $invoiceNumberRepeated = Output::where('invoice', $invoiceNumber)->count() > 0;
        if($invoiceNumberRepeated)
        {
            return response()->json(['error' => true, 'message' => 'Ha ingresado un número de factura repetido.']);
        }

        $customer = Customer::where('name', $cliente)->first();
        if (! $customer)
        {
            return response()->json(['error' => true, 'message' => 'Cliente indicado no existe.']);
        }

        if ($fechaRetorno < $fechaAlquiler)
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

            $output = Output::create([
                'invoice_date' => $invoiceDate,
                'invoice' => $invoiceNumber,
                'customer_id' => $customerId,
                'user_id' => Auth::user()->id,
                'destination' => $destination,
                'reason' => 'rental',
                'igv' => $igv,
                'total' => $total,
                'type_doc' => $type_doc,
                'shipping' => $envio,
                'state' => 1,
                'comment' => $observacion,
                'fechaAlquiler' => $fechaAlquiler,
                'fechaRetorno' => $fechaRetorno
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
                    //dd($output->id);
                    // Create one Output Detail = OutputDetailItem
                    OutputDetail::create([
                        'output_id' => $output->id,
                        'item_id' => $realItem->id,
                        'price' => $item->price,
                        'originalprice' => $item->originalprice
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
                        'price' => $item->price,
                        'originalprice' => $item->originalprice
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
                            'price' => $itemPaq->price,

                        ]);
                        $itemPaq->state = 'rented';
                        $itemPaq->save();
                    }

                }

            }

            DB::commit();

            $subtotal = 0;
            $dt = Carbon::parse($output->created_at);
            setlocale(LC_TIME, 'en');
            $nameDay = $dt->formatLocalized('%A');
            $day = $dt->formatLocalized('%d');
            $nameMonth = $dt->formatLocalized('%B');
            $year = $dt->formatLocalized('%Y');
            foreach ( $output->details as $outputDetail ){
                $subtotal = $subtotal + $outputDetail->price;
            }
            foreach ( $output->packages as $outputPackage ){
                $subtotal = $subtotal + $outputPackage->price;
            }
            $nombreDia = "";
            switch ($nameDay) {
                case "Monday":
                    $nombreDia = "Lunes"; break;
                case "Tuesday":
                    $nombreDia = "Martes";break;
                case "Wednesday":
                    $nombreDia = "Miércoles"; break;
                case "Thursday":
                    $nombreDia = "Jueves"; break;
                case "Friday":
                    $nombreDia = "Viernes";break;
                case "Saturday":
                    $nombreDia = "Sábado"; break;
                case "Sunday":
                    $nombreDia = "Domingo"; break;
            }

            $nombreMes = "";
            switch ($nameMonth) {
                case "January":
                    $nombreMes = "Enero"; break;
                case "February":
                    $nombreMes = "Febrero";break;
                case "March":
                    $nombreMes = "Marzo"; break;
                case "April":
                    $nombreMes = "Abril"; break;
                case "May":
                    $nombreMes = "Mayo";break;
                case "June":
                    $nombreMes = "Junio"; break;
                case "July":
                    $nombreMes = "Julio"; break;
                case "August":
                    $nombreMes = "Agosto"; break;
                case "September":
                    $nombreMes = "Setiembre"; break;
                case "October":
                    $nombreMes = "Octubre";break;
                case "November":
                    $nombreMes = "Noviembre"; break;
                case "December":
                    $nombreMes = "Diciembre"; break;
            }

            $type_doc = $output->type_doc=="F" ? 'FACTURA' : 'BOLETA';
            $reason = $output->reason=="sale" ? 'ENVÍO' : 'MOVILIDAD';
            //dd($output->type_doc);
            $date = $nombreDia." ".$day." de ".$nombreMes." del ".$year;
            $vista =  view('facturas.pdfFacturas', compact('output', 'date', 'subtotal', 'type_doc', 'reason'))->render();
            $dompdf = app('dompdf.wrapper');
            $dompdf->loadHTML($vista);
            $pdf = $dompdf->output();
            $pdf_name = $invoiceNumber;
            $file_location = $_SERVER['DOCUMENT_ROOT']."/trimble-inventarios/public/facturas/".$pdf_name.".pdf";
            file_put_contents($file_location,$pdf);
            
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

}

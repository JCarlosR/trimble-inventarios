<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Item;
use App\Output;
use App\OutputDetail;
use App\OutputPackage;
use App\Package;
use Illuminate\Http\Request;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function customers()
    {
        $customers = Customer::lists('name');
        $data['customers'] = $customers;
        return $data;
    }
    public function index()
    {
        return view('excel.salida.venta');
    }


    public function sv_data_excel( $inicio,$fin,$cliente )
    {
        Excel::create('Trimble Reporte de Ventas', function($excel) use ($inicio, $fin,$cliente)
        {

            $excel->sheet('Ventas', function($sheet)use ($inicio, $fin,$cliente)
            {
                $customer = Customer::where('name',$cliente)->first();
                $outputs = Output::where('reason', 'sale')->whereBetween('created_at', [$inicio, $fin])->where('customer_id', $customer->id)->get();

                $sales = [];
                $subtotal_details = 0;
                $subtotal_packages = 0;
                $total = 0;
                $sheet->row(1, array(''));
                $sales[] = ['        ', 'Reporte de ventas FECHA INICIO : '.$inicio, 'FECHA FIN : '.$fin];
                $sales[] = ['        '];

                foreach ($outputs as $output) {
                    $subtotal_details = OutputDetail::where('output_id', $output->id)->sum('price');
                    $subtotal_packages = OutputPackage::where('output_id', $output->id)->sum('price');
                    $total = $subtotal_details + $subtotal_packages;
                    $sales[] = ['        ','CLIENTE', 'FECHA DE VENTA', 'TIPO', 'TOTAL VENTA'];
                    $sales[] = ['        ',$output->customers->name, $output->created_at, ($output->type=='local')?'local':'extranjero', $total];
                    $sales[] = ['        '];

                    $outputPackages = OutputPackage::where('output_id', $output->id)->get();

                    if (count($outputPackages) > 0) {
                        $sales[] = ['        ','', 'PAQUETE', 'CÓDIGO', 'UBICACIÓN', 'PRECIO'];
                        foreach ($outputPackages as $outputPackage) {
                            $package = Package::find($outputPackage->package_id);
                            $sales[] = ['        ','', $package->name, $package->code, $package->box->full_name, $outputPackage->price];

                            $sales[] = ['        '];
                            $sales[] = ['        ','', '', 'PRODUCTO', 'SERIE', 'UBICACIÓN'];

                            $items = Item::where('package_id', $package->id)->get();
                            foreach ($items as $item)
                                $sales[] = ['        ','', '', $item->product->name, $item->series, $item->box->full_name];
                            $sales[] = ['        '];
                        }
                    }

                    $outputDetails = OutputDetail::where('output_id', $output->id)->get();

                    if (count($outputDetails) > 0) {
                        $sales[] = ['        ','', 'PRODUCTO', 'SERIE', 'UBICACIÓN', 'PRECIO'];
                        foreach ($outputDetails as $outputDetail) {
                            $item = Item::find($outputDetail->item_id);
                            $sales[] = ['        ','', $item->product->name, $item->series, $item->box->full_name, $outputDetail->price];
                        }
                    }
                    $sales[] = ['        '];
                }

                foreach ($sales as $row)
                    $sheet->appendRow($row);

            })->export('xlsx');
        });
    }

    public function sv_data_pdf($inicio,$fin,$cliente)
    {
        $customer = Customer::where('name',$cliente)->first();
        $outputs = Output::where('reason','sale')->whereBetween('created_at',[$inicio,$fin])->where('customer_id',$customer->id)->get();
        $total = [];

        foreach ($outputs as $output)
            $total[$output->id] = $output->packages->sum('price') + $output->items->sum('price');

        $vista =  view('excel.ventapdf', compact('outputs', 'total','inicio','fin','cliente'));
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($vista);
        return $pdf->stream();
    }

    public function sv_data_verify( $inicio,$fin,$cliente )
    {
        $customer = Customer::where('name', $cliente)->first();

        if(count($customer)<1)
            return ['error'=>true,'message'=>'Nombre de cliente inválido'];
        $outputs = Output::where('reason', 'sale')->whereBetween('created_at', [$inicio, $fin])->where('customer_id', $customer->id)->get();

        if(count($outputs)<1)
            return ['error'=>true,'message'=>'No existen datos'];
        return ['error'=>false,'message'=>'All ok'];
    }


    public function sa_data_excel( $inicio,$fin,$cliente )
    {
        Excel::create('Trimble Reporte de Alquileres', function($excel) use ($inicio, $fin,$cliente)
        {
            $excel->sheet('Alquileres', function($sheet)use ($inicio, $fin,$cliente)
            {
                $customer = Customer::where('name',$cliente)->first();
                $outputs = Output::where('reason', 'rental')->whereBetween('fechaAlquiler', [$inicio, $fin])->where('customer_id', $customer->id)->get();

                $rental = [];
                $subtotal_details = 0;
                $subtotal_packages = 0;
                $total = 0;
                $sheet->row(1, array(''));
                $rental[] = ['        ', 'Reporte de alquileres FECHA INICIO : '.$inicio, 'FECHA FIN : '.$fin];
                $rental[] = ['        '];

                foreach ($outputs as $output) {
                    $subtotal_details = OutputDetail::where('output_id', $output->id)->sum('price');
                    $subtotal_packages = OutputPackage::where('output_id', $output->id)->sum('price');
                    $total = $subtotal_details + $subtotal_packages;
                    $rental[] = ['        ','CLIENTE', 'FECHA ALQUILER', 'TIPO', 'TOTAL ALQUILER'];
                    $rental[] = ['        ',$output->customers->name, $output->fechaAlquiler, ($output->type=='local')?'local':'extranjero', $total];
                    $rental[] = ['        '];

                    $outputPackages = OutputPackage::where('output_id', $output->id)->get();

                    if (count($outputPackages) > 0) {
                        $rental[] = ['        ','', 'PAQUETE', 'CÓDIGO', 'UBICACIÓN', 'PRECIO'];
                        foreach ($outputPackages as $outputPackage) {
                            $package = Package::find($outputPackage->package_id);
                            $rental[] = ['        ','', $package->name, $package->code, $package->box->full_name, $outputPackage->price];

                            $rental[] = ['        '];
                            $rental[] = ['        ','', '', 'PRODUCTO', 'SERIE', 'UBICACIÓN'];

                            $items = Item::where('package_id', $package->id)->get();
                            foreach ($items as $item)
                                $rental[] = ['        ','', '', $item->product->name, $item->series, $item->box->full_name];
                            $rental[] = ['        '];
                        }
                    }

                    $outputDetails = OutputDetail::where('output_id', $output->id)->get();

                    if (count($outputDetails) > 0) {
                        $rental[] = ['        ','', 'PRODUCTO', 'SERIE', 'UBICACIÓN', 'PRECIO'];
                        foreach ($outputDetails as $outputDetail) {
                            $item = Item::find($outputDetail->item_id);
                            $rental[] = ['        ','', $item->product->name, $item->series, $item->box->full_name, $outputDetail->price];
                        }
                    }
                    $rental[] = ['        '];
                }

                foreach ($rental as $row)
                    $sheet->appendRow($row);

            })->export('xlsx');
        });
    }

    public function sa_data_pdf($inicio,$fin,$cliente)
    {
        $customer = Customer::where('name',$cliente)->first();
        $outputs = Output::where('reason', 'rental')->whereBetween('fechaAlquiler', [$inicio, $fin])->where('customer_id', $customer->id)->get();
        $total = [];

        foreach ($outputs as $output)
            $total[$output->id] = $output->packages->sum('price') + $output->items->sum('price');

        $vista =  view('excel.alquilerpdf', compact('outputs', 'total','inicio','fin','cliente'));
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($vista);
        return $pdf->stream();
    }

    public function sa_data_verify( $inicio,$fin,$cliente )
    {
        $customer = Customer::where('name', $cliente)->first();

        if(count($customer)<1)
            return ['error'=>true,'message'=>'Nombre de cliente inválido'];
        $outputs = Output::where('reason', 'rental')->whereBetween('created_at', [$inicio, $fin])->where('customer_id', $customer->id)->get();

        if(count($outputs)<1)
            return ['error'=>true,'message'=>'No existen datos'];
        return ['error'=>false,'message'=>'All ok'];
    }


    public function sb_data_excel( $inicio,$fin )
    {
        Excel::create('Trimble Reporte de Bajas', function($excel) use ($inicio, $fin) {
            $excel->sheet('Bajas', function ($sheet) use ($inicio, $fin) {

                $packages = Package::where('state', 'low')->whereBetween('updated_at', [$inicio, $fin])->get();
                $lows = [];
                $sheet->row(1, array(''));

                if( count($packages)>0 )
                {
                    $lows[] = ['        ', 'Reporte de bajas FECHA INICIO : '.$inicio, 'FECHA FIN : '.$fin];
                    $lows[] = ['        '];

                    foreach ($packages as $package) {
                        $lows[] = ['        ', 'PAQUETE', 'CÓDIGO', 'UBICACIÓN', 'FECHA BAJA'];
                        $lows[] = ['        ', $package->name, $package->code, $package->box->full_name, $package->updated_at];
                        $lows[] = ['        '];

                        $items = Item::where('package_id',$package->id)->get();
                        $lows[] = ['        ','','PRODUCTO','SERIE','UBICACIÓN'];
                        foreach ($items as $item)
                            $lows[] = ['        ','',$item->product->name,$item->series,$item->box->full_name];

                        $lows[] = ['        '];
                    }
                }

                $items = Item::where('state', 'low')->where('package_id',null)->whereBetween('updated_at', [$inicio, $fin])->get();

                if( count($items)>0 )
                {
                    $lows[] = ['        ', 'PRODUCTO', 'SERIE', 'UBICACIÓN', 'FECHA BAJA'];
                    foreach ($items as $item)
                        $lows[] = ['        ',$item->product->name,$item->series,$item->box->full_name,$item->updated_at];
                }
                foreach ($lows as $low)
                    $sheet->appendRow($low);

            })->export('xlsx');
        });
    }

    public function sb_data_pdf($inicio,$fin)
    {
        $packages = Package::where('state', 'low')->whereBetween('updated_at', [$inicio, $fin])->get();
        $items = Item::where('state', 'low')->where('package_id',null)->whereBetween('updated_at', [$inicio, $fin])->get();

        $vista =  view('excel.bajapdf', compact('packages', 'items','inicio','fin'));
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($vista);
        return $pdf->stream();
    }

    public function sb_data_verify($inicio,$fin)
    {
        $packages = Package::where('state', 'low')->whereBetween('updated_at', [$inicio, $fin])->get();
        $items = Item::where('state', 'low')->whereBetween('updated_at', [$inicio, $fin])->get();

        if( count($packages)<1 AND count($items)<1 )
            return ['error'=>true,'message'=>'No existen datos'];
        return ['error'=>false,'message'=>'All ok'];
    }

}
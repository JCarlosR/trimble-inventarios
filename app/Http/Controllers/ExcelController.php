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

    public function sv_index()
    {
        return view('excel.salida.venta');
    }

    public function sv_data( Request $request )
    {

        $cliente = $request->get('cliente');
        $inicio  = $request->get('inicio');
        $fin     = $request->get('fin');

        $outputs = Output::where('reason','sale')->where('active',1)->get();

        foreach ( $outputs as $output) {
            $subtotal_details = OutputDetail::where('output_id',$output->id)->sum('price');
            $subtotal_packages = OutputPackage::where('output_id',$output->id)->sum('price');
            $total = $subtotal_details + $subtotal_packages;

            $sales[] = ['CLIENTE','FECHA DE VENTA','TIPO','TOTAL VENTA'];
            $sales[] = [$output->customer->name,$output->created_at,$output->type,$total];
            $sales[] = [''];

            $outputPackages = OutputPackage::where('output_id',$output->id)->get();

            if( count($outputPackages)>0)
            {
                $sales[] = ['','PAQUETE','CÓDIGO','UBICACIÓN','PRECIO'];
                foreach ( $outputPackages  as $outputPackage) {
                    $package = Package::find($outputPackage->package_id);
                    $sales[] = ['',$package->name,$package->code,$package->box->full_name,$outputPackage->price];

                    $sales[] = [''];
                    $sales[] = ['','','PRODUCTO','SERIE','UBICACIÓN'];

                    $items = Item::where('package_id',$package->id)->get();
                    foreach ($items as $item)
                        $sales[] = ['','',$item->product->name,$item->series,$item->box->full_name];
                }

            }

            $sales[] = [''];
            $outputDetails = OutputDetail::where('output_id',$output->id)->get();

            if( count($outputDetails)>0 )
            {
                $sales[] = ['','PRODUCTO','SERIE','UBICACIÓN','PRECIO'];
                foreach ($outputDetails as $outputDetail) {
                    $item = Item::find($outputDetail->item_id);
                    $sales[] = ['',$item->product->name,$item->series,$item->box->full_name,$outputDetail->price];
                }
            }
            $sales[] = [''];
        }

        $data['sales'] = $sales;

        $x=[];
        $x[] = 10;
        $x[] = 40;
        $deta['x'] = $x;
        return $deta;
    }

    public function sv_excel()
    {
        Excel::create('Trimble Reporte de Ventas', function($excel) {

            $excel->sheet('Ventas', function($sheet) {
                $outputs = Output::where('reason','sale')->get();

                $sales = [];
                $subtotal_details = 0;
                $subtotal_packages=0;
                $total = 0;

                $sheet->row(1, array(''));
                /*
                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontWeight('bold');
                });
                */
                $i = 0;
                foreach ( $outputs as $output) {
                    $subtotal_details = OutputDetail::where('output_id',$output->id)->sum('price');
                    $subtotal_packages = OutputPackage::where('output_id',$output->id)->sum('price');
                    $total = $subtotal_details + $subtotal_packages;
                    $sales[] = ['CLIENTE','FECHA DE VENTA','TIPO','TOTAL VENTA'];
                    $sales[] = [$output->customer->name,$output->created_at,$output->type,$total];
                    $sales[] = [''];

                    $outputPackages = OutputPackage::where('output_id',$output->id)->get();

                    if( count($outputPackages)>0)
                    {
                        $sales[] = ['','PAQUETE','CÓDIGO','UBICACIÓN','PRECIO'];
                        foreach ( $outputPackages  as $outputPackage) {
                            $package = Package::find($outputPackage->package_id);
                            $sales[] = ['',$package->name,$package->code,$package->box->full_name,$outputPackage->price];

                            $sales[] = [''];
                            $sales[] = ['','','PRODUCTO','SERIE','UBICACIÓN'];

                            $items = Item::where('package_id',$package->id)->get();
                            foreach ($items as $item)
                                $sales[] = ['','',$item->product->name,$item->series,$item->box->full_name];
                        }

                    }

                    $sales[] = [''];
                    $outputDetails = OutputDetail::where('output_id',$output->id)->get();

                    if( count($outputDetails)>0 )
                    {
                        $sales[] = ['','PRODUCTO','SERIE','UBICACIÓN','PRECIO'];
                        foreach ($outputDetails as $outputDetail) {
                            $item = Item::find($outputDetail->item_id);
                            $sales[] = ['',$item->product->name,$item->series,$item->box->full_name,$outputDetail->price];
                        }
                    }
                    $sales[] = [''];
                }

                foreach ( $sales as $sale)
                    $sheet->appendRow($sale);

            })->export('xls');

        });
    }

    public function sa_index()
    {

    }

    public function sa_data( $inicio,$fin )
    {

    }

    public function sa_excel()
    {

    }

    public function sr_index()
    {

    }

    public function sr_data( $inicio,$fin )
    {

    }

    public function sr_excel()
    {

    }
}

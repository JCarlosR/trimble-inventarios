<?php

namespace App\Http\Controllers;

use App\Payments;
use Faker\Provider\ru_RU\Payment;
use Illuminate\Http\Request;
use App\Output;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function index()
    {
    	$date = new Carbon();
    	$month = $date->month;
    	$today = $date->format('Y-m-d');
    	$yesterday = $date->subDays(1)->format('Y-m-d');
    	
    	$outputs = Output::whereDate('invoice_date','=',$today)->where('income_tax_date',null)->orWhere('general_sales_tax_date',null)->paginate(4);
    	
    	return view('facturas.index')->with(compact('outputs','today','yesterday','month'));
    }

	public function ir( Request $request)
	{
		$irs =  json_decode( $request->get('ir') );
		$outputs = Output::all();

		if( count($irs)==0 )
			return response()->json(['error'=>true,'message'=>'Por lo menos declare una factura']);

		$date = new Carbon();
		$date = $date->format('Y-m-d');

		foreach ( $outputs as $output) {
			if( $this->contain_element($irs,$output->invoice) )
				if( $output->income_tax_date == null){
					$output->income_tax_date = $date;
					$output->save();
				}
		}

		return response()->json(['error'=>false,'message'=>'Impuestos a la Renta, declarados correctamente']);
	}


	public function igv( Request $request)
	{
		$irs =  json_decode( $request->get('ir') );
		$outputs = Output::all();

		if( count($irs)==0 )
			return response()->json(['error'=>true,'message'=>'Por lo menos declare una factura']);

		$date = new Carbon();
		$date = $date->format('Y-m-d');

		foreach ( $outputs as $output) {
			if( $this->contain_element($irs,$output->invoice) )
				if( $output->general_sales_tax_date == null){
					$output->general_sales_tax_date = $date;
					$output->save();
				}
		}

		return response()->json(['error'=>false,'message'=>'IGV declarado a la SUNAT, correctamente']);
	}

	public function contain_element( $array,$element )
	{
		for( $i=0;$i<count($array);$i++ )
			if( $array[$i]==$element  )
				return true;
		return	false;
	}


	public function history()
	{
		$date = new Carbon();
		$month = $date->month;
		$today = $date->format('Y-m-d');
		$yesterday = $date->subDays(1)->format('Y-m-d');

		$outputs = Output::whereDate('invoice_date','=',$today)->where('income_tax_date','!=',null)->where('general_sales_tax_date','!=',null)->paginate(4);

		return view('facturas.history')->with(compact('outputs','today','yesterday','month'));
	}

	public function mes( $mes )
	{

	}

	public function fechas( $inicio, $fin )
	{

	}

	public function verify()
	{
		$date = new Carbon();
		$month = $date->month;
		$year = $date->year;

		$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->
						   where('income_tax_date','!=',null)->where('general_sales_tax_date','!=',null)->get();
		if( count($outputs)==0 )
			return response()->json(['error'=>true]);
		return response()->json(['error'=>false]);
	}

	public function excel()
	{
		$date = new Carbon();
		$year = $date->year;
		$date = $date->format('d-m-Y');

		Excel::create('Reporte de Facturas', function($excel)use ($date,$year){
			$excel->sheet('Seguimiento de Facturas', function ($sheet)use ($date,$year){

				// Cabecera Reporte de Facturas
				$sheet->mergeCells('B2:T2');
				$sheet->cells('B2:T2', function($cells) {
					$cells->setBorder('thin', 'thin', 'thin', 'thin');
					$cells->setFontColor('#000000');
					$cells->setBackGround('#336600');
					$cells->setFontWeight('bold');
					$cells->setFontFamily('Calibri');
					$cells->setFontSize(26);
					$cells->setAlignment('center');
					$cells->setVAlignment('center');
				});

				// Datos de factura

				$sheet->cells('B3:T4', function($cells) {
					$cells->setFontWeight('bold');
					$cells->setFontFamily('Calibri');
					$cells->setAlignment('center');
					$cells->setVAlignment('center');
				});

				$sheet->getStyle('B3:T4')->getAlignment()->applyFromArray(
						array('horizontal' => 'center')
				);

				$header = [];
				$spaces = '       ';
				$header[] = array($spaces,'REPORTE DE FACTURAS al '.$date);
				$header[] = array($spaces,' N° ',' CLIENTE ',' DOCUMENTO ','TIPO DOC ',' FECHA EMISIÓN ',' SUB TOTAL ',' IGV ',' TOTAL BRUTO ');

				$sheet->mergeCells('B3:B4');
				$sheet->mergeCells('C3:C4');
				$sheet->mergeCells('D3:D4');
				$sheet->mergeCells('E3:E4');
				$sheet->mergeCells('F3:F4');
				$sheet->mergeCells('G3:G4');
				$sheet->mergeCells('H3:H4');
				$sheet->mergeCells('I3:I4');

				//Detracción
				$sheet->mergeCells('J3:K3');
				$sheet->cell('J3', function($cell) {
					$cell->setValue(' DETRACCIÓN ');
				});
				$sheet->cell('J4', function($cell) {
					$cell->setValue(' MONTO ');
				});
				$sheet->cell('K4', function($cell) {
					$cell->setValue(' FECHA ');
				});

				// IMPUESTO A LA RENTA
				$sheet->mergeCells('L3:M3');
				$sheet->cell('L3', function($cell) {
					$cell->setValue(' IMPUESTO A LA RENTA ');
				});
				$sheet->cell('L4', function($cell) {
					$cell->setValue(' MONTO ');
				});
				$sheet->cell('M4', function($cell) {
					$cell->setValue(' FECHA ');
				});

				//IGV PARA SUNAT
				$sheet->mergeCells('N3:O3');
				$sheet->cell('N3', function($cell) {
					$cell->setValue(' IGV PARA SUNAT ');
				});
				$sheet->cell('N4', function($cell) {
					$cell->setValue(' MONTO ');
				});
				$sheet->cell('O4', function($cell) {
					$cell->setValue(' FECHA ');
				});

				//NETO A RECIBIR
				$sheet->mergeCells('P3:Q3');
				$sheet->cell('P3', function($cell) {
					$cell->setValue(' NETO A RECIBIR ');
				});
				$sheet->cell('P4', function($cell) {
					$cell->setValue(' MONTO ');
				});
				$sheet->cell('Q4', function($cell) {
					$cell->setValue(' FECHA ');
				});

				//DISPONIBLE
				$sheet->mergeCells('R3:S3');
				$sheet->cell('R3', function($cell) {
					$cell->setValue(' DISPONIBLE ');
				});
				$sheet->cell('R4', function($cell) {
					$cell->setValue(' MONTO ');
				});
				$sheet->cell('S4', function($cell) {
					$cell->setValue(' FECHA ');
				});

				//OBSERVACIÓN
				$sheet->mergeCells('T3:T4');
				$sheet->cell('T3', function($cell) {
					$cell->setValue(' OBSERVACIÓN ');
				});


				$sheet->setBorder('B3:T4', 'thin');
				$sheet->fromArray($header,null,'A2',false,false);

				//Data
				$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->
				where('income_tax_date','!=',null)->where('general_sales_tax_date','!=',null)->get();
				$invoices  = [];

				$i=0;
				foreach ( $outputs as $output) {
					$subTotal = $output->total-$output->igv;
					$detraction = ($output->total>=700)?$output->total*0.10:0;
					$income_tax = ($output->income_tax_date != null)?$output->total*0.015:0;
					$general_sales_tax = ($output->general_sales_tax_date != null)?$output->igv:0;
					$net_money = ($output->total>=700)?$output->total*0.90:$output->total;
					$disponible = $output->total - $detraction -$income_tax - $general_sales_tax;

					$invoice__state_date = $spaces;
					if( $output->state==0 )
					{
						$payment = Payments::where('invoice',$output->invoice)->orderBy('created_at', 'desc')->first();
						if( count($payment) !=0 )
							$invoice__state_date = $payment->date;
					}

					$i+=1;
					$invoices [] = [$spaces,$i,$output->customers->name,$output->invoice,
									($output->type_doc=='F')?'Factura':'Boleta',$output->invoice_date,$subTotal,$output->igv,
								    $output->total,$detraction,($output->total>=700)? $output->detraction->detraction_date:$spaces,
							        $income_tax,($output->income_tax_date != null)?$output->income_tax_date:'',
									$general_sales_tax,($output->general_sales_tax_date != null)?$output->general_sales_tax_date:$spaces,
									$net_money, $invoice__state_date ,$disponible, $invoice__state_date ,($output->state==0)?'PAGADA':'PENDIENTE'
					];
				}
				$i=4;
				foreach ($invoices as $invoice){
					$i+=1;
					$sheet->appendRow($invoice);
					$sheet->setBorder('B'.$i.':T'.$i, 'thin');
					$sheet->getStyle('B'.$i.':T'.$i)->getAlignment()->setWrapText(true);

					$sheet->cell('P'.$i, function($cell) {
						$cell->setBackground('#ffcc00');
					});

					$sheet->cell('R'.$i, function($cell) {
						$cell->setBackground('#6699ff');
					});
				}


			})->export('xlsx');
		});
	}
}

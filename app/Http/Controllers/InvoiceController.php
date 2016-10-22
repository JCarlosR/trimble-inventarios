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
	//Invoices to declare
    public function index()
    {
		$date = new Carbon();
		$month = $date->month;
		$year = $date->year;
		$today = $date->format('Y-m-d');
		$yesterday = $date->subDays(1)->format('Y-m-d');

		$outputs_collection = collect();
		$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $month )->
						   where('general_sales_tax_date',null)->get();
		foreach ( $outputs as $output)
			$outputs_collection->push($output);

		$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $month )->
						   where('income_tax_date',null)->get();
		foreach ( $outputs as $output)
			$outputs_collection->push($output);

		$outputs = $outputs_collection->unique('id');

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

	//Filtering data in invoices to declare
	public function mes_view( $mes )
	{
		$date = new Carbon();
		$year = $date->year;
		$outputs_collection = collect();
		$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $mes )->
					       where('general_sales_tax_date',null)->get();
		foreach ( $outputs as $output)
			$outputs_collection->push($output);

		$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $mes )->
						   where('income_tax_date',null)->get();
		foreach ( $outputs as $output)
			$outputs_collection->push($output);

		$outputs = $outputs_collection->unique('id');

		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		return response()->json($outputs);
	}

	public function fecha_view( $inicio, $fin )
	{
		$outputs_collection = collect();
		$outputs = Output::whereDate('invoice_date','>=',$inicio)->whereDate('invoice_date','<=',$fin)->
						   where('general_sales_tax_date',null)->get();
		foreach ( $outputs as $output)
			$outputs_collection->push($output);

		$outputs = Output::whereDate('invoice_date','>=',$inicio)->whereDate('invoice_date','<=',$fin)->
						   where('income_tax_date',null)->get();
		foreach ( $outputs as $output)
			$outputs_collection->push($output);

		$outputs = $outputs_collection->unique('id');

		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		return response()->json($outputs);
	}

	// Invoices made a history
	public function history()
	{
		$date = new Carbon();
		$month = $date->month;
		$year = $date->year;
		$today = $date->format('Y-m-d');
		$yesterday = $date->subDays(1)->format('Y-m-d');
		$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $month )->
						   where('income_tax_date','!=',null)->where('general_sales_tax_date','!=',null)->get();

		return view('facturas.history')->with(compact('outputs','today','yesterday','month'));
	}

	public function mes_history( $mes )
	{
		$date = new Carbon();
		$year = $date->year;
		$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $mes )->
				           where('income_tax_date','!=',null)->where('general_sales_tax_date','!=',null)->get();

		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		return response()->json($outputs);
	}

	public function fecha_history( $inicio, $fin )
	{
		$outputs_collection = collect();
		$outputs = Output::whereDate('invoice_date','>=',$inicio)->whereDate('invoice_date','<=',$fin)->
		                   where('income_tax_date','!=',null)->where('general_sales_tax_date','!=',null)->get();

		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		return response()->json($outputs);
	}


	// Invoices exported in excel
	public function invoices_excel()
	{
		$date = new Carbon();
		$month = $date->month;
		$year = $date->year;
		$end = $date->format('Y-m-d');
		$start = $date->subDays(1);
		$start = $start->format('Y-m-d');

		return view('facturas.excel')->with(compact('month','year','start','end'));
	}

	// Report considering year
	public function verify_invoice_year( $year,$pay,$wait )
	{
		$outputs = Output::where( DB::raw('YEAR(invoice_date)'),'=', $year )->get();
		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		if( $wait == -1 && $pay != -1 )
			$outputs = Output::where(DB::raw('YEAR(invoice_date)'), '=', $year)->where('state', 0)->get();

		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);


		if( $wait != -1 && $pay == -1)
			$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where('state',1)->get();

		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		return response()->json(['error'=>false]);
	}

	public function invoice_year( $year,$pay,$wait )
	{
		Excel::create('Reporte de Facturas', function($excel)use ($year,$pay,$wait) {
			$excel->sheet('Seguimiento de Facturas', function ($sheet)use ($year,$pay,$wait) {

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
				$header[] = array($spaces,'REPORTE DE FACTURAS del año '.$year);
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
				if( $wait == -1 && $pay != -1 )
					$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where('state',0)->get();
				elseif( $wait != -1 && $pay == -1)
					$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where('state',1)->get();
				else
					$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->get();
				$invoices = [];
				$i=0;
				foreach ( $outputs as $output) {
					$detraction = 0;
					$income_tax=0;
					$general_sales_tax=0;
					$detraction_date = $spaces;
					$income_tax_date = $spaces;
					$general_sales_tax_date = $spaces;
					$invoice_state_date = $spaces;

					$subTotal  = $output->total-$output->igv;
					$igv       = $output->igv;
					$total     =  $output->total;
					$net_money = $total;
					if(  $total>=700 ) {
						$detraction = $total*0.10;
						$net_money  = $total*0.90;
						$detraction_date = $output->detraction->detraction_date;
						$date = new Carbon($detraction_date);
						$detraction_date = $date->format('d-m-Y');
					}

					if( $output->income_tax_date != null ) {
						$income_tax = $total*0.015;
						$date = new Carbon($output->income_tax_date);
						$income_tax_date = $date->format('d-m-Y');
					}

					if(  $output->general_sales_tax_date != null ) {
						$general_sales_tax = $igv;
						$date = new Carbon($output->general_sales_tax_date);
						$general_sales_tax_date = $date->format('d-m-Y');
					}

					$disponible =  $total - $detraction - $income_tax - $general_sales_tax;

					$subTotal = number_format($subTotal,2,',','');
					$igv = number_format($igv,2,',','');
					$total = number_format($total,2,',','');
					$detraction = number_format($detraction,2,',','');
					$income_tax = number_format($income_tax,2,',','');
					$general_sales_tax = number_format($general_sales_tax,2,',','');
					$net_money = number_format($net_money,2,',','');
					$disponible = number_format($disponible,2,',','');

					if( $output->state == 0 ) {
						$payment = Payments::where('invoice',$output->invoice)->orderBy('created_at', 'desc')->first();
						if( count($payment) !=0 ){
							$date = new Carbon($payment->date);
							$invoice_state_date = $date->format('d-m-Y');
						}
					}

					$date = new Carbon($output->invoice_date);
					$invoice_date = $date->format('d-m-Y');

					$i+=1;
					$invoices [] = [$spaces,$i,$output->customers->name,$output->invoice,
							($output->type_doc=='F')?'Factura':'Boleta',$invoice_date,$subTotal,$igv,
							$total,$detraction,$detraction_date,$income_tax,$income_tax_date,
							$general_sales_tax,$general_sales_tax_date,$net_money,
							$invoice_state_date ,$disponible, $invoice_state_date ,
							($output->state==0)?'PAGADA':'PENDIENTE'
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

	// Report considering month
	public function verify_invoice_month( $month,$pay,$wait )
	{
		$date = new Carbon();
		$year = $date->year;
		$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'),'=', $month )->get();

		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		if( $wait == -1 && $pay != -1 )
			$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $month )->where('state',0)->get();

		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		if( $wait != -1 && $pay == -1)
			$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $month )->where('state',1)->get();

		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		return response()->json(['error'=>false]);
	}

	public function invoice_month( $month,$pay,$wait )
	{
		Excel::create('Reporte de Facturas', function($excel)use ($month,$pay,$wait) {
			$excel->sheet('Seguimiento de Facturas', function ($sheet)use ($month,$pay,$wait) {

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
				$header[] = array($spaces,'REPORTE DE FACTURAS del mes de '.$this->month_name($month) );
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
				$date = new Carbon();
				$year = $date->year;

				if( $wait == -1 && $pay != -1 )
					$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $month )->where('state',0)->get();
				elseif( $wait != -1 && $pay == -1)
					$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $month )->where('state',1)->get();
				else
					$outputs = Output::where( DB::raw('YEAR(invoice_date)'), '=', $year )->where( DB::raw('MONTH(invoice_date)'), '=', $month )->get();
				$invoices = [];
				$i=0;
				foreach ( $outputs as $output) {
					$detraction = 0;
					$income_tax=0;
					$general_sales_tax=0;
					$detraction_date = $spaces;
					$income_tax_date = $spaces;
					$general_sales_tax_date = $spaces;
					$invoice_state_date = $spaces;

					$subTotal  = $output->total-$output->igv;
					$igv       = $output->igv;
					$total     =  $output->total;
					$net_money = $total;
					if(  $total>=700 ) {
						$detraction = $total*0.10;
						$net_money  = $total*0.90;
						$date = new Carbon($output->detraction->detraction_date);
						$detraction_date = $date->format('d-m-Y');
					}

					if( $output->income_tax_date != null ) {
						$income_tax = $total*0.015;
						$date = new Carbon( $output->income_tax_date);
						$income_tax_date = $date->format('d-m-Y');
					}

					if(  $output->general_sales_tax_date != null ) {
						$general_sales_tax = $igv;
						$date = new Carbon($output->general_sales_tax_date);
						$general_sales_tax_date = $date->format('d-m-Y');
					}

					$disponible =  $total - $detraction - $income_tax - $general_sales_tax;

					$subTotal = number_format($subTotal,2,',','');
					$igv = number_format($igv,2,',','');
					$total = number_format($total,2,',','');
					$detraction = number_format($detraction,2,',','');
					$income_tax = number_format($income_tax,2,',','');
					$general_sales_tax = number_format($general_sales_tax,2,',','');
					$net_money = number_format($net_money,2,',','');
					$disponible = number_format($disponible,2,',','');

					if( $output->state == 0 ) {
						$payment = Payments::where('invoice',$output->invoice)->orderBy('created_at', 'desc')->first();
						if( count($payment) !=0 ){
							$date = new Carbon($payment->date);
							$invoice_state_date = $date->format('d-m-Y');
						}
					}
					$date = new Carbon($output->invoice_date);
					$invoice_date = $date->format('d-m-Y');

					$i+=1;
					$invoices [] = [$spaces,$i,$output->customers->name,$output->invoice,
							($output->type_doc=='F')?'Factura':'Boleta',$invoice_date,$subTotal,$igv,
							$total,$detraction,$detraction_date,$income_tax,$income_tax_date,
							$general_sales_tax,$general_sales_tax_date,$net_money,
							$invoice_state_date ,$disponible, $invoice_state_date ,($output->state==0)?'PAGADA':'PENDIENTE'
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

	// Report considering date range
	public function verify_invoice_date( $start,$end,$pay,$wait )
	{
		$outputs = Output::whereDate('invoice_date','>=',$start)->whereDate('invoice_date','<=',$end)->get();
		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		if( $wait == -1 && $pay != -1 )
			$outputs = Output::whereDate('invoice_date','>=',$start)->whereDate('invoice_date','<=',$end)->where('state',0)->get();
		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		if( $wait != -1 && $pay == -1)
			$outputs = Output::whereDate('invoice_date','>=',$start)->whereDate('invoice_date','<=',$end)->where('state',1)->get();
		if( count($outputs)==0 )
			return response()->json(['error'=>true,'message'=>'No existen datos']);

		return response()->json(['error'=>false]);
	}

	public function invoice_date( $start,$end,$pay,$wait )
	{
		Excel::create('Reporte de Facturas', function($excel)use ($start,$end,$pay,$wait) {
			$excel->sheet('Seguimiento de Facturas', function ($sheet)use ($start,$end,$pay,$wait) {

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

				$_start = new Carbon($start);
				$_start = $_start->format('d-m-Y');
				$_end = new Carbon($end);
				$_end = $_end->format('d-m-Y');

				$header[] = array($spaces,'REPORTE DE FACTURAS entre las fechas '.$_start.' y '.$_end );
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
				$date = new Carbon();
				$year = $date->year;

				if( $wait == -1 && $pay != -1 )
					$outputs = Output::whereDate('invoice_date','>=',$start)->whereDate('invoice_date','<=',$end)->where('state',0)->get();
				elseif( $wait != -1 && $pay == -1)
					$outputs = Output::whereDate('invoice_date','>=',$start)->whereDate('invoice_date','<=',$end)->where('state',1)->get();
				else
					$outputs = Output::whereDate('invoice_date','>=',$start)->whereDate('invoice_date','<=',$end)->get();
				$invoices = [];
				$i=0;
				foreach ( $outputs as $output) {
					$detraction = 0;
					$income_tax=0;
					$general_sales_tax=0;
					$detraction_date = $spaces;
					$income_tax_date = $spaces;
					$general_sales_tax_date = $spaces;
					$invoice_state_date = $spaces;

					$subTotal  = $output->total-$output->igv;
					$igv       = $output->igv;
					$total     =  $output->total;
					$net_money = $total;
					if(  $total>=700 ) {
						$detraction = $total*0.10;
						$net_money  = $total*0.90;
						$date = new Carbon($output->detraction->detraction_date);
						$detraction_date = $date->format('d-m-Y');
					}

					if( $output->income_tax_date != null ) {
						$income_tax = $total*0.015;
						$date = new Carbon($output->income_tax_date);
						$income_tax_date = $date->format('d-m-Y');
					}

					if(  $output->general_sales_tax_date != null ) {
						$general_sales_tax = $igv;
						$date = new Carbon($output->general_sales_tax_date);
						$general_sales_tax_date = $date->format('d-m-Y');
					}

					$disponible =  $total - $detraction - $income_tax - $general_sales_tax;

					$subTotal = number_format($subTotal,2,',','');
					$igv = number_format($igv,2,',','');
					$total = number_format($total,2,',','');
					$detraction = number_format($detraction,2,',','');
					$income_tax = number_format($income_tax,2,',','');
					$general_sales_tax = number_format($general_sales_tax,2,',','');
					$net_money = number_format($net_money,2,',','');
					$disponible = number_format($disponible,2,',','');

					if( $output->state == 0 ) {
						$payment = Payments::where('invoice',$output->invoice)->orderBy('created_at', 'desc')->first();
						if( count($payment) !=0 ){
							$date = new Carbon($payment->date);
							$invoice_state_date = $date->format('d-m-Y');
						}
					}

					$date = new Carbon($output->invoice_date);
					$invoice_date = $date->format('d-m-Y');

					$i+=1;
					$invoices [] = [$spaces,$i,$output->customers->name,$output->invoice,
							($output->type_doc=='F')?'Factura':'Boleta',$invoice_date,$subTotal,$igv,
							$total,$detraction,$detraction_date,$income_tax,$income_tax_date,
							$general_sales_tax,$general_sales_tax_date,$net_money,
							$invoice_state_date ,$disponible, $invoice_state_date ,($output->state==0)?'PAGADA':'PENDIENTE'
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

	// Get month's name
	function month_name( $number )
	{
		switch( $number ) {
			case 1:
				return 'Enero';
				break;
			case 2:
				return 'Febrero';
				break;
			case 3:
				return 'Marzo';
				break;
			case 4:
				return 'Abril';
				break;
			case 5:
				return 'Mayo';
				break;
			case 6:
				return 'Junio';
				break;
			case 7:
				return 'Julio';
				break;
			case 8:
				return 'Agosto';
				break;
			case 9:
				return 'Setiembre';
				break;
			case 10:
				return 'Octubre';
				break;
			case 11:
				return 'Noviembre';
				break;
			case 12:
				return 'Diciembre';
				break;
		}
	}
}

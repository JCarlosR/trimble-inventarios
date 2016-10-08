<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Output;
use Carbon\Carbon;

use App\Http\Requests;

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
}

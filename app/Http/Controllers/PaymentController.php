<?php

namespace App\Http\Controllers;

use App\Output;
use App\Payments;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $carbon = new Carbon();
        $currentDate = $carbon->now();
        $currentDate = $currentDate->format('Y-m-d');
        $facturas = Output::where('active','1')->where('state', 0)->orderBy('invoice', 'asc')->select('invoice')->lists('invoice')->toJson();
        return view('payment.index')->with(compact('facturas', 'currentDate'));
    }

    public function search($invoice)
    {
        $payments = Payments::where('invoice',$invoice)->where('enable', 1)->get();

        return $payments;
    }

    public function store(Request $request)
    {

        $invoice = $request->get('factura');
        $monto = $request->get('monto');
        $type = $request->get('type');
        $operation = $request->get('operation');
        $date = $request->get('date');
        
        
        if($monto=="")
        {
            return response()->json(['error' => true, 'message' => 'Se debe ingresar un monto de pago.']);
        }

        if($operation=="")
        {
            return response()->json(['error' => true, 'message' => 'Se debe ingresar la fecha de pago.']);
        }

        DB::beginTransaction();
        $suma = Payments::where('invoice', $invoice)->sum('payment');
        //dd($suma);
        try{
            Payments::create([
                'invoice' => $invoice,
                'user_id' => Auth::user()->id,
                'payment' => $monto,
                'type' => $type,
                'operation' => $operation,
                'date' => $date,
                'enable' => 1,
            ]);

            $output = Output::where('invoice', $invoice)->first();
            if(!$output)
            {
                throw new \Exception('La factura indicada no existe.');
            }



            $sumaTotal = $monto+$suma;
            //dd($output->total);

            if($sumaTotal == $output->total)
            {
                $output->state = 0;
                $output->save();
            }else{
                if ($sumaTotal > $output->total)
                    throw new \Exception('La suma de pagos no debe ser mayor al monto total de la venta.');
            }
            
            DB::commit();
            return response()->json(['error' => false]);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
        
        
    }


}

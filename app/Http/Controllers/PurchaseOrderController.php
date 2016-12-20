<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerType;
use App\Item;
use App\Output;
use App\Product;
use App\Provider;
use App\PurchaseOrder;
use App\PurchaseOrderDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

class PurchaseOrderController extends Controller
{

    public function index()
    {
        return view('purchase_order.index');
    }

    public function create()
    {
        $productos = Product::select('name')->lists('name')->toJson();
        $proveedores = Provider::select('name')->lists('name')->toJson();
        return view('purchase_order.create')->with(compact('productos', 'proveedores'));
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'document' => 'required',
            'persona' => 'required',
            'types'=>'exists:customer_types,id',
            'address'=>'min:5',
        ], [
            'name.required' => 'Es nesecario ingresar el nombre del cliente.',
            'name.min' => 'El nombre del cliente debe tener 3 letras como mínimo',
            'persona.required' => 'Es necesario escojer un tipo de persona (Natural o Juridica)',
            'document.required' => 'Es necesario ingresar el numero de documento de identidad del cliente',
            'type.required' => 'Es necesario indicar si es una persona natural o jurídica.',
            'types.exists' => 'El tipo de cliente no existe.',
            'address.min' => 'La dirección debe contener por lo menos 5 letras.'
        ]);

        $document="";

        if($request->get('persona') == 'Juridica' and strlen($request->get('document')) != 11 )
            $document="errorDocument";

        if ($validator->fails() OR $document == "errorDocument")
        {
            $data['errors'] = $validator->errors();
            if( $document == "errorDocument" )
                $data['errors']->add("errorDocument", "Contradicción entre el tipo de persona(Natural y jurídica) y su número de documento ");
            return redirect('clientes')
                ->withInput($request->all())
                ->with($data);
        }

        $customer = Customer::find( $request->get('id') );
        $customer->name = $request->get('name');
        $customer->document = $request->get('document');
        $customer->address = $request->get('address');
        $customer->type = $request->get('persona');
        $customer->phone = $request->get('phone');
        $customer->customer_type_id = $request->get('types');

        $customer->save();

        return redirect('clientes');
    }

    public function store( Request $request)
    {
        //dd($request->all());
        $items = json_decode($request->get('items'));

        $invoiceDate = $request->get('invoice_date');
        $factura = $request->get('factura');
        $moneda = $request->get('moneda');
        $proveedor = $request->get('proveedor');
        $type = $request->get('tipo');
        $type_doc = $request->get('documento');
        $igv = $request->get('igv');
        $total = $request->get('total');
        $envio = $request->get('envio');
        $observacion = $request->get('observacion');

        $provider = Provider::where('name', $proveedor)->first();
        if(!$provider)
        {
            return response()->json(['error' => true, 'message' => 'El proveedor indicado no existe.']);
        }

        if (sizeof($items) == 0)
        {
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar detalles para la orden de compra.']);
        }

        $invoiceNumberRepeated = PurchaseOrder::where('invoice', $factura)->count() > 0;
        if($invoiceNumberRepeated)
        {
            return response()->json(['error' => true, 'message' => 'Ha ingresado un número de factura repetido.']);
        }

        DB::beginTransaction();

        try {
            // Create Output Header
            $providerId = $provider->id;
            $purchaseOrder = PurchaseOrder::create([
                'invoice_date' => $invoiceDate,
                'invoice' => $factura,
                'provider_id' => $providerId,
                'user_id' => Auth::user()->id,
                'type' => $type,
                'type_doc' => $type_doc,
                'igv' => $igv,
                'total' => $total,
                'shipping' => $envio,
                'state' => 1,
                'currency' => $moneda,
                'comment' => $observacion
            ]);

            foreach($items as $item)
            {
                if($item->type=='prod')
                {
                    $realProduct = Product::where('id', $item->id)->first();

                    if(!$realProduct)
                        throw new \Exception('No se ha encontrado el item con serie ' . $item->series);

                    // Sacar el IGV

                    $igv = $item->subtotal - ($item->quantity * $item->originalprice);

                    PurchaseOrderDetails::create([
                        'purchase_order_id' => $purchaseOrder->id,
                        'product_id' => $item->id,
                        'quantity' => $item->quantity,
                        'originalprice' => $item->originalprice,
                        'igv' => $igv,
                        'subtotal' => $item->subtotal
                    ]);
                }

            }

            DB::commit();

            $subtotal = 0;
            $dt = Carbon::parse($purchaseOrder->created_at);
            setlocale(LC_TIME, 'en');
            $nameDay = $dt->formatLocalized('%A');
            $day = $dt->formatLocalized('%d');
            $nameMonth = $dt->formatLocalized('%B');
            $year = $dt->formatLocalized('%Y');
            foreach ( $purchaseOrder->details as $detail ){
                $subtotal = $subtotal + $detail->subtotal;
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

            $type_doc = $purchaseOrder->type_doc=="F" ? 'FACTURA' : 'BOLETA';
            $reason = "ENVIO";

            $date = $nombreDia." ".$day." de ".$nombreMes." del ".$year;
            //dd($purchaseOrder->details->product);
            $vista =  view('ordenes.pdfOrdenes', compact('purchaseOrder', 'date', 'subtotal', 'type_doc', 'reason'))->render();
            $dompdf = app('dompdf.wrapper');
            $dompdf->loadHTML($vista);
            $pdf = $dompdf->output();
            $pdf_name = $factura;
            $file_location = $_SERVER['DOCUMENT_ROOT']."/trimble-inventarios/public/ordenes/".$pdf_name.".pdf";
            file_put_contents($file_location,$pdf);

            return response()->json(['error' => false]);

            // all good
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

    }

    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:customers,id'
        ],[
            'id.exists' => 'El cliente no puede ser eliminado porque no existe.'
        ]);
        $customer_ = Output::where('customer_id', $request->get('id'))->first();
        //dd($customer_);
        if ($validator->fails() OR $customer_ != null)
        {
            $data['errors'] = $validator->errors();
            if( $customer_ != null )
                $data['errors']->add("id", "No puede eliminar el cliente seleccionado, porque tiene salidas registradase.");

            return redirect('clientes')
                ->withInput($request->all())
                ->with($data);
        }
        $customer = Customer::find($request->get('id'));
        $customer->enable = 0;

        $customer->save();
        return redirect('clientes');
    }

    public function back()
    {
        $clientes = Customer::where('enable', 0)->paginate(3);

        return view('customer.back')->with(compact(['clientes']));
    }

    public function giveBack( Request $request )
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'exists:customers,id'
        ],[
            'id.exists' => 'El cliente no puede ser reestablecer porque no existe.'
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        $customer = Customer::find($request->get('id'));
        $customer->enable = 1;

        $customer->save();
        return redirect('clientes/eliminados');
    }

}

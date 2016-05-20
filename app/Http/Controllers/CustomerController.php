<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

class CustomerController extends Controller
{

    public function index()
    {
        $clientes = Customer::all();
        $tipos = CustomerType::all();
        return view('customer.index')->with(compact(['clientes', 'tipos']));
    }

    public function create()
    {
        $types = CustomerType::all();
        return view('customer.create')->with(compact(['types']));
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'types'=>'exists:customer_types,id',
            'address'=>'min:5',
        ]);

        $name="";$types="";$address="";$customer_repeated="";$customer_id  ="";
        $customer_ = Customer::where('name',$request->get('name') )->first();

        if( $customer_ != null )
        {
            $customer_id = $customer_->id;
            if( $customer_id != $request->get('id') )
                $customer_repeated = "errorRepeated";
        }

        if( strlen( $request->get('name') ) <5 )
            $name = "errorName";
        if( strlen($request->get('address') ) <5 )
            $address = "errorAddress";
        $customer_type = CustomerType::find($request->get('types'));
        if( $customer_type = null )
        {
            $types = "errorType";
        }

        if ($validator->fails() OR $name == "errorName" OR $address == "errorAddress" OR $types == "errorType" OR $customer_repeated == "errorRepeated" )
        {
            $data['errors'] = $validator->errors();
            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre del cliente debe tener por lo menos 5 caracteres ");
            else if (  $address == "errorAddress" )
                $data['errors']->add("address", "La dirección del cliente debe tener por lo menos 5 caracteres ");
            else if (  $types == "errorType")
                $data['errors']->add("types", "Debe ingresar un tipo de cliente valido ");
            else if( $customer_repeated == "errorRepeated" )
                $data['errors']->add("name", "Ya existe un cliente con el mismo nombre");

            return redirect('clientes')
                ->withInput($request->all())
                ->with($data);
        }

        $customer = Customer::find( $request->get('id') );
        $customer->name = $request->get('name');
        $customer->address = $request->get('address');
        $customer->phone = $request->get('phone');
        $customer->comments = $request->get('comments');
        $customer->customer_type_id = $request->get('types');

        $customer->save();

        return redirect('clientes');
    }

}

<?php

namespace App\Http\Controllers;

use App\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

class CustomerTypeController extends Controller
{

    public function create()
    {
        $customerTypes = CustomerType::all();
        return view('customer_type.create')->with(compact(['customerTypes']));
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description'=>'required|min:3',
        ]);

        $customer_type = CustomerType::find( $request->get('id') );
        $customer_type->name = $request->get('name');
        $customer_type->description = $request->get('description');
        $customer_type->save();

        return redirect('/clientes/tipos');
    }

    public function created( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description'=>'required|min:3',
        ]);

        $customer_type_ = CustomerType::where('name',$request->get('name') )->first();

        $name="";$descripcion="";

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";
        if( strlen( $request->get('description') ) <4 )
            $descripcion = "errorDescription";

        if ($validator->fails() OR $name == "errorName" OR $descripcion == "errorDescription" OR $customer_type_ != null)
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre del tipo de cliente debe tener por lo menos 3 caracteres ");
            else if (  $descripcion == "errorDescription" )
                $data['errors']->add("errorDescription", "La descripcion del tipo de cliente debe tener por lo menos 3 caracteres ");
            else if( $customer_type_ != null )
                $data['errors']->add("name", "No puede registrar 2  tipos con el mismo nombre");

            return redirect('/clientes/tipos')
                ->withInput($request->all())
                ->with($data);
        }

        $customer_type = CustomerType::create([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        $customer_type->save();

        return redirect('/clientes/tipos');
    }

    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:customer_types,id'
        ]);
        $customer_type = CustomerType::find( $request->get('id') );
        $customer_type->delete();

        return redirect('/clientes/tipos');
    }

}

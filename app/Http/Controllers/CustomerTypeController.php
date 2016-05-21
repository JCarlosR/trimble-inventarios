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
            'name' => 'required|min:3|unique:customer_types',
            'description'=>'required|min:3',
        ], [
            'name.required' => 'Es necesario ingresar un nombre para el tipo de cliente.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'description.required'=> 'Es necesario ingresar una descripcion para el tipo de cliente.',
            'description.min'=> 'La descripción debe tener al menos 3 caracteres.',
            'name.unique'=> 'El tipo de cliente debe tener un nombre único.'
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        CustomerType::create([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

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

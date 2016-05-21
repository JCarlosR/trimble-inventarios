<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Provider;
use App\ProviderType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;

class ProviderTypeController extends Controller
{

    public function create()
    {
        $providerTypes = ProviderType::all();
        return view('provider_type.create')->with(compact(['providerTypes']));
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description'=>'required|min:3',
        ], [
            'name.required' => 'Es necesario ingresar un nombre para el tipo de proveedor.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'description.required'=> 'Es necesario ingresar una descripcion para el tipo de proveedor.',
            'description.min'=> 'La descripción debe tener al menos 3 caracteres.',
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        $provider_type = ProviderType::find( $request->get('id') );
        $provider_type->name = $request->get('name');
        $provider_type->description = $request->get('description');
        $provider_type->save();

        return redirect('/proveedores/tipos');
    }

    public function created( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:provider_types',
            'description'=>'required|min:3',
        ], [
            'name.required' => 'Es necesario ingresar un nombre para el tipo de proveedor.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'description.required'=> 'Es necesario ingresar una descripcion para el tipo de proveedor.',
            'description.min'=> 'La descripción debe tener al menos 3 caracteres.',
            'name.unique'=> 'El tipo de proveedor debe tener un nombre único.'
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        ProviderType::create([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        return redirect('/proveedores/tipos');
    }

    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:provider_types,id'
        ]);
        $provider = Provider::where( 'provider_type_id', $request->get('id') )->first();

        if ($validator->fails() OR $provider != null)
        {
            $data['errors'] = $validator->errors();
            if( $provider != null )
                $data['errors']->add("id", "No puede eliminar el tipo de proveedor seleccionado, porque existen proveedores asignados a ese tipo.");

            return redirect('/proveedores/tipos')
                ->withInput($request->all())
                ->with($data);
        }
        $provider_type = ProviderType::find( $request->get('id') );
        $provider_type->delete();

        return redirect('/proveedores/tipos');
    }

}

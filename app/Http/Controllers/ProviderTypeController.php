<?php

namespace App\Http\Controllers;

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
        ]);

        $provider_type = ProviderType::find( $request->get('id') );
        $provider_type->name = $request->get('name');
        $provider_type->description = $request->get('description');
        $provider_type->save();

        return redirect('/proveedores/tipos');
    }

    public function created( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description'=>'required|min:3',
        ]);

        $provider_type_ = ProviderType::where('name',$request->get('name') )->first();

        $name="";$descripcion="";

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";
        if( strlen( $request->get('description') ) <4 )
            $descripcion = "errorDescription";

        if ($validator->fails() OR $name == "errorName" OR $descripcion == "errorDescription" OR $provider_type_ != null)
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre del tipo de proveedor debe tener por lo menos 3 caracteres ");
            else if (  $descripcion == "errorDescription" )
                $data['errors']->add("errorDescription", "La descripcion del tipo de proveedor debe tener por lo menos 3 caracteres ");
            else if( $provider_type_ != null )
                $data['errors']->add("name", "No puede registrar 2  tipos con el mismo nombre");

            return redirect('/proveedores/tipos')
                ->withInput($request->all())
                ->with($data);
        }

        $provider_type = ProviderType::create([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        $provider_type->save();

        return redirect('/proveedores/tipos');
    }

    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:provider_types,id'
        ]);
        $provider_type = ProviderType::find( $request->get('id') );
        $provider_type->delete();

        return redirect('/proveedores/tipos');
    }

}

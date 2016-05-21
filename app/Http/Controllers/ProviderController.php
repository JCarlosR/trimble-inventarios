<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Output;
use App\Provider;
use App\ProviderType;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    //
    public function index()
    {
        $proveedores = Provider::all();
        $types = ProviderType::all();
        return view('provider.index')->with(compact(['proveedores', 'types']));
    }

    public function create()
    {
        $types = ProviderType::all();
        return view('provider.create')->with(compact(['types']));
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'types'=>'exists:provider_types,id',
            'address'=>'min:5',
        ], [
            'name.required' => 'Es nesecario ingresar el nombre del proveedor.',
            'name.min' => 'El nombre del proveedor debe tener 3 letras como mínimo',
            'surname.required' => 'Es necesario ingresar los apellidos del proveedor',
            'surname.min' => 'Es necesario ingresar por lo menos 3 caracteres.',
            'types.exists' => 'El tipo de proveedor no existe.',
            'address.min' => 'La dirección debe contener por lo menos 5 letras.'
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        $provider = Provider::find( $request->get('id') );
        $provider->name = $request->get('name');
        $provider->surname = $request->get('surname');
        $provider->address = $request->get('address');
        $provider->gender = $request->get('gender');
        $provider->phone = $request->get('phone');
        $provider->provider_type_id = $request->get('types');

        $provider->save();

        return redirect('proveedores');
    }

    public function store( Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:providers',
            'surname' => 'required|min:3',
            'types'=>'exists:provider_types,id',
            'address'=>'required|min:5',
        ], [
            'name.required' => 'Es nesecario ingresar el nombre del proveedor.',
            'name.min' => 'El nombre del proveedor debe tener 3 letras como mínimo',
            'name.unique' => 'El nombre del proveedor se ha repetido. Ingrese otro nuevo',
            'surname.required' => 'Es necesario ingresar los apellidos del proveedor',
            'surname.min' => 'Es necesario ingresar por lo menos 3 caracteres en el apellido.',
            'types.exists' => 'El tipo de proveedor no existe.',
            'address.min' => 'La dirección debe contener por lo menos 5 letras.',
            'address.required' => 'Es nesecario ingresar la direccion del proveedor.',
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        Provider::create([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'phone' => $request->get('phone'),
            'provider_type_id' => $request->get('types'),
        ]);

        return redirect('proveedores');

    }

    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:providers,id'
        ],[
            'id.exists' => 'El provedor no puede ser eliminado porque no existe.'
        ]);
        $provider_ = Entry::where('provider_id', $request->get('id'))->first();
        //dd($customer);
        if ($validator->fails() OR $provider_ != null)
        {
            $data['errors'] = $validator->errors();
            if( $provider_ != null )
                $data['errors']->add("id", "No puede eliminar el proveedor seleccionado, porque tiene ingresos registrados.");

            return redirect('proveedores')
                ->withInput($request->all())
                ->with($data);
        }
        $provider = Provider::find($request->get('id'));
        $provider->delete();

        return redirect('proveedores');
    }

}

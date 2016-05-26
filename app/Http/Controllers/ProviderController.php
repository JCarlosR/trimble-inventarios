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
        $proveedores = Provider::where('enable', 1)->paginate(3);
        $tipos = ProviderType::all();
        return view('provider.index')->with(compact(['proveedores', 'tipos']));
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
            'document' => 'required',
            'persona' => 'required',
            'types'=>'exists:provider_types,id',
            'address'=>'min:5',
        ], [
            'name.required' => 'Es nesecario ingresar el nombre del proveedor.',
            'name.min' => 'El nombre del proveedor debe tener 3 letras como mínimo',
            'persona.required' => 'Es necesario escojer un tipo de persona (Natural o Juridica)',
            'document.required' => 'Es necesario ingresar el numero de documento de identidad del proveedor',
            'types.exists' => 'El tipo de proveedor no existe.',
            'address.min' => 'La dirección debe contener por lo menos 5 letras.'
        ]);

        $document="";

        if($request->get('persona') == 'Natural' and strlen($request->get('document')) != 8 )
            $document="errorDocument";

        if($request->get('persona') == 'Juridica' and strlen($request->get('document')) != 11 )
            $document="errorDocument";

        if ($validator->fails() OR $document == "errorDocument")
        {
            $data['errors'] = $validator->errors();
            if( $document == "errorDocument" )
                $data['errors']->add("errorDocument", "Contradicción entre el tipo de persona(Natural y jurídica) y su número de documento ");
            return redirect('Proveedores')
                ->withInput($request->all())
                ->with($data);
        }
        
        $provider = Provider::find( $request->get('id') );
        $provider->name = $request->get('name');
        $provider->document = $request->get('document');
        $provider->address = $request->get('address');
        $provider->type = $request->get('persona');
        $provider->phone = $request->get('phone');
        $provider->provider_type_id = $request->get('types');

        $provider->save();

        return redirect('proveedores');
    }

    public function store( Request $request)
    {
        ($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:providers',
            'document' => 'required',
            'persona' => 'required',
            'types'=>'exists:provider_types,id',
            'address'=>'required|min:5',
        ], [
            'name.required' => 'Es nesecario ingresar el nombre del proveedor.',
            'name.min' => 'El nombre del proveedor debe tener 3 letras como mínimo',
            'name.unique' => 'El nombre del proveedor se ha repetido. Ingrese otro nuevo',
            'persona.required' => 'Es necesario escojer un tipo de persona (Natural o Juridica)',
            'document.required' => 'Es necesario ingresar el numero de documento de identidad del proveedor',
            'types.exists' => 'El tipo de proveedor no existe.',
            'address.min' => 'La dirección debe contener por lo menos 5 letras.',
            'address.required' => 'Es nesecario ingresar la direccion del proveedor.',
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        Provider::create([
            'name' => $request->get('name'),
            'document' => $request->get('document'),
            'address' => $request->get('address'),
            'type' => $request->get('persona'),
            'phone' => $request->get('phone'),
            'provider_type_id' => $request->get('types'),
            'enable' => 1,
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
        $provider->enable = 0;
        $provider->save();

        return redirect('proveedores');
    }

    public function back()
    {
        $proveedores = Provider::where('enable', 0)->paginate(3);
//
        //dd($proveedores);
        return view('provider.back')->with(compact(['proveedores']));
    }

    public function giveBack( Request $request )
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'exists:providers,id'
        ],[
            'id.exists' => 'El proveedor no puede ser reestablecer porque no existe.'
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        $provider = Provider::find($request->get('id'));
        $provider->enable = 1;

        $provider->save();
        return redirect('proveedores/eliminados');
    }

}

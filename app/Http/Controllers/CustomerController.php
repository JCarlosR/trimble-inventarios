<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerType;
use App\Output;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

class CustomerController extends Controller
{

    public function index()
    {
        $clientes = Customer::where('enable', 1)->paginate(3);
        //$clientes = Customer::all();
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
        dd($request->all());
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

        if($request->get('persona') == 'Natural' and strlen($request->get('document')) != 8 )
            $document="errorDocument";

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
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:customers',
            'document' => 'required',
            'persona' => 'required',
            'types'=>'exists:customer_types,id',
            'address'=>'required|min:5',
        ], [
            'name.required' => 'Es nesecario ingresar el nombre del cliente.',
            'name.min' => 'El nombre del cliente debe tener 3 letras como mínimo',
            'name.unique' => 'El nombre del cliente se ha repetido. Ingrese otro nuevo',
            'persona.required' => 'Es necesario escojer un tipo de persona (Natural o Juridica)',
            'document.required' => 'Es necesario ingresar el numero de documento de identidad del cliente',
            'type.required' => 'Es necesario indicar si es una persona natural o jurídica.',
            'types.exists' => 'El tipo de cliente no existe.',
            'address.min' => 'La dirección debe contener por lo menos 5 letras.',
            'address.required' => 'Es nesecario ingresar la direccion del cliente.',
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
            return redirect('clientes/registrar')
                ->withInput($request->all())
                ->with($data);
        }

        Customer::create([
            'name' => $request->get('name'),
            'document' => $request->get('document'),
            'address' => $request->get('address'),
            'type' => $request->get('persona'),
            'phone' => $request->get('phone'),
            'customer_type_id' => $request->get('types'),
            'enable' => 1,
        ]);

        return redirect('clientes');

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
        $validator = Validator::make($request->all(), [
            'id' => 'exists:customers,id'
        ],[
            'id.exists' => 'El cliente no puede ser eliminado porque no existe.'
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        $customer = Customer::find($request->get('id'));
        $customer->enable = 1;

        $customer->save();
        return redirect('clientes/eliminados');
    }

}

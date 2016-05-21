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
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'types'=>'exists:customer_types,id',
            'address'=>'min:5',
        ], [
            'name.required' => 'Es nesecario ingresar el nombre del cliente.',
            'name.min' => 'El nombre del cliente debe tener 3 letras como mínimo',
            'surname.required' => 'Es necesario ingresar los apellidos del cliente',
            'surname.min' => 'Es necesario ingresar por lo menos 3 caracteres.',
            'types.exists' => 'El tipo de cliente no existe.',
            'address.min' => 'La dirección debe contener por lo menos 5 letras.'
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        $customer = Customer::find( $request->get('id') );
        $customer->name = $request->get('name');
        $customer->surname = $request->get('surname');
        $customer->address = $request->get('address');
        $customer->gender = $request->get('gender');
        $customer->phone = $request->get('phone');
        $customer->customer_type_id = $request->get('types');

        $customer->save();

        return redirect('clientes');
    }

    public function store( Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:customers',
            'surname' => 'required|min:3',
            'types'=>'exists:customer_types,id',
            'address'=>'required|min:5',
        ], [
            'name.required' => 'Es nesecario ingresar el nombre del cliente.',
            'name.min' => 'El nombre del cliente debe tener 3 letras como mínimo',
            'name.unique' => 'El nombre del cliente se ha repetido. Ingrese otro nuevo',
            'surname.required' => 'Es necesario ingresar los apellidos del cliente',
            'surname.min' => 'Es necesario ingresar por lo menos 3 caracteres.',
            'types.exists' => 'El tipo de cliente no existe.',
            'address.min' => 'La dirección debe contener por lo menos 5 letras.',
            'address.required' => 'Es nesecario ingresar la direccion del cliente.',
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        Customer::create([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'phone' => $request->get('phone'),
            'comments' => $request->get('comments'),
            'customer_type_id' => $request->get('types'),
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
        $customer_ = Output::where('customer_id', $request->get('id'));
        //dd($customer);
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
        $customer->delete();

        return redirect('clientes');
    }

}

<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Output;
use Illuminate\Http\Request;

use App\Http\Requests;

class DevolutionController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customer = Customer::where('name', $request->get('customer'))->first();

            if ($customer) {
                $rentals = Output::where('reason', 'rental')
                    ->where('completed', false)
                    ->where('customer_id', $customer->id)
                    ->get();
            } else {
                $rentals = [];
            }

            return $rentals;
        }

        return view('ingreso.retorno')->with(compact('rentals'));
    }

    public function store($id)
    {
        // Total rental
        $rental = Output::find($id);

        if (! $rental) {
            return response()->json(['success' => false, 'message' => 'No existe el alquiler seleccionado']);
        }

        $rental->completed = true;
        $rental->save();

        return response()->json(['success' => true]);
    }

}

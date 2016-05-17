<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerType;
use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerController extends Controller
{

    public function index()
    {
        $clientes = Customer::all();

        return view('customer.index')->with(compact(['clientes']));
    }

    public function create()
    {
        $types = CustomerType::all();
        return view('customer.create')->with(compact(['types']));
    }

}

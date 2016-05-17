<?php

namespace App\Http\Controllers;

use App\CustomerType;
use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerTypeController extends Controller
{

    public function create()
    {
        $customerTypes = CustomerType::all();
        return view('customer_type.create')->with(compact(['customerTypes']));
    }

}

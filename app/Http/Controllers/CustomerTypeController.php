<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerTypeController extends Controller
{

    public function create()
    {
        return view('customer_type.create');
    }

}

<?php

namespace App\Http\Controllers;

use App\Provider;
use App\ProviderType;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProviderController extends Controller
{
    //
    public function index()
    {
        $proveedores = Provider::all();

        return view('provider.index')->with(compact(['proveedores']));
    }

    public function create()
    {
        $types = ProviderType::all();
        return view('provider.create')->with(compact(['types']));
    }
}

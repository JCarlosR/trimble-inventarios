<?php

namespace App\Http\Controllers;

use App\ProviderType;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProviderTypeController extends Controller
{

    public function create()
    {
        $providerTypes = ProviderType::all();
        return view('provider_type.create')->with(compact(['providerTypes']));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ModelController extends Controller
{
    public function index()
    {
        return view('product.model.index');
    }

    public function create()
    {
        return view('product.model.create');
    }
}

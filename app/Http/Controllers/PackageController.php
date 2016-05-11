<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class PackageController extends Controller
{
    public function index()
    {
        return view('package.index');
    }

    public function create()
    {
        $productos = Product::select('name')->lists('name')->toJson();

        //dd($items[2]->id);
        return view('package.create')->with(compact('productos'));
    }
}

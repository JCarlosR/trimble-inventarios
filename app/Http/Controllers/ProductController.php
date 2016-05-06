<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.product.index');
    }

    public function create()
    {
        return view('product.product.create');
    }
}
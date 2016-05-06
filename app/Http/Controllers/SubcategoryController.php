<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SubcategoryController extends Controller
{
    public function index()
    {
        return view('product.subcategory.index');
    }

    public function create()
    {
        return view('product.subcategory.create');
    }
}

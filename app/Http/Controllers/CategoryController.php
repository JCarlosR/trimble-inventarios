<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index()
    {
        return view('product.category.index');
    }

    public function create()
    {
        return view('product.category.create');
    }
}

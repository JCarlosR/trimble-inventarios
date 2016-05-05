<?php

namespace App\Http\Controllers;

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
        return view('package.create');
    }
}

<?php

namespace App\Http\Controllers;

use App\Item;
use App\Package;
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
        $products = Product::select('name')->lists('name')->toJson();

        return view('package.create')->with(compact('products'));
    }

    public function search($code)
    {
        $package = Package::where('code', $code)->first(['id', 'code']);
        return $package;
    }

    public function searchDetails($id)
    {
        $items = Item::where('package_id', $id)->with('product')->get();
        return $items;
    }

    public function items()
    {
        $items = Item::where('package_id',null)->lists('name');
        $data['products'] = $items;
        return $data;
    }
}
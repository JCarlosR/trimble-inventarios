<?php

namespace App\Http\Controllers;

use App\Item;
use App\Product;
use Illuminate\Console\Parser;
use Illuminate\Http\Request;

use App\Http\Requests;

class ItemController extends Controller
{

    public function searchItems($id)
    {
        $items = Item::where('product_id', $id)->where('state', 'available')->lists('series')->toJson();
        //dd($items);

        return $items;
    }



}

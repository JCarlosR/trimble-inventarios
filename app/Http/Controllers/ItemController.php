<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Item;

class ItemController extends Controller
{

    public function searchItems($id)
    {
        $items = Item::where('product_id', $id)->where('state', 'available')->where('package_id', null)->lists('series')->toJson();
        return $items;
    }

    public function itemsByProduct($id)
    {
        $items = Item::where('product_id', $id)->where('state', 'available')->where('package_id', null)
            ->get(['id', 'product_id', 'series', 'box_id']);
        return $items;
    }

}

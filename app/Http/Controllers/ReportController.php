<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use App\Level;

use App\Local;
use App\Product;
use App\Shelf;

use App\Package;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function getItems()
    {
        $items = Item::all();
        $locals = Local::select('name')->distinct()->get();
        return view('reports.reportItems')->with(compact('items', 'locals'));
    }
    
    public function shelves($local)
    {
        $locale = Local::where('name', $local)->first();

        $shelves = Shelf::where('local_id', $locale->id)->select('name')->get();
        //dd(response()->json($shelves));
        return response()->json($shelves);
    }

    public function levels($shelf)
    {
        $shelfe = Shelf::where('name', $shelf)->first();

        $levels = Level::where('shelf_id', $shelfe->id)->select('name')->get();
        //dd(response()->json($levels));
        return response()->json($levels);
    }
    
    public function boxes($level)
    {
        $Levele = Level::where('name', $level)->first();

        $boxes = Box::where('level_id', $Levele->id)->select('name')->get();
        //dd(response()->json($boxes));
        return response()->json($boxes);
    }

    public function items($full_name)
    {
        $boxe = Box::where('full_name', $full_name)->first();

        $items = Item::where('box_id', $boxe->id)->get();
        //dd($items);
        $array = [];
        foreach($items as $k => $item) {

            $box = Box::find($item->box_id);
            $productID = $item->product_id;
            $array[$k]['product_id'] = $productID;
            $array[$k]['state'] = $item->state;;
            $array[$k]['quantity'] = 1;
            $array[$k]['series'] = $item->series;
            $array[$k]['name'] = Product::find($productID)->name;
            $array[$k]['location'] = $box->full_name;
        }
        //dd($array);
        return $array;
    }

}
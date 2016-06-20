<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use App\Package;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('state','available')->orderBy('name', 'asc')->paginate(4);
        return view('package.index')->with(compact('packages'));
    }

    public function create()
    {
        $products = Product::select('name')->lists('name')->toJson();

        return view('package.create')->with(compact('products'));
    }

    public function store( Request $request )
    {
        $items = json_decode($request->get('items'));

        $code = $request->get('code');
        $name = $request->get('name');
        $description = $request->get('comment');

        if (sizeof($items) == 0)
        {
            return response()->json(['error' => true, 'message' => 'Es necesario agregar elementos al paquete.']);
        }

        DB::beginTransaction();

        try {
            // Create Output Header
            $package = Package::create([
                'name' => $name,
                'code' => $code,
                'description' => $description,
                'state'=>'available'
            ]);

            foreach($items as $item)
            {

                $realItem = Item::where('product_id', $item->id)->where('state', 'available')->where('series', $item->series )->first();

                if(!$realItem)
                    throw new \Exception('No se ha encontrado el item con serie ' . $item->series);
                $realItem->package_id = $package->id;
                $realItem->save();
            }

            DB::commit();
            return response()->json(['error' => false]);
            // all good
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
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

    public function locations()
    {
        $boxes = Box::all()->lists('code');
        return $boxes;
    }
}
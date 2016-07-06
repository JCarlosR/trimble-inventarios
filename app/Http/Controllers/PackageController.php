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
        $box= Box::where('full_name',$request->get('location'))->first();

        if($box == null)
            return response()->json(['error' => true, 'message' => 'La ubicación no existe']);

        $items = json_decode($request->get('items'));

        $code = $request->get('code');
        $name = $request->get('name');
        $description = $request->get('description');

        $package_name = Package::where('name',$name)->first();

        $package_code = Package::where('code',$code)->first();

        if($package_code != null)
            return response()->json(['error' => true, 'message' => 'Ya existe un paquete con ese código']);


        if($package_name != null)
            return response()->json(['error' => true, 'message' => 'Ya existe un paquete con ese nombre']);

        if (sizeof($items) == 0)
            return response()->json(['error' => true, 'message' => 'Es necesario agregar elementos al paquete.']);

        DB::beginTransaction();

        try {
            // Create Output Header
            $package = Package::create([
                'name' => $name,
                'code' => $code,
                'description' => $description,
                'state'=>'available',
                'box_id'=>$box->id
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

    public function edit(  Request $request  )
    {
        $box= Box::where('full_name',$request->get('location'))->first();

        if($box == null)
            return response()->json(['error' => true, 'message' => 'La ubicación no existe']);

        $items = json_decode($request->get('items'));

        $id = $request->get('id');
        $code = $request->get('code');
        $name = $request->get('name');
        $location = $box->id;
        $description = $request->get('description');

        $package_name = Package::where('name',$name)->first();
        $package_code = Package::where('code',$code)->first();

        if($package_code != null)
            if( $package_code->id != $id )
                return response()->json(['error' => true, 'message' => 'Ya existe un paquete con ese código']);

        if($package_name != null)
            if( $package_name->id !=  $id )
                return response()->json(['error' => true, 'message' => 'Ya existe un paquete con ese nombre']);

        if (sizeof($items) == 0)
            return response()->json(['error' => true, 'message' => 'Es necesario agregar elementos al paquete.']);

        DB::beginTransaction();
        try {

            $package = Package::find($id);
            foreach($items as $item)
            {
                $product = Product::where('name', $item->product)->first();
                $realItem = Item::where('product_id', $product->id)->where('state', 'available')->where('series', $item->series )->first();

                if(!$realItem)
                    throw new \Exception('No se ha encontrado el item con serie ' . $item->series);
            }

            $delete_items = Item::where('package_id',$package->id)->get();
            foreach( $delete_items as $delete_item )
            {
                $delete_item->package_id = null;
                $delete_item->save();
            }

            foreach( $items as $item )
            {
                $new_item = Item::where('series',$item->series)->first();
                $new_item->package_id = $package->id;
                $new_item->save();
            }

            $package->code = $code;
            $package->name = $name;
            $package->box_id = $location;
            $package->description = $description;
            $package->save();

            DB::commit();
            return response()->json(['error' => false]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

    }

    public function destroy( $id )
    {

        $items=Item::where('package_id',$id)->get();
        $package = Package::find($id);

        foreach( $items as $item )
        {
            $item->package_id = null;
            $item->save();
        }

        $package->state="low";
        $package->save();

        return response()->json(['message' => 'Paquete dado de baja correctamente']);
    }


    public function search($code)
    {
        $package = Package::where('code', $code)->first(['id', 'code']);

        // Calculate total price
        $items = Item::where('package_id', $package->id)->get();
        $package->price = 0;
        foreach ($items as $item) {
            $item_price = $item->product->price;
            $package->price += $item_price;
        }
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
        $boxes = Box::all()->lists('full_name');
        return $boxes;
    }
}
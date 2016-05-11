<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Exemplar;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ExemplarController extends Controller
{
    public function index()
    {
        $exemplars = Exemplar::all();
        return view('product.exemplar.index')->with(compact(['exemplars']));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('product.exemplar.create')->with(compact(['brands']));
    }

    public function created( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
        ]);

        $name = Exemplar::where( 'name',$request->get('name') )->first();
        $brand = Exemplar::where( 'brand_id',$request->get('brand') )->first();

        if( $name == null or  $brand == null )
        {
            $exemplar = Exemplar::create([
                'name'	  => $request->get('name'),
                'description' => $request->get('description'),
                'brand_id' => $request->get('brand')
            ]);

            $exemplar->save();
        }

        return redirect('modelo');
    }

    public function dropdown()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50'
        ]);

        $exemplar = Exemplar::find( $request->get('id') );
        $exemplar->name = $request->get('name');
        $exemplar->description = $request->get('description');
        $exemplar->brand_id = $request->get('brands');
        $exemplar->save();

        return redirect('modelo');
    }
    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:exemplars,id'
        ]);

        $exemplar = Exemplar::find( $request->get('id') );
        $exemplar->delete();

        return redirect('modelo');
    }
}
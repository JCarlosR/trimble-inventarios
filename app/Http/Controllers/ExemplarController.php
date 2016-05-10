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
        $category = Exemplar::where( 'category_id',$request->get('category') )->first();

        if( $name == null or  $category == null )
        {
            $exemplar = Exemplar::create([
                'name'	  => $request->get('name'),
                'description' => $request->get('description'),
                'brand_id' => $request->get('marca')
            ]);

            $exemplar->save();
        }

        return redirect('modelo');
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50'
        ]);

        $subcategory = Subcategory::find( $request->get('id') );
        $subcategory->name = $request->get('name');
        $subcategory->description = $request->get('description');
        $subcategory->category_id = $request->get('category');
        $subcategory->save();

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
<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;


class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view('product.subcategory.index')->with(compact(['subcategories','categories']));
    }

    public function create()
    {
        $categories = Category::all();
        return view('product.subcategory.create')->with(compact(['categories']));
    }

    public function created( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
        ]);

        $name = Subcategory::where( 'name',$request->get('name') )->first();
        $category = Subcategory::where( 'category_id',$request->get('category') )->first();

        if( $name == null or  $category == null )
        {
            $subcategory = Subcategory::create([
                'name'	  => $request->get('name'),
                'description' => $request->get('description'),
                'category_id' => $request->get('category')
            ]);
            $subcategory->save();
        }

        return redirect('subcategoria');
    }

    public function dropdown()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id'=> 'exists:subcategories,id',
            'name' => 'required|min:3|max:50'
        ]);

        $subcategory = Subcategory::find( $request->get('id') );
        $subcategory->name = $request->get('name');
        $subcategory->description = $request->get('description');
        $subcategory->category_id = $request->get('categories');

        $subcategory->save();

        return redirect('subcategoria');
    }
    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:subcategories,id'
        ]);

        $subcategory = Subcategory::find( $request->get('id') );
        $subcategory->delete();

        return redirect('subcategoria');
    }
}

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
            'name' => 'unique:subcategories|required|min:3|max:50',
        ]);

        if ($validator->fails()) {
            $data['errors'] = $validator->errors();
            return redirect('subcategoria')
                ->with($data);
        }

        $subcategory = Subcategory::create([
            'name'	  => $request->get('name'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category')
        ]);
        $subcategory->save();

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
            'name' => 'unique:subcategories|required|min:3|max:50'
        ]);

        if ($validator->fails()) {
            $data['errors'] = $validator->errors();
            return redirect('subcategoria')
                ->with($data);
        }

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

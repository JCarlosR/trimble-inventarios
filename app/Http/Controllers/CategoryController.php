<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('product.category.index')->with(compact(['categories']));
    }

    public function create()
    {
        return view('product.category.create');
    }

    public function created( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:categories|required|min:3|max:50',
        ]);

        if ($validator->fails()) {
            $data['errors'] = $validator->errors();
            return redirect('categoria')
                ->with($data);
        }

        $category = Category::create([
            'name'	  => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        $category->save();

        return redirect('categoria');
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|min:3|max:50'
        ]);

        if ($validator->fails()) {
            $data['errors'] = $validator->errors();
            return redirect('categoria')
                ->with($data);
        }

        $category = Category::find( $request->get('id') );
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->save();

        return redirect('categoria');
    }

    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            $data['errors'] = $validator->errors();
            return redirect('categoria')
                ->with($data);
        }
        $category = Category::find($request->get('id'));
        $subcategory = Subcategory::where('category_id',$request->get('id'))->first();

        if ( $subcategory != null )
            $deleted = ('Para eliminar esta categoría, tiene que eliminar las subcategorías asociadas');
        else
        {
            $category->delete();
            //$well = ('Categoría eliminada correctamente');
        }

        return redirect('categoria')->with(compact(['data']));
    }
}
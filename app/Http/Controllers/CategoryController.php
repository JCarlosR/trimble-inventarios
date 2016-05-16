<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(4);
        return view('product.category.index')->with(compact(['categories']));
    }

    public function create()
    {
        return view('product.category.create');
    }

    public function created( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        $category = Category::where( 'name',$request->get('name') )->first();
        $name="";

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";

        if ( $validator->fails() OR $name == "errorName" OR $category != null )
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre de la categoría debe tener por lo menos 3 caracteres ");
            else if( $category != null )
                $data['errors']->add("name", "No puede registrar 2  categorías con el mismo nombre");

            return redirect('categoria/registrar')
                ->withInput($request->all())
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
            'name' => 'required|max:50'
        ]);

        $category_ = Category::where('name',$request->get('name'))->first();
        $name="";$category_id  ="";$category_repeated="";

        if( $category_ != null )
        {
            $category_id = $category_->id;
            if( $category_id != $request->get('id') )
                $category_repeated = "errorRepeated";
        }

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";

        if ( $validator->fails() OR $name == "errorName" OR $category_repeated != null )
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre de la categoría debe tener por lo menos 3 caracteres ");
            else if( $category_repeated != null )
                $data['errors']->add("name", "No puede registrar 2  categoría con el mismo nombre");

            return redirect('categoria')
                ->withInput($request->all())
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

        $subcategory = Subcategory::where('category_id',$request->get('id'))->first();
        $product = Product::where('category_id',$request->get('id'))->first();

        if ($validator->fails() OR $subcategory != null OR $product != null )
        {
            $data['errors'] = $validator->errors();
            if( $subcategory != null )
                $data['errors']->add("id", "No puede eliminar la categoría seleccionada, porque existen subcategoría que dependen de ella.");
            if( $product != null )
                $data['errors']->add("id", "No puede eliminar la categoría seleccionada, porque existen productos que dependen de ella.");

            return redirect('categoria')
                ->withInput($request->all())
                ->with($data);
        }

        $category = Category::find( $request->get('id') );
        $category->delete();

        return redirect('categoria')->with(compact(['data']));
    }
}
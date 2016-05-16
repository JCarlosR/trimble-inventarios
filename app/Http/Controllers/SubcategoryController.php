<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;


class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::paginate(4);
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
            'name' => 'required|max:50',
        ]);

        $subcategory_ = Subcategory::where( 'name',$request->get('name') )->first();
        $name="";

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";

        if ( $validator->fails() OR $name == "errorName" OR $subcategory_ != null )
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre de la subcategoría debe tener por lo menos 3 caracteres ");
            else if( $subcategory_ != null )
                $data['errors']->add("name", "No puede registrar 2  subcategorías con el mismo nombre");

            return redirect('subcategoria/registrar')
                ->withInput($request->all())
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
            'name' => 'required|max:50'
        ]);

        $subcategory_ = Subcategory::where( 'name',$request->get('name') )->first();
        $name="";$subcategory_id  ="";$subcategory_repeated="";

        if( $subcategory_ != null )
        {
            $subcategory_id = $subcategory_->id;
            if( $subcategory_id != $request->get('id') )
                $subcategory_repeated = "errorRepeated";
        }

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";

        if ( $validator->fails() OR $name == "errorName" OR $subcategory_repeated != null )
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre de la subcategoría debe tener por lo menos 3 caracteres ");
            else if( $subcategory_repeated != null )
                $data['errors']->add("name", "No puede registrar 2  subcategorías con el mismo nombre");

            return redirect('subcategoria')
                ->withInput($request->all())
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

        $product = Product::where('subcategory_id',$request->get('id'))->first();

        if ($validator->fails() OR $product != null)
        {
            $data['errors'] = $validator->errors();
            if( $product != null )
                $data['errors']->add("id", "No puede eliminar la subcategoría seleccionada, porque existen productos que dependen de ella.");

            return redirect('subcategoria')
                ->withInput($request->all())
                ->with($data);
        }

        $subcategory = Subcategory::find( $request->get('id') );
        $subcategory->delete();

        return redirect('subcategoria');
    }
}

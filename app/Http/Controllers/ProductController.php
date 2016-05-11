<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Exemplar;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.product.index')->with(compact(['products']));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', '1')->get();
        $brands = Brand::all();
        $exemplars = Exemplar::where('brand_id', '1')->get();

        return view('product.product.create')->with(compact(['categories', 'subcategories', 'brands', 'exemplars']));
    }

    public function created( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'price'=>'min:0',
            'brand_id'=>'exists:brands,id',
            'exemplar_id'=>'exists:exemplars,id',
            'color'=>'required',
            'category_id'=>'exists:categories,id',
            'subcategory_id'=>'exists:subcategories,id',
        ]);

        $serie = 0;
        if ( $request->get('series') == 1)
            $serie=1;

        $product = Product::create([
            'name'	  => $request->get('name'),
            'description' => $request->get('description'),
            'price'=>$request->get('price'),
            'series'=>$serie,
            'brand_id'=>$request->get('brands'),
            'exemplar_id'=>$request->get('exemplars'),
            'part_number'=>$request->get('part_number'),
            'color'=>$request->get('color'),
            'category_id'=>$request->get('categories'),
            'subcategory_id'=>$request->get('subcategories'),
            'comment'=>$request->get('comment')
        ]);

        $product->save();

        return redirect('producto');
    }


    public function subcategoria( $categoria )
    {
        $subcategories = Subcategory::where('category_id',$categoria)->get();

        return response()->json($subcategories);

    }
    public function modelo( $marca )
    {
        $exemplares = Exemplar::where('brand_id',$marca)->get();
        return response()->json($exemplares);
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

        return redirect('subcategoria');
    }
    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:products,id'
        ]);

        $product = Product::find( $request->get('id') );
        $product->delete();

        return redirect('producto');
    }

    public function search($name)
    {
        $product = Product::where('name', $name)->first(['id', 'name', 'series']);
        return $product;
    }
}
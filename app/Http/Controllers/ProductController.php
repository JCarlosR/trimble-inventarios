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
        $marca = 1;
        $categoria = 1;

        return view('product.product.create')->with(compact(['categories', 'subcategories', 'brands', 'exemplars', 'marca', 'categoria']));
    }

    public function created()
    {

    }


    public function product($marca, $categoria)
    {
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $categoria)->get();
        $brands = Brand::all();
        $exemplars = Exemplar::where('brand_id', $marca)->get();

        return view ('product.product.create')->with(compact(['categories', 'subcategories', 'brands', 'exemplars', 'marca', 'categoria']));
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
}
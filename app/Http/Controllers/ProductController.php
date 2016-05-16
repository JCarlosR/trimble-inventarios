<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\EntryDetail;
use App\Exemplar;
use App\Item;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->paginate(4);

        return view('product.product.index')->with(compact(['products']));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('product.product.create')->with(compact(['categories', 'brands']));
    }

    public function created( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'brand_id'=>'exists:brands,id',
            'exemplar_id'=>'exists:exemplars,id',
            'category_id'=>'exists:categories,id',
            'subcategory_id'=>'exists:subcategories,id',
        ]);

        $product_ = Product::where('name',$request->get('name') )->first();

        $name="";$price="";$color="";

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";
        if( $request->get('price') <0 )
            $price = "errorPrice";
        if( strlen( $request->get('color') )<1 )
            $color = "errorColor";

        if ($validator->fails() OR $name == "errorName" OR $price == "errorPrice" OR $color == "errorColor" OR $product_ != null)
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre del producto debe tener por lo menos 3 caracteres ");
             else if (  $price == "errorPrice" )
                $data['errors']->add("price", "El precio del producto debe ser por lo menos 0 ");
            else if (  $color == "errorColor")
                $data['errors']->add("color", "Debe ingresar el color del producto");
            else if( $product_ != null )
                $data['errors']->add("name", "No puede registrar 2  productos con el mismo nombre");

            return redirect('producto/registrar')
                ->withInput($request->all())
                ->with($data);
        }

        $serie = 0;
        if ( $request->get('series') != null )
            $serie=1;

        $product = Product::create([
            'name'	  => $request->get('name'),
            'description' => $request->get('description'),
            'price'=>$request->get('price'),
            'money'=>$request->get('money'),
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
    public function categoria()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function marca()
    {
        $brands = Brand::all();
        return response()->json($brands);
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
            'name' => 'required|max:50',
            'brand_id'=>'exists:brands,id',
            'exemplar_id'=>'exists:exemplars,id',
            'category_id'=>'exists:categories,id',
            'subcategory_id'=>'exists:subcategories,id',
        ]);

        $name="";$price="";$color="";$product_repeated="";$product_id  ="";

        $product_ = Product::where('name',$request->get('name') )->first();

        if( $product_ != null )
        {
            $product_id = $product_->id;
            if( $product_id != $request->get('id') )
                $product_repeated = "errorRepeated";
        }

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";
        if( $request->get('price') <0 )
            $price = "errorPrice";
        if( strlen($request->get('color') ) <1  )
            $color = "errorColor";

        if ($validator->fails() OR $name == "errorName" OR $price == "errorPrice" OR $color == "errorColor" OR $product_repeated == "errorRepeated" )
        {
            $data['errors'] = $validator->errors();
            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre del producto debe tener por lo menos 3 caracteres ");
            else if (  $price == "errorPrice" )
                $data['errors']->add("price", "El precio del producto debe ser por lo menos 0 ");
            else if (  $color == "errorColor")
                $data['errors']->add("color", "Debe ingresar el color del producto");
            else if( $product_repeated == "errorRepeated" )
                $data['errors']->add("name", "Ya existe un producto con el mismo nombre");

            return redirect('producto')
                ->withInput($request->all())
                ->with($data);
        }

        $serie = 0;
        if ( $request->get('series') != null )
            $serie=1;

        $product = Product::find( $request->get('id') );
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->money = $request->get('money');
        $product->series = $serie;
        $product->brand_id = $request->get('brands');
        $product->exemplar_id = $request->get('exemplars');
        $product->part_number = $request->get('part_number');
        $product->color = $request->get('color');
        $product->category_id = $request->get('categories');
        $product->subcategory_id = $request->get('subcategories');
        $product->comment = $request->get('comment');

        $product->save();

        return redirect('producto');
    }
    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:products,id'
        ]);

        $entry = EntryDetail::where('product_id',$request->get('id'))->first();
        $item  = Item::where('product_id',$request->get('id'))->first();

        if ($validator->fails() OR $entry != null OR $item != null)
        {
            $data['errors'] = $validator->errors();
            if( $entry != null )
                $data['errors']->add("id", "No puede eliminar el producto seleccionado, porque existen entradas con detalles que dependen de él.");
            if( $item != null )
                $data['errors']->add("id", "No puede eliminar el producto seleccionado, porque existen existencias que dependen de él.");

            return redirect('producto')
                ->withInput($request->all())
                ->with($data);
        }

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
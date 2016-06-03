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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('state',1)->orderBy('name', 'asc')->paginate(5);

        return view('product.product.index')->with(compact('products'));
    }

    public function show_disabled()
    {
        $products = Product::where('state',0)->orderBy('name', 'asc')->paginate(5);
        return view('product.product.back')->with(compact('products'));
    }

    public function enable( Request $request)
    {
        $product = Product::find($request->get('id'));
        $product->state=1;
        $product->save();

        return redirect('producto/inactivos');
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();

        return view('product.product.create')->with(compact('categories', 'brands'));
    }

    public function store( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'brand_id'=>'exists:brands,id',
            'exemplar_id'=>'exists:exemplars,id',
            'category_id'=>'exists:categories,id',
            'subcategory_id'=>'exists:subcategories,id',
            'image'=>'image'
        ],[
            'image.image'=>'Solo se permiten imágenes'
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

        $product = Product::create([
            'name'	  => $request->get('name'),
            'description' => $request->get('description'),
            'price'=>$request->get('price'),
            'money'=>$request->get('money'),
            'brand_id'=>$request->get('brands'),
            'exemplar_id'=>$request->get('exemplars'),
            'part_number'=>$request->get('part_number'),
            'color'=>$request->get('color'),
            'category_id'=>$request->get('categories'),
            'subcategory_id'=>$request->get('subcategories'),
            'comment'=>$request->get('comment'),
            'state'=>1
        ]);

        if( $request->file('image') )
        {
            $path = public_path().'/images/products';
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $product->id . '.' . $extension;
            $request->file('image')->move($path, $fileName);
            $product->image = $fileName;
        }
        else
            $product->image = '0.png';

        $product->save();

        return redirect('producto');
    }
    public function categoria()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return response()->json($categories);
    }
    public function marca()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        return response()->json($brands);
    }

    public function subcategoria( $categoria )
    {
        $subcategories = Subcategory::where('category_id',$categoria)->orderBy('name', 'asc')->get();
        return response()->json($subcategories);
    }
    public function modelo( $marca )
    {
        $exemplares = Exemplar::where('brand_id',$marca)->orderBy('name', 'asc')->get();
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
            'image'=>'image'
        ],[
            'image.image'=>'Solo se permiten imágenes'
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

        $product = Product::find( $request->get('id') );
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->money = $request->get('money');
        $product->brand_id = $request->get('brands');
        $product->exemplar_id = $request->get('exemplars');
        $product->part_number = $request->get('part_number');
        $product->color = $request->get('color');
        $product->category_id = $request->get('categories');
        $product->subcategory_id = $request->get('subcategories');
        $product->comment = $request->get('comment');

        if( $request->file('image') )
        {
            $path = public_path().'/images/products';
            if($request->get('oldImage') !='0.png' )
                File::delete($path.'/'.$request->get('oldImage'));
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $product->id . '.' . $extension;
            $request->file('image')->move($path, $fileName);
            $product->image = $fileName;
        }

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
        $product->state = 0;
        $product->save();

        return redirect('producto');
    }

    public function search($name)
    {
        $product = Product::where('name', $name)->first(['id', 'name']);
        return $product;
    }
}
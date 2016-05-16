<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Exemplar;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(4);
        return view('product.brand.index')->with( compact('brands') );
    }

    public function create()
    {
        return view('product.brand.create');
    }

    public function created( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50'
        ]);

        $brand_ = Brand::where( 'name',$request->get('name') )->first();
        $name="";

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";

        if ( $validator->fails() OR $name == "errorName" OR $brand_ != null )
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre de la marca debe tener por lo menos 3 caracteres ");
            else if( $brand_ != null )
                $data['errors']->add("name", "No puede registrar 2  marcas con el mismo nombre");

            return redirect('marca/registrar')
                ->withInput($request->all())
                ->with($data);
        }

        $brand = Brand::create([
            'name'	  => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        $brand->save();

        return redirect('marca');
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50'
        ]);

        $brand_ = Brand::where( 'name',$request->get('name') )->first();
        $name="";$brand_id  ="";$brand_repeated="";

        if( $brand_ != null )
        {
            $brand_id = $brand_->id;
            if( $brand_id != $request->get('id') )
                $brand_repeated = "errorRepeated";
        }

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";

        if ( $validator->fails() OR $name == "errorName" OR $brand_repeated != null )
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre de la marca debe tener por lo menos 3 caracteres ");
            else if( $brand_repeated != null )
                $data['errors']->add("name", "No puede registrar 2  marcas con el mismo nombre");

            return redirect('marca')
                ->withInput($request->all())
                ->with($data);
        }

        $brand = Brand::find( $request->get('id') );
        $brand->name = $request->get('name');
        $brand->description = $request->get('description');
        $brand->save();

        return redirect('marca');
    }
    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:brands,id'
        ]);

        $exemplar = Exemplar::where('brand_id',$request->get('id'))->first();
        $product = Product::where('brand_id',$request->get('id'))->first();

        if ($validator->fails() OR $exemplar != null OR $product != null)
        {
            $data['errors'] = $validator->errors();
            if( $exemplar != null )
                $data['errors']->add("id", "No puede eliminar la marca seleccionada, porque existen modelos que dependen de ella.");
            if( $product != null )
                $data['errors']->add("id", "No puede eliminar la marca seleccionada, porque existen productos que dependen de ella.");

            return redirect('marca')
                ->withInput($request->all())
                ->with($data);
        }

        $brand = Brand::find( $request->get('id') );
        $brand->delete();

        return redirect('marca');
    }
}
<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Exemplar;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('product.brand.index')->with( compact('brands') );
        dd($brands);
    }

    public function create()
    {
        return view('product.brand.create');
    }

    public function created( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
        ]);

        $name = Brand::where('name',$request->get('name'))->first();

        if( $name == null )
        {
            $brand = Brand::create([
                'name'	  => $request->get('name'),
                'description' => $request->get('description'),
            ]);

            $brand->save();
        }

        return redirect('marca');
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50'
        ]);

        if ($validator->fails()) {
            $data['errors'] = $validator->errors();
            return redirect('producto')
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
        $brand = Brand::find( $request->get('id') );
        $exemplar = Exemplar::where('brand_id',$request->get('id'))->first();

        if ( $exemplar != null )
            $deleted = ('Para eliminar esta categoría, tiene que eliminar las modelos asociadas');
        else
        {
            $brand->delete();
            //$well = ('Categoría eliminada correctamente');
        }

        return redirect('marca');
    }
}
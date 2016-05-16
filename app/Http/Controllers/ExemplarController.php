<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Exemplar;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ExemplarController extends Controller
{
    public function index()
    {
        $exemplars = Exemplar::all();
        return view('product.exemplar.index')->with(compact(['exemplars']));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('product.exemplar.create')->with(compact(['brands']));
    }

    public function created( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        $exemplar_ = Exemplar::where( 'name',$request->get('name') )->first();
        $name="";

        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";

        if ( $validator->fails() OR $name == "errorName" OR $exemplar_ != null )
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre del modelo  debe tener por lo menos 3 caracteres ");
            else if( $exemplar_ != null )
                $data['errors']->add("name", "No puede registrar 2  modelos con el mismo nombre");

            return redirect('modelo/registrar')
                ->withInput($request->all())
                ->with($data);
        }

        $exemplar = Exemplar::create([
            'name'	  => $request->get('name'),
            'description' => $request->get('description'),
            'brand_id' => $request->get('brand')
        ]);

        $exemplar->save();

        return redirect('modelo');
    }

    public function dropdown()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50'
        ]);

        $exemplar_ = Exemplar::where( 'name',$request->get('name') )->first();
        $name="";$exemplar_id  ="";$exemplar_repeated="";

        if( $exemplar_ != null )
        {
            $exemplar_id = $exemplar_->id;
            if( $exemplar_id != $request->get('id') )
                $exemplar_repeated = "errorRepeated";
        }
        if( strlen( $request->get('name') ) <4 )
            $name = "errorName";

        if ( $validator->fails() OR $name == "errorName" OR $exemplar_repeated != null )
        {
            $data['errors'] = $validator->errors();

            if( $name == "errorName" )
                $data['errors']->add("name", "El nombre del modelo debe tener por lo menos 3 caracteres ");
            else if( $exemplar_repeated != null )
                $data['errors']->add("name", "No puede registrar 2  modelos con el mismo nombre");

            return redirect('modelo')
                ->withInput($request->all())
                ->with($data);
        }

        $exemplar = Exemplar::find( $request->get('id') );
        $exemplar->name = $request->get('name');
        $exemplar->description = $request->get('description');
        $exemplar->brand_id = $request->get('brands');
        $exemplar->save();

        return redirect('modelo');
    }
    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:exemplars,id'
        ]);

        $product = Product::where('exemplar_id',$request->get('id'))->first();

        if ($validator->fails() OR $product != null)
        {
            $data['errors'] = $validator->errors();
            if( $product != null )
                $data['errors']->add("id", "No puede eliminar el modelo seleccionada, porque existen productos que dependen de él.");

            return redirect('modelo')
                ->withInput($request->all())
                ->with($data);
        }

        $exemplar = Exemplar::find( $request->get('id') );
        $exemplar->delete();

        return redirect('modelo');
    }
}
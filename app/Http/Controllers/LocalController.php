<?php

namespace App\Http\Controllers;

use App\Local;
use App\Shelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;

class LocalController extends Controller
{
    public function index()
    {
        $locals = Local::orderBy('name', 'asc')->paginate(5);
        return view('location.local.index')->with(compact(['locals']));
    }

    public function create()
    {
        return view('location.local.create');
    }

    public function store( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:locals'
        ],[
            'name.unique' => 'Ya existe un local registrado con ese nombre',
            'name.required' => 'Es necesario ingresar el nombre del local.',
        ]);

        if ( $validator->fails() )
        {
            $data['errors'] = $validator->errors();
            return redirect('local/registrar')
                ->withInput($request->all())
                ->with($data);
        }

        $local = Local::create([
            'name'	  => $request->get('name'),
            'comment' => $request->get('comment'),
            'type'    => $request->get('type')
        ]);
        $local->save();

        return redirect('local');
    }

    public function edit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'],[
            'name.required' => 'Es nesecario ingresar el nombre del local.',
        ]);

        $local = Local::where('name',$request->get('name'))->first();
        $local_id = 0; $local_repeated = "";

        if( $local != null )
        {
            $local_id = $local->id;
            if( $local_id != $request->get('id') )
                $local_repeated = "errorRepeated";
        }

        if ( $validator->fails() OR $local_repeated == "errorRepeated")
        {
            $data['errors'] = $validator->errors();

            if( $local_repeated == "errorRepeated" )
                $data['errors']->add("name", "No puede registrar 2  locales con el mismo nombre");

            return redirect('local')
                ->withInput($request->all())
                ->with($data);
        }

        $local = Local::find( $request->get('id') );
        $local->name = $request->get('name');
        $local->comment = $request->get('comment');
        $local->type = $request->get('type');
        $local->save();

        return redirect('local');
    }

    public function delete( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:locals,id'
        ]);

        $shelf = Shelf::where('local_id',$request->get('id'))->first();

        if ($validator->fails() OR $shelf != null )
        {
            $data['errors'] = $validator->errors();
            if( $shelf != null )
                $data['errors']->add("id", "No puede eliminar el local seleccionado, porque existen anaqueles asociados.");
            return redirect('local')
                ->withInput($request->all())
                ->with($data);
        }

        $local = Local::find( $request->get('id') );
        $local->delete();

        return redirect('local');
    }
}

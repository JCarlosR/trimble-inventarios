<?php

namespace App\Http\Controllers;

use App\Level;
use App\Local;
use App\Shelf;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ShelfController extends Controller
{
    public function index( $local )
    {
        $shelves = Shelf::where('local_id',$local)->orderBy('name', 'asc')->paginate(5);
        $place   = Local::where('id',$local)->first();
        return view('location.shelf.index')->with(compact(['shelves','local','place']));
    }

    public function create(  $local )
    {
        return view('location.shelf.create')->with(compact(['local']));
    }

    public function store( Request $request, $local )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ],[
            'name.required' => 'Es necesario ingresar el nombre del anaquel.',
        ]);

        $shelf = Shelf::where( 'local_id',$local )->where('name',$request->get('name'))->first();
        $shelf_repeated = "";

        if( $shelf != null )
            $shelf_repeated = "errorRepeated";

        if ( $validator->fails() OR $shelf_repeated == "errorRepeated" )
        {
            $data['errors'] = $validator->errors();

            if( $shelf_repeated == "errorRepeated" )
                $data['errors']->add("name", "Ya existe un anaquel registrado con ese nombre");

            $data['errors'] = $validator->errors();
            return redirect('anaquel/registrar/'.$local)
                ->withInput($request->all())
                ->with($data);
        }

        $shelf = Shelf::create([
            'name'	   => $request->get('name'),
            'comment'  => $request->get('comment'),
            'local_id' => $local
        ]);
        $shelf->save();

        return redirect('anaquel/'.$local);
    }

    public function edit( Request $request, $local )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'],[
            'name.required' => 'Es nesecario ingresar el nombre del anaquel.',
        ]);

        $shelf = Shelf::where( 'local_id',$local )->where( 'name',$request->get('name') )->first();
        $shelf_repeated = "";

        if( $shelf != null)
            if( $shelf->id != $request->get('id') )
                $shelf_repeated = "errorRepeated";

        if ( $validator->fails() OR $shelf_repeated == "errorRepeated")
        {
            $data['errors'] = $validator->errors();

            if( $shelf_repeated == "errorRepeated" )
                $data['errors']->add("name", "Ya existe un anaquel registrado con ese nombre, en este local");

            return redirect('anaquel/'.$local)
                ->withInput($request->all())
                ->with($data);
        }

        $shelf = Shelf::find( $request->get('id') );
        $shelf->name = $request->get('name');
        $shelf->comment = $request->get('comment');
        $shelf->save();

        return redirect('anaquel/'.$local);
    }

    public function delete( Request $request, $local )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:shelves,id'
        ]);

        $level = Level::where('shelf_id',$request->get('id'))->first();

        if ($validator->fails() OR $level != null )
        {
            $data['errors'] = $validator->errors();
            if( $level != null )
                $data['errors']->add("id", "No puede eliminar el anaquel seleccionado, porque existen niveles asociados.");
            return redirect('anaquel/'.$local)
                ->withInput($request->all())
                ->with($data);
        }

        $shelf = Shelf::find( $request->get('id') );
        $shelf->delete();

        return redirect('anaquel/'.$local);
    }
}
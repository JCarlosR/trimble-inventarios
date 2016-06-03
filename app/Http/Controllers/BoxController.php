<?php

namespace App\Http\Controllers;

use App\Box;
use App\Level;
use Illuminate\Http\Request;

use App\Http\Requests;

class BoxController extends Controller
{
    public function index( $level, $shelf, $local )
    {
        $boxes = Box::where('level_id',$level)->orderBy('name', 'asc')->paginate(5);
        $place  = Level::where('id',$level)->first();
        return view('location.box.index')->with(compact('boxes','place','level','shelf','local'));
    }

    public function create(  $level, $shelf, $local )
    {
        return view('location.box.create')->with(compact('level','shelf','local'));
    }

    public function store( Request $request, $level,  $shelf, $local )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ],[
            'name.required' => 'Es necesario ingresar el nombre del nivel.',
        ]);

        $level = Level::where( 'shelf_id',$shelf )->where( 'name',$request->get('name') )->first();
        $level_repeated = "";

        if( $level != null )
            $level_repeated = "errorRepeated";

        if ( $validator->fails() OR $level_repeated == "errorRepeated" )
        {
            $data['errors'] = $validator->errors();

            if( $level_repeated == "errorRepeated" )
                $data['errors']->add("name", "Ya existe un nivel registrado con ese nombre");

            $data['errors'] = $validator->errors();
            return redirect('nivel/registrar/'.$shelf.'/'.$local)
                ->withInput($request->all())
                ->with($data);
        }

        $level = Level::create([
            'name'	   => $request->get('name'),
            'comment'  => $request->get('comment'),
            'shelf_id' => $local
        ]);
        $level->save();

        return redirect('nivel/'.$shelf.'/'.$local);
    }

    public function edit( Request $request, $shelf , $local )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'],[
            'name.required' => 'Es nesecario ingresar el nombre del anaquel.',
        ]);

        $level = Level::where( 'shelf_id',$shelf )->where( 'name',$request->get('name') )->first();
        $level_repeated = "";

        if( $level != null )
            if( $level->id != $request->get('id') )
                $level_repeated = "errorRepeated";

        if ( $validator->fails() OR $level_repeated == "errorRepeated")
        {
            $data['errors'] = $validator->errors();

            if( $level_repeated == "errorRepeated" )
                $data['errors']->add("name", "Ya existe un anaquel registrado con ese nombre, en este local");

            return redirect('nivel/'.$shelf.'/'.$local)
                ->withInput($request->all())
                ->with($data);
        }

        $level = Level::find( $request->get('id') );
        $level->name = $request->get('name');
        $level->comment = $request->get('comment');
        $level->save();

        return redirect('nivel/'.$shelf.'/'.$local);
    }

    public function delete( Request $request, $shelf, $local )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:shelves,id'
        ]);

        $box = Box::where('level_id',$request->get('id'))->first();

        if ($validator->fails() OR $box != null )
        {
            $data['errors'] = $validator->errors();
            if( $box != null )
                $data['errors']->add("id", "No puede eliminar el nivel seleccionado, porque existen cajas asociadas.");
            return redirect('nivel/'.$shelf.'/'.$local)
                ->withInput($request->all())
                ->with($data);
        }

        $level = Level::find( $request->get('id') );
        $level->delete();

        return redirect('nivel/'.$shelf.'/'.$local);
    }
}

<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use App\Level;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

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
            'name.required' => 'Es necesario ingresar el nombre de la caja.',
        ]);

        $box = Box ::where( 'level_id',$level )->where( 'name',$request->get('name') )->first();
        $box_repeated = "";

        if( $box != null )
            $box_repeated = "errorRepeated";

        if ( $validator->fails() OR $box_repeated == "errorRepeated" )
        {
            $data['errors'] = $validator->errors();

            if( $box_repeated == "errorRepeated" )
                $data['errors']->add("name", "Ya existe una caja registrada con ese nombre");

            $data['errors'] = $validator->errors();
            return redirect('caja/registrar/'.$level.'/'.$shelf.'/'.$local)
                ->withInput($request->all())
                ->with($data);
        }

        $box = Box::create([
            'name'	   => $request->get('name'),
            'comment'  => $request->get('comment'),
            'level_id' => $level
        ]);
        $box->save();

        return redirect('caja/'.$level.'/'.$shelf.'/'.$local);
    }

    public function edit( Request $request, $level, $shelf, $local )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'],[
            'name.required' => 'Es necesario ingresar el nombre de la caja.',
        ]);

        $box = Box::where( 'level_id',$level )->where( 'name',$request->get('name') )->first();
        $box_repeated = "";

        if( $box != null )
            if( $box->id != $request->get('id') )
                $box_repeated = "errorRepeated";

        if ( $validator->fails() OR $box_repeated == "errorRepeated")
        {
            $data['errors'] = $validator->errors();

            if( $box_repeated == "errorRepeated" )
                $data['errors']->add("name", "Ya existe una caja registrado con ese nombre, en este nivel");

            return redirect('caja/'.$level.'/'.$shelf.'/'.$local)
                ->withInput($request->all())
                ->with($data);
        }

        $box = Box::find( $request->get('id') );
        $box->name = $request->get('name');
        $box->comment = $request->get('comment');
        $box->save();

        return redirect('caja/'.$level.'/'.$shelf.'/'.$local);
    }

    public function delete( Request $request, $level, $shelf, $local )
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:boxes,id'
        ]);

        $item = Item::where('box_id',$request->get('id'))->first();

        if ($validator->fails() OR $item != null )
        {
            $data['errors'] = $validator->errors();
            if( $item != null )
                $data['errors']->add("id", "No puede eliminar la caja seleccionada, porque existen productos en ella.");
            return redirect('caja/'.$level.'/'.$shelf.'/'.$local)
                ->withInput($request->all())
                ->with($data);
        }

        $box = Box::find( $request->get('id') );
        $box->delete();

        return redirect('caja/'.$level.'/'.$shelf.'/'.$local);
    }

    public function location ( $box, $level, $shelf, $local )
    {
        $items = Item::where('box_id',$box)->paginate(5);
        $place  = Box::where('id',$box)->first();

        return view('location.box.location')->with(compact('items','place','box','level','shelf','local'));
    }
}
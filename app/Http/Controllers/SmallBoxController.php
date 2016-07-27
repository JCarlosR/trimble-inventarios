<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use App\Level;

use App\Local;
use App\Shelf;

use App\Package;

use App\SmallBox;
use App\SmallBoxBalance;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class SmallBoxController extends Controller
{
    public function index()
    {
        $carbon = new Carbon();
        $date = $carbon->now();
        $date = $date->format('Y-m-d');
        return view('smallBox.smallBox')->with(compact('date'));
    }

    public function store( Request $request )
    {
        $dt = Carbon::parse($request->get('date'));
        $anio = ($dt->year);
        $mes = $dt->month;

        if ($request->get('concept') == null OR $request->get('concept') == "")
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar el concepto a la caja chica']);

        if ($request->get('amount') == null OR $request->get('amount') == "")
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar el importe del concepto a la caja chica']);

        if ( strlen($request->get('concept'))<4 )
            return response()->json(['error' => true, 'message' => 'La descripción del concepto debe tener como mínimo 3 caracteres']);

        $asignacion=""; $balance=""; $input="";
        
        if ($request->get('type') != 'assign')
        {

            $assign = SmallBox::whereYear('created_at', '=', $anio)->whereMonth('created_at', '=', $mes)->where('type', 'assign')->first();

            if( $assign == null )
            {
                $asignacion = 'errorAsignacion';
            }
        }

        if ($request->get('type') == 'assign')
        {

            $assign2 = SmallBox::whereYear('created_at', '=', $anio)->whereMonth('created_at', '=', $mes)->where('type', 'assign')->first();

            if( $assign2 != null )
            {
                $input = 'errorInput';
            }
        }

        if ($request->get('type') == 'output')
        {
            $lastBalance = SmallBoxBalance::orderBy('updated_at', 'desc')->first();
            if ( $lastBalance->balance < $request->get('amount') )
                $balance = 'errorBalance';
        }

        if( $asignacion == "errorAsignacion" )
            return response()->json(['error' => true, 'message' => 'No existe una asignación para el presente mes, debe asignar pronto.']);

        if( $input == "errorInput" )
            return response()->json(['error' => true, 'message' => 'Ya existe una asignacion para el presente mes, mejor realice un ingreso.']);

        if( $balance == "errorBalance" )
            return response()->json(['error' => true, 'message' => 'No queda crédito en la caja chica, proceda a realizar un ingreso.']);

        // If type is assign, you should create new row in SmallBoxBalance, adding th last row registered
        // Then insert new row in SmallBox
        // Else insert new row in SmallBox then update the last row in SmallBoxBalance

        if ($request->get('type') == 'assign')
        {
            $smallBoxBalance = SmallBoxBalance::create([
                'balance' => $request->get('amount')
            ]);
            $smallBoxBalance->save();

            $smallBox = SmallBox::create([
                'concept' => $request->get('concept'),
                'type' => $request->get('type'),
                'amount' => $request->get('amount'),
                'enable' => '1'
            ]);
            if( $request->file('voucher') )
            {
                $path = public_path().'/smallBox/docs';

                $extension = $request->file('voucher')->getClientOriginalExtension();
                $fileName = $smallBox->id . '.' . $extension;
                $request->file('voucher')->move($path, $fileName);
                $smallBox->voucher = $fileName;
            }
            $smallBox->save();
        }else{
            if ($request->get('type') == 'input')
            {
                $smallBox = SmallBox::create([
                    'concept' => $request->get('concept'),
                    'type' => $request->get('type'),
                    'amount' => $request->get('amount'),
                    'enable' => '1'
                ]);
                if( $request->file('voucher') )
                {
                    $path = public_path().'/smallBox/docs';

                    $extension = $request->file('voucher')->getClientOriginalExtension();
                    $fileName = $smallBox->id . '.' . $extension;
                    $request->file('voucher')->move($path, $fileName);
                    $smallBox->voucher = $fileName;
                }
                $smallBox->save();
                $lastBalance = SmallBoxBalance::orderBy('updated_at', 'desc')->first();
                $newBalance = $lastBalance->balance + $request->get('amount');
                //dd($newBalance);
                $lastBalance->balance = $newBalance;
                $lastBalance->save();
                
            }else{
                $smallBox = SmallBox::create([
                    'concept' => $request->get('concept'),
                    'type' => $request->get('type'),
                    'amount' => $request->get('amount'),
                    'enable' => '1'
                ]);
                if( $request->file('voucher') )
                {
                    $path = public_path().'/smallBox/docs';

                    $extension = $request->file('voucher')->getClientOriginalExtension();
                    $fileName = $smallBox->id . '.' . $extension;
                    $request->file('voucher')->move($path, $fileName);
                    $smallBox->voucher = $fileName;
                }
                $smallBox->save();
                $lastBalance = SmallBoxBalance::orderBy('updated_at', 'desc')->first();
                $newBalance = $lastBalance->balance - $request->get('amount');
                //var_dump($newBalance);
                $lastBalance->balance = $newBalance;
                $lastBalance->save();
            }
        }
        return response()->json(['error' => false, 'message' => 'Concepto registrado correctamente.']);
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

        $nameLocal=Local::find($local)->get('name');
        $nameShelf=Shelf::find($shelf)->get('name');
        $nameLevel=Level::find($level)->get('name');
        $nameBox = $request->get('name');

        $fullName = $nameLocal.'-'.$nameShelf.'-'.$nameLevel.'-'.$nameBox;

        $box = Box::find( $request->get('id') );
        $box->name = $request->get('name');
        $box->comment = $request->get('comment');
        $box->full_name = $fullName;
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
        $items = Item::where('state','available')->where('box_id',$box)->paginate(4);
        $place  = Box::where('id',$box)->first();
        $packages = Package::where('state','available')->where('box_id',$box)->paginate(2);

        return view('location.box.location')->with(compact('items','packages','place','box','level','shelf','local'));
    }
}
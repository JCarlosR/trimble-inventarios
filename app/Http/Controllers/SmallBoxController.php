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
use Maatwebsite\Excel\Facades\Excel;

class SmallBoxController extends Controller
{
    public function index()
    {
        $carbon = new Carbon();
        $date = $carbon->now();
        $date = $date->format('Y-m-d');
        return view('smallBox.smallBox')->with(compact('date'));
    }

    public function listar()
    {
        $carbon = new Carbon();
        $date = $carbon->now();
        $year = ($date->year);
        $month = $date->month;
        $date = $date->format('Y-m-d');
        $assignmes = SmallBox::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('type','=','assign')->first();
        if($assignmes) {
            $nextassign = SmallBox::where('type', '=', 'assign')->where('id', '>', $assignmes->id)->first();
            if ($nextassign)
                $conceptos = SmallBox::where('id', '>', $assignmes->id)->where('id', '<', $nextassign->id)->where('type', '<>', 'assign')->get();
            else
                $conceptos = SmallBox::where('id', '>', $assignmes->id)->where('type', '<>', 'assign')->get();
        }
        return view('smallBox.listar')->with(compact('date','conceptos','assignmes'));
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

    public function getMonthName($month)
    {
        switch ($month) {
            case 1: return 'Enero';
            case 2: return 'Febrero';
            case 3: return 'Marzo';
            case 4: return 'Abril';
            case 5: return 'Mayo';
            case 6: return 'Junio';
            case 7: return 'Julio';
            case 8: return 'Agosto';
            case 9: return 'Setiembre';
            case 10: return 'Octubre';
            case 11: return 'Noviembre';
            case 12: return 'Diciembre';
        }

        return '';
    }

    public function excel(Request $request)
    {
        $year = $request->get('year');
        $month = $request->get('month');
        // $from = Carbon::create($year, $month, 1);
        // $to = $from->modify('last day of this month');

        $movements_collection = SmallBox::whereMonth('created_at', '=', $month)
                                ->whereYear('created_at', '=', $year)->get();
        $movements = [];
        $i = 0;
        $remains = 0;
        foreach ($movements_collection as $movement) {
            $row = [];
            $row[] = $i++;
            $row[] = $movement->created_at->format('d/m/Y h:i A');
            $row[] = $movement->concept;
            if ($movement->type == 'output') {
                $income = '';
                $expenses = $movement->amount;
                $remains -= $expenses;
            } else {
                $income = $movement->amount;
                $expenses = '';
                $remains += $income;
            }
            $row[] = $income;
            $row[] = $expenses;
            $row[] = $remains;
            $movements[] = $row;
        }
        // dd($movements);

        // Generate an Excel file with the movements in the selected month
        $monthName = $this->getMonthName($month);
        $title = 'CAJA CHICA - ' . strtoupper($monthName) . ' ' . $year;
        Excel::create($title, function($excel) use($movements, $title, $monthName) {

            $excel->sheet('Mes ' . $monthName, function($sheet) use($movements, $title, $monthName) {

                // First row styling
                $sheet->mergeCells('A1:F1');
                $sheet->row(1, function ($row) {
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                $sheet->row(1, [$title]);

                // Second row (headers)
                $sheet->row(2, function ($row) {
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                $sheet->row(2, ['Nro', 'Día', 'Concepto', 'Ingresos', 'Egresos', 'A favor']);

                // Items data
                foreach ($movements as $movement) {
                    $sheet->appendRow($movement);
                }

            });

        })->export('xls');
    }

    public function pdf(Request $request)
    {
        $year = $request->get('year');
        $month = $request->get('month');

        $movements_collection = SmallBox::whereMonth('created_at', '=', $month)
                                ->whereYear('created_at', '=', $year)->get();

        $movements = [];
        $i = 0;
        $remains = 0;
        foreach ($movements_collection as $movement) {
            $row = [];
            $row[] = $i++;
            $row[] = $movement->created_at->format('d/m/Y h:i A');
            $row[] = $movement->concept;
            if ($movement->type == 'output') {
                $income = '';
                $expenses = $movement->amount;
                $remains -= $expenses;
            } else {
                $income = $movement->amount;
                $expenses = '';
                $remains += $income;
            }
            $row[] = $income;
            $row[] = $expenses;
            $row[] = $remains;
            $movements[] = $row;
        }

        $monthName = $this->getMonthName($month);

        // return view('smallBox.pdf', compact('movements', 'monthName', 'year'));

        $vista =  view('smallBox.pdf', compact('movements', 'monthName', 'year'))->render();
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($vista);
        return $pdf->download();
    }


    public function editrow(Request $request)
    {
        $id = $request->get('id');
        $concept = $request->get('concepto');
        $amount = $request->get('monto');

        if($id == null OR $id == "")
            return response()->json(['error' => true, 'message' => 'Ha ocurrido un error inesperado. Actualice y vuelva a intentar.']);
        if ($concept == null OR $concept == "")
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar el concepto a la caja chica']);
        if ($amount == null OR $amount == "")
            return response()->json(['error' => true, 'message' => 'Es necesario ingresar el importe del concepto a la caja chica']);

        $box = SmallBox::find( $id );
        $box->concept = $concept;
        $box->amount = $amount;
        $box->save();

        return response()->json(['error' => false, 'message' => 'Concepto editado correctamente.']);
    }
}
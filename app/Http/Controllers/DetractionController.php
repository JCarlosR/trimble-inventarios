<?php

namespace App\Http\Controllers;

use App\Detraction;
use App\Output;
use Illuminate\Http\Request;

use App\Http\Requests;

class DetractionController extends Controller
{
    public function getDetraction($id) {
        return Output::find($id)->detraction;
    }

    public function postDetraction(Request $request) {
        $data['success'] = true;

        $output_id = $request->get('id');
        $detraction_value = $request->get('detraction');
        $detraction_date = $request->get('detraction_date');
        $voucher = $request->get('voucher');

        if ($detraction_value < 0) {
            $data['success'] = false;
            $data['message'] = 'Ingrese un valor positivo o CERO para anular.';
        }

        $output = Output::find($output_id);
        if (! $output) {
            $data['success'] = false;
            $data['message'] = 'La salida seleccionada no existe en la base de datos.';
        }
        $detraction = $output->detraction;

        if ($detraction_value == 0 ) {
            if ($detraction)
                $detraction->delete();

            return $data;
        }

        if (!$detraction) {
            $detraction = new Detraction();
        }
        $detraction->output_id = $output_id;
        $detraction->value = $detraction_value;
        $detraction->detraction_date = $detraction_date;
        $detraction->voucher = $voucher;
        $detraction->save();

        return $data;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Item;
use App\Product;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{

    public function searchItems($id)
    {
        $items = Item::where('product_id', $id)->where('state', 'available')->where('package_id', null)->lists('series')->toJson();
        return $items;
    }

    public function itemsByProduct($id)
    {
        $items = Item::where('product_id', $id)->where('state', 'available')->where('package_id', null)
            ->get(['id', 'product_id', 'series', 'box_id']);
        return $items;
    }

    public function excelByProduct($id)
    {
        // Selected product
        $product = Product::find($id);

        // Items query
        $items = Item::where('product_id', $id)->where('state', '<>', 'low')->where('package_id', null)
            ->orderBy('state', 'desc')->get();

        // Take ['series', 'state', 'created_at', 'current_location']

        $items = $items->toArray();
        foreach ($items as $i => $item) {
            unset($items[$i]['id']);
            unset($items[$i]['product_id']);
            unset($items[$i]['box_id']);
            unset($items[$i]['package_id']);
            unset($items[$i]['product_name']);
            unset($items[$i]['product']);
            unset($items[$i]['box']);
        }

        // Generate an Excel file with available items
        $fileName = 'Trimble - ' . $product->name;
        Excel::create($fileName, function($excel) use ($items) {

            $excel->sheet('Existencias', function($sheet) use ($items) {

                // First row styling
                $sheet->mergeCells('A1:E1');
                $sheet->row(1, function ($row) {
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                $sheet->row(1, ['Reporte de existencias']);

                // Second row styling (headers)
                $sheet->row(2, function ($row) {
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                $sheet->row(2, ['Código', 'Estado', 'Fecha (Registro)', 'Fecha (Actualización)', 'Ubicación']);

                // Items data
                foreach ($items as $item) {
                    $sheet->appendRow($item);
                }

            });

        })->export('xls');
    }

}

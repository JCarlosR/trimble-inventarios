<?php

namespace App\Http\Controllers;

use App\Product;
use App\Provider;
use App\PurchaseOrder;
use Illuminate\Http\Request;

use App\Http\Requests;

class EntryByOrderController extends Controller
{
    public function create($purchase_order_id)
    {
        // Purchase order to be processed
        $purchase_order = PurchaseOrder::pending()->find($purchase_order_id);

        if (! $purchase_order)
            return redirect('/ingreso/listar/orden_compra');

        // Required data to render the view
        $productos = Product::select('name')->lists('name')->toJson();
        $proveedores = Provider::select('name')->lists('name')->toJson();

        return view('entry_by_order.create')->with(compact(
            'proveedores', 'productos',
            'purchase_order'
        ));
    }
}

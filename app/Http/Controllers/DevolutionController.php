<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Devolution;
use App\Http\Requests;
use App\Item;
use App\Output;
use App\OutputDetail;
use App\OutputPackage;
use App\Package;
use Illuminate\Http\Request;

class DevolutionController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customer = Customer::where('name', $request->get('customer'))->first();

            if ($customer) {
                $start = $request->get('start');
                $end = $request->get('end');
                $rentals = Output::where('reason', 'rental')
                    ->where('completed', false)
                    ->where('customer_id', $customer->id)
                    ->whereBetween('fechaAlquiler', [$start, $end])
                    ->get();
            } else {
                $rentals = [];
            }

            return $rentals;
        }

        return view('ingreso.retorno')->with(compact('rentals'));
    }

    public function store($id)
    {
        // Total devolution
        $rental = Output::find($id);

        if (! $rental) {
            return response()->json(['success' => false, 'message' => 'No existe el alquiler seleccionado']);
        }

        $rental->completed = true;
        $rental->save();

        return response()->json(['success' => true]);
    }

    public function partial(Request $request)
    {
        // Partial devolution
        $output_id = $request->get('output_id');
        $output = Output::find($output_id);
        $items = $request->get('items');
        $packages = $request->get('packages');

        // To avoid problems with foreach
        if ($items==null) $items = [];
        if ($packages==null) $packages = [];

        // Save items returned
        foreach ($items as $item) {
            $item = Item::where('series', $item)->first();
            $outputDetail = OutputDetail::where('output_id', $output_id)->where('item_id', $item->id)->first();
            Devolution::create([
                'output_detail_id' => $outputDetail->id
            ]);
        }
        // Save packages returned
        foreach ($packages as $package) {
            $package = Package::where('name', $package)->first();
            $outputPackage = OutputPackage::where('output_id', $output_id)->where('package_id', $package->id)->first();
            Devolution::create([
                'output_package_id' => $outputPackage->id
            ]);
        }

        // Verify if this rental is completed
        $allReturned = true;
        $outputItems = $output->items;
        $outputPackages = $output->packages;
        foreach ($outputItems as $outputItem) {
            $devolution = $outputItem->devolution;
            if ($devolution == null) {
                $allReturned = false;
                break;
            }
        }
        foreach ($outputPackages as $outputPackage) {
            $devolution = $outputPackage->devolution;
            if ($devolution == null) {
                $allReturned = false;
                break;
            }
        }

        if ($allReturned) {
            $notif = 'Se han devuelto todos los productos y paquetes prestados.';
            $output->completed = true;
            $output->save();
        } else
            $notif = 'Se devolvieron '.sizeof($items).' productos y '.sizeof($packages).' paquetes.';

        return back()->with('notif', $notif);
    }

    public function details($id)
    {
        $items = OutputDetail::where('output_id', $id)->with('item')->get();
        $packages = OutputPackage::where('output_id', $id)->with('package')->get();

        $data['items'] = $items;
        $data['packages'] = $packages;

        return $data;
    }

}

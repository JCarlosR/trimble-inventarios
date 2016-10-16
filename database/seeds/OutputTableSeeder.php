<?php

use App\Output;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OutputsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = new Carbon();

        Output::create([
            'customer_id' => 1,
            'invoice' => '1000001',
            'user_id' => 2,
            'type_doc' => 'F',
            'invoice_date' => $carbon->now(),
            'type' => 'L',
            'igv' => 54.00,
            'total' => 354.00,
            'shipping' => 100.00,
            'state' => 1,
            'currency' => 'PEN',
            'comment' => 'Venta de prueba',
            'reason' => 'sale'
        ]);

        Output::create([
            'customer_id' => 1,
            'invoice' => '1000002',
            'type_doc' => 'F',
            'user_id' => 2,
            'invoice_date' => $carbon->now(),
            'type' => 'L',
            'currency' => 'USD',
            'igv' => 72.00,
            'total' => 472.00,
            'shipping' => 100.00,
            'comment' => 'Alquiler de prueba',
            'reason' => 'rental',
            'fechaAlquiler' => $carbon->now(),
            'state' => 1,
            'fechaRetorno' => $carbon->now()->addDays(5),
            'destination' => 'Cajamarca'
        ]);
    }

}

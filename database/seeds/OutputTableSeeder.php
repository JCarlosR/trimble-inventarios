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
            'igv' => 0.00,
            'total' => 35.20,
            'shipping' => 0.00,
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
            'igv' => 0.00,
            'total' => 20,
            'shipping' => 0.00,
            'comment' => 'Alquiler de prueba',
            'reason' => 'rental',
            'fechaAlquiler' => $carbon->now(),
            'state' => 1,
            'fechaRetorno' => $carbon->now()->addDays(5),
            'destination' => 'Cajamarca'
        ]);
    }

}

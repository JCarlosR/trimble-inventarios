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
            'customer_id' => 2,
            'user_id' => 2,
            'reason' => 'sale',
            'type' => 'L',
            'currency' => 'PEN',
            'igv' => 196.85,
            'total' => 1290.45,
            'shipping' => 100.00,
            'state' => 1,
            'invoice' => '000098',
            'type_doc' => 'F',
            'invoice_date' => $carbon->now(),
        ]);

        Output::create([
            'customer_id' => 2,
            'user_id' => 2,
            'reason' => 'rental',
            'type' => 'L',
            'currency' => 'PEN',
            'igv' => 127.80,
            'total' => 837.80,
            'shipping' => 150.00,
            'state' => 1,
            'invoice' => '000025',
            'type_doc' => 'F',
            'invoice_date' => $carbon->now(),
            'fechaAlquiler' => $carbon->now(),
            'fechaRetorno' => $carbon->now()->addDays(5),
            'destination' => 'Cajamarca',
            'comment' => 'Alquiler de prueba'

        ]);
    }

}

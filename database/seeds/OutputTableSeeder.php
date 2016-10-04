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
            'invoice_date' => $carbon->now(),
            'type' => 'local',
            'currency' => 'PEN',
            'comment' => 'Venta de prueba',
            'reason' => 'sale'
        ]);

        Output::create([
            'customer_id' => 1,
            'invoice' => '1000002',
            'invoice_date' => $carbon->now(),
            'type' => 'local',
            'currency' => 'USD',
            'comment' => 'Alquiler de prueba',
            'reason' => 'rental',
            'fechaAlquiler' => $carbon->now(),
            'fechaRetorno' => $carbon->now()->addDays(5),
            'destination' => 'Cajamarca'
        ]);
    }

}

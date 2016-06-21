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
        Output::create([
            'customer_id' => 1,
            'type' => 'local',
            'comment' => 'Venta de prueba',
            'reason' => 'sale'
        ]);

        $carbon = new Carbon();
        Output::create([
            'customer_id' => 1,
            'type' => 'local',
            'comment' => 'Alquiler de prueba',
            'reason' => 'rental',
            'fechaAlquiler' => $carbon->now(),
            'fechaRetorno' => $carbon->now()->addDays(5),
            'destination' => 'Cajamarca'
        ]);
    }

}

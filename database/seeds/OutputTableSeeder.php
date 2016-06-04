<?php

use App\Output;
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
            'comment' => 'Comentario de prueba',
            'reason' => 'sale'
        ]);
    }

}

<?php

use App\OutputDetail;
use Illuminate\Database\Seeder;

class OutputDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        OutputDetail::create([
            'output_id' => 1,
            'item_id' => 1,
            'price' => 15.2,
        ]);

        OutputDetail::create([
            'output_id' => 1,
            'item_id' => 2,
            'price' => 20,
        ]);

    }

}

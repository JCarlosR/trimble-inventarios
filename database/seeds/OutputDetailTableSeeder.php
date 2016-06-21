<?php

use App\OutputDetail;
use App\OutputPackage;
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
        // Sale example
        OutputDetail::create([
            'output_id' => 1,
            'item_id' => 1,
            'price' => 15.2
        ]);
        OutputDetail::create([
            'output_id' => 1,
            'item_id' => 2,
            'price' => 20
        ]);

        // Rental example
        OutputDetail::create([
            'output_id' => 2,
            'item_id' => 3,
            'price' => 20
        ]);
        OutputPackage::create([
            'output_id' => 2,
            'package_id' => 2,
            'price' => 80
        ]);
    }

}

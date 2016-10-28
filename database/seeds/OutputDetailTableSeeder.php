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
            'item_id' => 18,
            'price' => 464.45,
            'originalprice' => 393.60
        ]);
        OutputPackage::create([
            'output_id' => 1,
            'package_id' => 3,
            'price' => 708.00,
            'originalprice' => 600.00
        ]);

        // Rental example
        OutputDetail::create([
            'output_id' => 2,
            'item_id' => 6,
            'price' => 141.60,
            'originalprice' => 120.00
        ]);
        OutputPackage::create([
            'output_id' => 2,
            'package_id' => 1,
            'price' => 519.20,
            'originalprice' => 440.00
        ]);
    }

}

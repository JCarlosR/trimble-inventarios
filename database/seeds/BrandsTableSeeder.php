<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'TRIMBLE',
            'description' => ''
        ]);
        Brand::create([
            'name' => 'GENÉRICO',
            'description' => ''
        ]);
        Brand::create([
            'name' => 'STAINLESS',
            'description' => ''
        ]);
    }
}

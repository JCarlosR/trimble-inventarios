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
            'description' => 'Descripción de marca Trimble',
            'state'=>1
        ]);
        Brand::create([
            'name' => 'GENÉRICO',
            'description' => 'Descripción de marca genérico',
            'state'=>1
        ]);
        Brand::create([
            'name' => 'STAINLESS',
            'description' => 'Descripción de marca Stainless',
            'state'=>1
        ]);
    }
}

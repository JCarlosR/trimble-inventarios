<?php

use App\Exemplar;
use Illuminate\Database\Seeder;

class ExemplarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exemplar::create([
            'name' => 'GEO XT',
            'description' => '',
            'brand_id'=>'1'
        ]);

        Exemplar::create([
            'name' => 'GEO EXPLORER',
            'description' => '',
            'brand_id'=>'1'
        ]);
        Exemplar::create([
            'name' => 'TRC-05-3000',
            'description' => '',
            'brand_id'=>'1'
        ]);
        Exemplar::create([
            'name' => 'FVP-1202B',
            'description' => '',
            'brand_id'=>'1'
        ]);
        Exemplar::create([
            'name' => 'PROFESIONAL',
            'description' => '',
            'brand_id'=>'1'
        ]);

        Exemplar::create([
            'name' => '3 A 2',
            'description' => '',
            'brand_id'=>'2'
        ]);
        Exemplar::create([
            'name' => 'GEO EXPLORER',
            'description' => '',
            'brand_id'=>'2'
        ]);

        Exemplar::create([
            'name' => 'GEO EXPLORER',
            'description' => '',
            'brand_id'=>'3'
        ]);
    }
}

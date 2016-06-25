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
            'description' => 'Geo xt Trimble',
            'brand_id'=>'1',
            'state'=>1
        ]);

        Exemplar::create([
            'name' => 'GEO EXPLORER',
            'description' => 'Geo explorer Trmble',
            'brand_id'=>'1',
            'state'=>1
        ]);
        Exemplar::create([
            'name' => 'TRC-05-3000',
            'description' => 'TRC-05-3000 Trimble',
            'brand_id'=>'1',
            'state'=>1
        ]);
        Exemplar::create([
            'name' => 'FVP-1202B',
            'description' => 'FVP-1202B Trimble',
            'brand_id'=>'1',
            'state'=>1
        ]);
        Exemplar::create([
            'name' => 'PROFESIONAL',
            'description' => 'Professional Trimble',
            'brand_id'=>'1',
            'state'=>1
        ]);

        Exemplar::create([
            'name' => '3 A 2',
            'description' => '3 A 2 Genérico',
            'brand_id'=>'2',
            'state'=>1
        ]);
        Exemplar::create([
            'name' => 'GEO EXPLORER',
            'description' => 'Geo explorer Genérico',
            'brand_id'=>'2',
            'state'=>1
        ]);

        Exemplar::create([
            'name' => 'GEO EXPLORER',
            'description' => 'Geo explorer Stainless',
            'brand_id'=>'3',
            'state'=>1
        ]);
    }
}

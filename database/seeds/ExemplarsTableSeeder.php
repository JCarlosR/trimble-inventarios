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
            'name' => 'GEO  XT',
            'description' => '',
            'brand_id'=>'1'
        ]);
    }
}

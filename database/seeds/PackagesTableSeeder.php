<?php

use Illuminate\Database\Seeder;
use App\Package;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'name' => 'PAQ-012',
            'code' => 'PAQ-012-AL-01',
            'description' => 'Paquete de prueba',
            'state' => 'available',
            'box_id'=> 1
        ]);

        // 2
        Package::create([
            'name' => 'PAQ-019',
            'code' => 'PAQ-012-AL-04',
            'description' => 'Paquete de prueba',
            'state' => 'rented',
            'box_id'=> 2
        ]);

        Package::create([
            'name' => 'PAQ-619',
            'code' => 'PAQ-012-AL-03',
            'description' => 'Paquete de prueba',
            'state' => 'available',
            'box_id'=> 3
        ]);
    }
}

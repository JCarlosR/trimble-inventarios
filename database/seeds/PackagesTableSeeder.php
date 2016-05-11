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
            'description' => 'Paquete de prueba',
            'state' => 'available',
        ]);

        Package::create([
            'name' => 'PAQ-019',
            'description' => 'Paquete de prueba',
            'state' => 'available',
        ]);

        Package::create([
            'name' => 'PAQ-619',
            'description' => 'Paquete de prueba',
            'state' => 'available',
        ]);
    }
}

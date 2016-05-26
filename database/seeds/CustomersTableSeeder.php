<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' => 'Juan Perez Perez',
            'document' => '48317520',
            'address' => 'Las fatimas 222',
            'type' => 'Natural',
            'phone' => '958654512',
            'customer_type_id' => 1,
            'enable' => 1,
        ]);

        Customer::create([
            'name' => 'Las Palmas SA',
            'document' => '10254123659',
            'address' => 'Las fatimas 222',
            'type' => 'Jurídica',
            'phone' => '958654512',
            'customer_type_id' => 1,
            'enable' => 1,
        ]);
        Customer::create([
            'name' => 'Fernando Rios Perez',
            'document' => '48317520',
            'address' => 'Las fatimas 222',
            'type' => 'Natural',
            'phone' => '958654512',
            'customer_type_id' => 1,
            'enable' => 0,
        ]);

        Customer::create([
            'name' => 'Las Gaviotas SA',
            'document' => '10254123659',
            'address' => 'Las fatimas 222',
            'type' => 'Jurídica',
            'phone' => '958654512',
            'customer_type_id' => 1,
            'enable' => 0,
        ]);
        Customer::create([
            'name' => 'Carlos Hurtado Ramirez',
            'document' => '48317520',
            'address' => 'Las fatimas 222',
            'type' => 'Natural',
            'phone' => '958654512',
            'customer_type_id' => 1,
            'enable' => 0,
        ]);

        Customer::create([
            'name' => 'Asociacion Caminos del Perú',
            'document' => '10254123659',
            'address' => 'Las fatimas 222',
            'type' => 'Jurídica',
            'phone' => '958654512',
            'customer_type_id' => 1,
            'enable' => 0,
        ]);
        Customer::create([
            'name' => 'Reina Ramirez Arellano',
            'document' => '48317520',
            'address' => 'Las fatimas 222',
            'type' => 'Natural',
            'phone' => '958654512',
            'customer_type_id' => 1,
            'enable' => 1,
        ]);

        Customer::create([
            'name' => 'Central City SA',
            'document' => '10254123659',
            'address' => 'Las fatimas 222',
            'type' => 'Jurídica',
            'phone' => '958654512',
            'customer_type_id' => 1,
            'enable' => 1,
        ]);

    }
}

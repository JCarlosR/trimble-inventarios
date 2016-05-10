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
            'address' => 'Las fatimas 222',
            'phone' => '958654512',
            'customer_type_id' => 1
        ]);

        Customer::create([
            'name' => 'Pablo Perez Perez',
            'address' => 'Las fatimas 224',
            'phone' => '958654514',
            'customer_type_id' => 1
        ]);
    }
}

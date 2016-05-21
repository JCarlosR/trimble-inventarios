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
            'name' => 'Juan',
            'surname' => 'Perez Perez',
            'address' => 'Las fatimas 222',
            'gender' => 'Masculino',
            'phone' => '958654512',
            'customer_type_id' => 1
        ]);

        Customer::create([
            'name' => 'Pablo',
            'surname' => 'Perez Perez',
            'address' => 'Las fatimas 224',
            'gender' => 'Masculino',
            'phone' => '958654514',
            'customer_type_id' => 1
        ]);
    }
}

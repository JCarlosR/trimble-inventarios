<?php

use Illuminate\Database\Seeder;
use App\CustomerType;

class CustomersTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerType::create([
            'name' => 'Bueno',
            'description' => 'Buen cliente',
        ]);
    }
}

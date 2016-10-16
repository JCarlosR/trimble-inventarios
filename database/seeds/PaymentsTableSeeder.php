<?php

use Illuminate\Database\Seeder;
use App\Payments;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payments::create([
            'invoice' => '1000001',
            'payment' => 10.00,
            'type' => 'Deposito',
            'user_id'=> 2,
            'operation' => '958654512',
            'date' => '15/01/2015',
            'enable' => 1,
        ]);

        Payments::create([
            'invoice' => '1000001',
            'payment' => 10.00,
            'type' => 'Deposito',
            'user_id'=> 2,
            'operation' => '958654512',
            'date' => '15/02/2015',
            'enable' => 1,
        ]);
        Payments::create([
            'invoice' => '1000001',
            'payment' => 4.00,
            'type' => 'Deposito',
            'user_id'=> 2,
            'operation' => '958654512',
            'date' => '15/03/2015',
            'enable' => 1,
        ]);

    }
}

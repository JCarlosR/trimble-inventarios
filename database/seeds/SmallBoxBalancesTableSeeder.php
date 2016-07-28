<?php

use App\SmallBoxBalance;
use Illuminate\Database\Seeder;

class SmallBoxBalancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmallBoxBalance::create([
            'balance' => 0
        ]);
    }
}

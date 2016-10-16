<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'iso' => 'USD',
            'name' => 'Dólares',
            'value' => 1
        ]);

        Currency::create([
            'iso' => 'PEN',
            'name' => 'Soles',
            'value' => 3.28
        ]);
    }
}

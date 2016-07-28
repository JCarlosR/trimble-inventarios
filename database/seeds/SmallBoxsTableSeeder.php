<?php

use App\SmallBox;
use Illuminate\Database\Seeder;

class SmallBoxsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmallBox::create([
            'concept' => 'Asignacion para el mes de Julio.',
            'type' => 'assign',
            'amount' => 50.00,
            'enable' => 1
        ]);
        SmallBox::create([
            'concept' => 'Ingreso a la caja chica.',
            'type' => 'input',
            'amount' => 10.00,
            'enable' => 1
        ]);
        SmallBox::create([
            'concept' => 'Pago de agua.',
            'type' => 'output',
            'amount' => 30.00,
            'enable' => 1
        ]);
        SmallBox::create([
            'concept' => 'Pago de luz.',
            'type' => 'output',
            'amount' => 30.00,
            'enable' => 1
        ]);
    }

}

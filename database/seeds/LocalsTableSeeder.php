<?php

use App\Local;
use Illuminate\Database\Seeder;

class LocalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Local::create([
            'name' => 'AL',
            'comment'=>'Es un almacén',
            'type' =>1
        ]);

        Local::create([
            'name' => 'OF',
            'comment'=>'Es una oficina',
            'type' =>2
        ]);

    }
}

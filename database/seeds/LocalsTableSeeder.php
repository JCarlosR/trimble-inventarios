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
            'comment'=>'',
            'type' =>0
        ]);
    }
}

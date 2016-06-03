<?php

use App\Shelf;
use Illuminate\Database\Seeder;

class ShelvesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shelf::create([
            'name' => 'A1',
            'comment'=>'',
            'local_id'=>1
        ]);
    }
}

<?php

use App\Box;
use Illuminate\Database\Seeder;

class BoxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Box::create([
            'name' => 'C1',
            'comment'=>'',
            'level_id'=>1
        ]);
    }
}

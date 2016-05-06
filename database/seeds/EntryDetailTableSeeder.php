<?php

use App\EntryDetail;
use Illuminate\Database\Seeder;

class EntryDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntryDetail::create([
            'entry_id' => 1,
            'item_id' => 1,
            'price' => 15.2,
        ]);

        EntryDetail::create([
            'entry_id' => 1,
            'item_id' => 2,
            'price' => 16.4,
        ]);

        EntryDetail::create([
            'entry_id' => 1,
            'item_id' => 3,
            'price' => 20.1,
        ]);
    }

}

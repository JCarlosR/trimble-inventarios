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
            'product_id' => 1,
            'series' => 'S/S',
            'quantity' => 10,
            'price' => 15.2,
        ]);

        EntryDetail::create([
            'entry_id' => 1,
            'product_id' => 3,
            'series' => 'CO1',
            'quantity' => 1,
            'price' => 20.1,
        ]);

        EntryDetail::create([
            'entry_id' => 1,
            'product_id' => 3,
            'series' => 'CO2',
            'quantity' => 1,
            'price' => 20.1,
        ]);

        EntryDetail::create([
            'entry_id' => 1,
            'product_id' => 3,
            'series' => 'CO3',
            'quantity' => 1,
            'price' => 20.1,
        ]);

        EntryDetail::create([
            'entry_id' => 2,
            'product_id' => 5,
            'series' => 'DGF02',
            'quantity' => 1,
            'price' => 20.1,
        ]);

        EntryDetail::create([
            'entry_id' => 2,
            'product_id' => 5,
            'series' => 'DGF04',
            'quantity' => 1,
            'price' => 20.1,
        ]);

        EntryDetail::create([
            'entry_id' => 2,
            'product_id' => 4,
            'series' => 'S/S',
            'quantity' => 3,
            'price' => 20.1,
        ]);

        EntryDetail::create([
            'entry_id' => 3,
            'product_id' => 5,
            'series' => 'DGF02',
            'quantity' => 1,
            'price' => 20.1,
        ]);

        EntryDetail::create([
            'entry_id' => 3,
            'product_id' => 5,
            'series' => 'DGF04',
            'quantity' => 1,
            'price' => 20.1,
        ]);

        EntryDetail::create([
            'entry_id' => 3,
            'product_id' => 4,
            'series' => 'S/S',
            'quantity' => 12,
            'price' => 10.1,
        ]);
    }

}

<?php

use App\EntryDetail;
use App\Item;
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
            'series' => 'CO0',
            'quantity' => 1,
            'price' => 15.2,
        ]);
        Item::create([
            'product_id' => 1,
            'series' => 'CO0',
            'package_id' => null,
            'box_id' => 1
        ]);

        EntryDetail::create([
            'entry_id' => 1,
            'product_id' => 1,
            'series' => 'CO1',
            'quantity' => 1,
            'price' => 20.1,
        ]);
        Item::create([
            'product_id' => 1,
            'series' => 'CO1',
            'package_id' => null,
            'box_id' => 1
        ]);

        EntryDetail::create([
            'entry_id' => 1,
            'product_id' => 3,
            'series' => 'CO2',
            'quantity' => 1,
            'price' => 20.1,
        ]);
        Item::create([
            'product_id' => 3,
            'series' => 'CO2',
            'package_id' => null,
            'box_id' => 1
        ]);

        EntryDetail::create([
            'entry_id' => 1,
            'product_id' => 3,
            'series' => 'CO3',
            'quantity' => 1,
            'price' => 20.1,
        ]);
        Item::create([
            'product_id' => 3,
            'series' => 'CO3',
            'package_id' => null,
            'box_id' => 1
        ]);


        // Entry 2
        EntryDetail::create([
            'entry_id' => 2,
            'product_id' => 5,
            'series' => 'DGF02',
            'quantity' => 1,
            'price' => 20.1,
        ]);
        Item::create([
            'product_id' => 5,
            'series' => 'DGF02',
            'state' => 'available',
            'package_id' => null,
            'box_id' => 1
        ]);

        EntryDetail::create([
            'entry_id' => 2,
            'product_id' => 5,
            'series' => 'DGF04',
            'quantity' => 1,
            'price' => 20.1,
        ]);
        Item::create([
            'product_id' => 5,
            'series' => 'DGF04',
            'state' => 'available',
            'package_id' => null,
            'box_id' => 1
        ]);

        EntryDetail::create([
            'entry_id' => 2,
            'product_id' => 4,
            'series' => 'XYZ03',
            'quantity' => 1,
            'price' => 20.1,
        ]);
        Item::create([
            'product_id' => 4,
            'series' => 'XYZ03',
            'state' => 'available',
            'package_id' => null,
            'box_id' => 1
        ]);


        EntryDetail::create([
            'entry_id' => 3,
            'product_id' => 5,
            'series' => 'DGF02',
            'quantity' => 1,
            'price' => 20.1,
        ]);
        Item::create([
            'product_id' => 5,
            'series' => 'DGF02',
            'state' => 'available',
            'package_id' => null,
            'box_id' => 1
        ]);

        EntryDetail::create([
            'entry_id' => 3,
            'product_id' => 5,
            'series' => 'DGF04',
            'quantity' => 1,
            'price' => 20.1,
        ]);
        Item::create([
            'product_id' => 5,
            'series' => 'DGF04',
            'state' => 'available',
            'package_id' => null,
            'box_id' => 1
        ]);

        EntryDetail::create([
            'entry_id' => 3,
            'product_id' => 4,
            'series' => 'ABC03',
            'quantity' => 1,
            'price' => 10.1,
        ]);
        Item::create([
            'product_id' => 4,
            'series' => 'ABC03',
            'state' => 'available',
            'package_id' => null,
            'box_id' => 1
        ]);
    }

}

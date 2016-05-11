<?php

use App\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'product_id' => 3,
            'series' => 'XT8-01',
            'state' => 'available',
            'package_id' => null,
        ]);

        Item::create([
            'product_id' => 3,
            'series' => 'XT8-02',
            'state' => 'available',
            'package_id' => null,
        ]);

        Item::create([
            'product_id' => 3,
            'series' => 'XT8-03',
            'state' => 'available',
            'package_id' => null,
        ]);

        Item::create([
            'product_id' => 5,
            'series' => 'XFRT8-01',
            'state' => 'available',
            'package_id' => null,
        ]);

        Item::create([
            'product_id' => 5,
            'series' => 'XHTYT8-02',
            'state' => 'available',
            'package_id' => null,
        ]);

        Item::create([
            'product_id' => 1,
            'series' => null,
            'state' => 'available',
            'package_id' => null,
        ]);

        Item::create([
            'product_id' => 2,
            'series' => null,
            'state' => 'available',
            'package_id' => null,
        ]);

        Item::create([
            'product_id' => 2,
            'series' => null,
            'state' => 'available',
            'package_id' => null,
        ]);

        Item::create([
            'product_id' => 4,
            'series' => null,
            'state' => 'available',
            'package_id' => null,
        ]);

        //Items en paquetes
        Item::create([
            'product_id' => 4,
            'series' => null,
            'state' => 'available',
            'package_id' => 1,
        ]);

        Item::create([
            'product_id' => 3,
            'series' => 'SERIE-014',
            'state' => 'available',
            'package_id' => 1,
        ]);

        Item::create([
            'product_id' => 1,
            'series' => null,
            'state' => 'available',
            'package_id' => 2,
        ]);

        Item::create([
            'product_id' => 3,
            'series' => 'SERIE-078',
            'state' => 'available',
            'package_id' => 2,
        ]);

        Item::create([
            'product_id' => 1,
            'series' => null,
            'state' => 'available',
            'package_id' => 3,
        ]);

        Item::create([
            'product_id' => 3,
            'series' => 'SERIE-178',
            'state' => 'available',
            'package_id' => 3,
        ]);

        Item::create([
            'product_id' => 3,
            'series' => 'SERIE-278',
            'state' => 'available',
            'package_id' => 3,
        ]);

    }
}

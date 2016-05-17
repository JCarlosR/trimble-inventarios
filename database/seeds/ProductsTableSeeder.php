<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
        'name' => 'RECEPTOR GPS GEO XT SERIES 2008',
        'description' => '',
        'price'=>'120,80',
        'money'=>'1',
        'series'=>'0',
        'brand_id'=>'1',
        'exemplar_id'=>'1',
        'part_number'=>'70950-20',
        'color'=>'AMARILLO',
        'category_id'=>'1',
        'subcategory_id'=>'1',
        'comment'=>''
        ]);

        Product::create([
            'name' => 'PROTECTOR DE PANTALLA',
            'description' => '',
            'price'=>'200,00',
            'money'=>'2',
            'series'=>'0',
            'brand_id'=>'1',
            'exemplar_id'=>'1',
            'part_number'=>'S/N',
            'color'=>'BLANCO',
            'category_id'=>'1',
            'subcategory_id'=>'1',
            'comment'=>''
        ]);

        Product::create([
            'name' => 'CORREA DE RECEPTOR Y DOS PERNOS',
            'description' => '',
            'price'=>'240,00',
            'money'=>'2',
            'series'=>'1',
            'brand_id'=>'1',
            'exemplar_id'=>'1',
            'part_number'=>'S/N',
            'color'=>'NEGRO',
            'category_id'=>'1',
            'subcategory_id'=>'1',
            'comment'=>''
        ]);

        Product::create([
            'name' => 'CARGADOR-TRANSFORMADOR',
            'description' => '',
            'price'=>'200,00',
            'money'=>'1',
            'series'=>'0',
            'brand_id'=>'1',
            'exemplar_id'=>'1',
            'part_number'=>'S/N',
            'color'=>'NARANJA',
            'category_id'=>'1',
            'subcategory_id'=>'1',
            'comment'=>''
        ]);

        Product::create([
            'name' => 'CABLE INTERFACE (USB)',
            'description' => '',
            'price'=>'600,00',
            'money'=>'1',
            'series'=>'1',
            'brand_id'=>'1',
            'exemplar_id'=>'1',
            'part_number'=>'S/N',
            'color'=>'VERDE',
            'category_id'=>'1',
            'subcategory_id'=>'1',
            'comment'=>''
        ]);
    }
}
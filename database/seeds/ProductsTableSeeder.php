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
        'exemplar_id'=>'2',
        'part_number'=>'70950-20',
        'color'=>'AMARILLO',
        'category_id'=>'1',
        'subcategory_id'=>'1',
        'image'=>'1.jpg',
        'comment'=>''
        ]);

        Product::create([
            'name' => 'PROTECTOR DE PANTALLA DE CELULAR',
            'description' => '',
            'price'=>'200,00',
            'money'=>'2',
            'series'=>'0',
            'brand_id'=>'1',
            'exemplar_id'=>'1',
            'part_number'=>'S/N',
            'color'=>'BLANCO',
            'category_id'=>'1',
            'subcategory_id'=>'2',
            'image'=>'2.jpg',
            'comment'=>''
        ]);

        Product::create([
            'name' => 'CORREA DE RECEPTOR Y DOS PERNOS',
            'description' => '',
            'price'=>'240,00',
            'money'=>'2',
            'series'=>'1',
            'brand_id'=>'2',
            'exemplar_id'=>'6',
            'part_number'=>'S/N',
            'color'=>'NEGRO',
            'category_id'=>'7',
            'subcategory_id'=>'19',
            'image'=>'3.jpg',
            'comment'=>''
        ]);

        Product::create([
            'name' => 'CARGADOR-TRANSFORMADOR',
            'description' => '',
            'price'=>'200,00',
            'money'=>'1',
            'series'=>'0',
            'brand_id'=>'3',
            'exemplar_id'=>'8',
            'part_number'=>'S/N',
            'color'=>'NARANJA',
            'category_id'=>'3',
            'subcategory_id'=>'8',
            'image'=>'4.jpg',
            'comment'=>''
        ]);

        Product::create([
            'name' => 'CABLE INTERFACE (USB)',
            'description' => '',
            'price'=>'600,00',
            'money'=>'1',
            'series'=>'1',
            'brand_id'=>'2',
            'exemplar_id'=>'6',
            'part_number'=>'S/N',
            'color'=>'ROJO',
            'category_id'=>'4',
            'subcategory_id'=>'10',
            'image'=>'5.jpg',
            'comment'=>''
        ]);

        Product::create([
            'name' => 'ADAPTADOR MIRCRO SD',
            'description' => 'Descripción de cable conector',
            'price'=>'450,00',
            'money'=>'2',
            'series'=>'0',
            'brand_id'=>'2',
            'exemplar_id'=>'7',
            'part_number'=>'S/N',
            'color'=>'VERDE',
            'category_id'=>'3',
            'subcategory_id'=>'9',
            'image'=>'6.jpg',
            'comment'=>''
        ]);

        Product::create([
            'name' => 'BATERÍA EXTERNA DE CELULAR',
            'description' => '',
            'price'=>'420,00',
            'money'=>'1',
            'series'=>'1',
            'brand_id'=>'1',
            'exemplar_id'=>'5',
            'part_number'=>'S/N',
            'color'=>'AZUL',
            'category_id'=>'6',
            'subcategory_id'=>'17',
            'image'=>'7.jpg',
            'comment'=>''
        ]);
    }
}
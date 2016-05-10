<?php

use App\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategory::create([
            'name' => 'EQUIPOS',
            'description' => 'Equipos GNSS',
            'category_id'=>'1'
        ]);
        Subcategory::create([
            'name' => 'ACCESORIOS',
            'description' => 'Accesorios GNSS',
            'category_id'=>'1'
        ]);
        Subcategory::create([
            'name' => 'REPUESTOS',
            'description' => 'Repuestos GNSS',
            'category_id'=>'1'
        ]);

        Subcategory::create([
            'name' => 'EQUIPOS',
            'description' => 'Equipos DIFERENCIALES',
            'category_id'=>'2'
        ]);
        Subcategory::create([
            'name' => 'ACCESORIOS',
            'description' => 'Accesorios DIFERENCIALES',
            'category_id'=>'2'
        ]);
        Subcategory::create([
            'name' => 'REPUESTOS',
            'description' => 'Repuestos DIFERENCIALES',
            'category_id'=>'2'
        ]);

        Subcategory::create([
            'name' => 'EQUIPOS',
            'description' => 'Equipos GEODÉSICOS',
            'category_id'=>'3'
        ]);
        Subcategory::create([
            'name' => 'ACCESORIOS',
            'description' => 'Accesorios GEODÉSICOS',
            'category_id'=>'3'
        ]);
        Subcategory::create([
            'name' => 'REPUESTOS',
            'description' => 'Repuestos GEODÉSICOS',
            'category_id'=>'3'
        ]);

        Subcategory::create([
            'name' => 'EQUIPOS',
            'description' => 'Equipos ONMISTAR',
            'category_id'=>'4'
        ]);
        Subcategory::create([
            'name' => 'ACCESORIOS',
            'description' => 'Accesorios ONMISTAR',
            'category_id'=>'4'
        ]);
        Subcategory::create([
            'name' => 'REPUESTOS',
            'description' => 'Repuestos ONMISTAR',
            'category_id'=>'4'
        ]);

        Subcategory::create([
            'name' => 'EQUIPOS',
            'description' => 'Equipos - ESTACIONES DE RASTREO PERMANENTE',
            'category_id'=>'5'
        ]);
        Subcategory::create([
            'name' => 'ACCESORIOS',
            'description' => 'Accesorios - ESTACIONES DE RASTREO PERMANENTE',
            'category_id'=>'5'
        ]);
        Subcategory::create([
            'name' => 'REPUESTOS',
            'description' => 'Repuestos - ESTACIONES DE RASTREO PERMANENTE',
            'category_id'=>'5'
        ]);

        Subcategory::create([
            'name' => 'EQUIPOS',
            'description' => 'Equipos - ESTACIONES TOTALES',
            'category_id'=>'6'
        ]);
        Subcategory::create([
            'name' => 'ACCESORIOS',
            'description' => 'Accesorios - ESTACIONES TOTALES',
            'category_id'=>'6'
        ]);
        Subcategory::create([
            'name' => 'REPUESTOS',
            'description' => 'Repuestos - ESTACIONES TOTALES',
            'category_id'=>'6'
        ]);

        Subcategory::create([
            'name' => 'MUEBLES',
            'description' => 'Equipos - BIENES DE OFICINA',
            'category_id'=>'7'
        ]);
        Subcategory::create([
            'name' => 'CÓMPUTO',
            'description' => 'Equipos - BIENES DE OFICINA',
            'category_id'=>'7'
        ]);
        Subcategory::create([
            'name' => 'ÚTILES DE ESCRITORIO',
            'description' => 'Equipos - BIENES DE OFICINA',
            'category_id'=>'7'
        ]);
        Subcategory::create([
            'name' => 'OTROS',
            'description' => 'Limpieza, Embalaje,ect. - BIENES DE OFICINA',
            'category_id'=>'7'
        ]);
    }
}
<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'GNSS',
            'description' => 'Descripción Gnss',
            'state'=>1
        ]);
        Category::create([
            'name' => 'DIFERENCIALES',
            'description' => 'Descripción Diferenciales',
            'state'=>1
        ]);
        Category::create([
            'name' => 'GEODÉSICOS',
            'description' => 'Descripción Geodésicos',
            'state'=>1
        ]);

        Category::create([
            'name' => 'ONMISTAR',
            'description' => 'Descripción ',
            'state'=>1
        ]);
        Category::create([
            'name' => 'ESTACIONES DE RASTREO PERMANENTE',
            'description' => 'Descripción Estaciones de rastreo permanente',
            'state'=>1
        ]);
        Category::create([
            'name' => 'ESTACIONES TOTALES',
            'description' => 'Descripción Estaciones totales',
            'state'=>1
        ]);
        Category::create([
            'name' => 'BIENES DE OFICINA',
            'description' => 'Descripción Bienes de oficina',
            'state'=>1
        ]);
    }
}
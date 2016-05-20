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
            'description' => 'Descripción Gnss'
        ]);
        Category::create([
            'name' => 'DIFERENCIALES',
            'description' => 'Descripción Diferenciales'
        ]);
        Category::create([
            'name' => 'GEODÉSICOS',
            'description' => 'Descripción Geodésicos'
        ]);

        Category::create([
            'name' => 'ONMISTAR',
            'description' => 'Descripción '
        ]);
        Category::create([
            'name' => 'ESTACIONES DE RASTREO PERMANENTE',
            'description' => 'Descripción Estaciones de rastreo permanente'
        ]);
        Category::create([
            'name' => 'ESTACIONES TOTALES',
            'description' => 'Descripción Estaciones totales'
        ]);
        Category::create([
            'name' => 'BIENES DE OFICINA',
            'description' => 'Descripción Bienes de oficina'
        ]);
    }
}
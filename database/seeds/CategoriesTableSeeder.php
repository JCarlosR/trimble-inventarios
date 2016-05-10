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
            'description' => ''
        ]);
        Category::create([
            'name' => 'DIFERENCIALES',
            'description' => ''
        ]);
        Category::create([
            'name' => 'GEODÉSICOS',
            'description' => ''
        ]);

        Category::create([
            'name' => 'ONMISTAR',
            'description' => ''
        ]);
        Category::create([
            'name' => 'ESTACIONES DE RASTREO PERMANENTE',
            'description' => ''
        ]);
        Category::create([
            'name' => 'ESTACIONES TOTALES',
            'description' => ''
        ]);
        Category::create([
            'name' => 'BIENES DE OFICINA',
            'description' => ''
        ]);
    }
}
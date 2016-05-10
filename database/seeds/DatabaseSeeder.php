<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(CustomersTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ExemplarsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

        $this->call(ItemsTableSeeder::class);
        $this->call(EntriesTableSeeder::class);
        $this->call(EntryDetailsTableSeeder::class);
    }
}

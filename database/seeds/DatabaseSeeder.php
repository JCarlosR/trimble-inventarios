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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(CustomersTypesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ExemplarsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

        $this->call(PackagesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(EntriesTableSeeder::class);
        $this->call(EntryDetailsTableSeeder::class);
        $this->call(OutputsTableSeeder::class);
        $this->call(OutputDetailsTableSeeder::class);

        $this->call(LocalsTableSeeder::class);
        $this->call(ShelvesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(BoxesTableSeeder::class);
    }
}

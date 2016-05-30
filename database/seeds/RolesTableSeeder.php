<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Role::create([
            'name' => 'Employee'
        ]);

        // 2
        Role::create([
            'name' => 'Administrator'
        ]);
    }
}

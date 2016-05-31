<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 2, // Administrator
            'name' => 'Juan Ramos',
            'email' => 'juancagb.17@gmail.com',
            'password' => bcrypt('123123')
        ]);
        User::create([
            'role_id' => 2,
            'name' => 'Jorge Gonzales',
            'email' => 'joryes1894@gmail.com',
            'password' => bcrypt('123456')
        ]);
        User::create([
            'role_id' => 2,
            'name' => 'Edilberto Soles',
            'email' => 'edilberto0905@gmail.com',
            'password' => bcrypt('3015')
        ]);

        User::create([
            'role_id' => 1, // Employee
            'name' => 'Empleado',
            'email' => 'empleado@gmail.com',
            'password' => bcrypt('123123')
        ]);

    }
}

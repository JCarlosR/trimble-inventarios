<?php

use App\Entry;
use Illuminate\Database\Seeder;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entry::create([
            'provider_id' => 1,
            'destination' => 'Destino de prueba',
            'comment' => 'Comentario de prueba',
        ]);

        Entry::create([
            'provider_id' => null,
            'destination' => 'Destino de prueba',
            'comment' => 'Comentario de prueba 2',
        ]);

        Entry::create([
            'provider_id' => 1,
            'destination' => 'Destino de prueba',
            'comment' => 'Comentario de prueba 3',
        ]);
    }

}

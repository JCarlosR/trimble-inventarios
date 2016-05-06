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
            'type' => 'local',
            'comment' => 'Comentario de prueba',
        ]);
    }

}

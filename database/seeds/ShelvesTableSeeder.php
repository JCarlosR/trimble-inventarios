<?php

use App\Box;
use App\Level;
use App\Local;
use App\Shelf;
use Illuminate\Database\Seeder;

class ShelvesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locals = Local::all();
        foreach( $locals as $local ){
            // 4 shelves per local
            for( $s = 1; $s < 5; ++$s ){
                $shelf = Shelf::create([
                    'name' => 'A' . $s,
                    'comment'=>'Anaquel A'.$s,
                    'local_id' => $local->id
                ]);

                // 3 levels per shelf
                for( $l = 1; $l < 4; ++$l ){
                    $level = Level::create([
                        'name' => 'N' . $l,
                        'comment'=>'Nivel N'.$l,
                        'shelf_id' => $shelf->id
                    ]);

                    // 2 boxes per shelf
                    for( $b = 1; $b < 3; ++$b ){
                        Box::create([
                            'name' => 'C' . $b,
                            'comment'=>'Caja C'.$b,
                            'level_id' => $level->id
                        ]);
                    }
                }
            }
        }
    }
}
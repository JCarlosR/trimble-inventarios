<?php

use App\Provider;
use App\ProviderType;
use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProviderType::create([
            'name' => 'General'
        ]);

        Provider::create([
            'name' => 'Proveedor de prueba',
            'surname' => 'Perez Perez',
            'address' => 'Las fatimas 222',
            'gender' => 'Masculino',
            'phone' => '958654512',
            'provider_type_id' => 1
        ]);
    }
}

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
            'name' => 'Proveedor ejemplo',
            'address' => 'Dirección de ejemplo',
            'phone' => '333666999',
            'comments' => 'Este proveedor es solo para motivos de testing.',
            'provider_type_id' => 1
        ]);
    }
}

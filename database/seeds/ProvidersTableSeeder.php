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
            'name' => 'Carlos Rincón Román',
            'document' => '48317520',
            'address' => 'Av. El Sol 123',
            'type' => 'Natural',
            'phone' => '958654512',
            'provider_type_id' => 1,
            'enable' => 1,
        ]);

        Provider::create([
            'name' => 'Maxwell Corp SA',
            'document' => '10254123659',
            'address' => 'Av. Los Rosales 1457',
            'type' => 'Jurídica',
            'phone' => '958654512',
            'provider_type_id' => 1,
            'enable' => 1,
        ]);
        Provider::create([
            'name' => 'Jorge Díaz Serrano',
            'document' => '48317520',
            'address' => 'Las fatimas 222',
            'type' => 'Natural',
            'phone' => '958654512',
            'provider_type_id' => 1,
            'enable' => 0,
        ]);

        Provider::create([
            'name' => 'Los Emprendedores EIRL',
            'document' => '10254123659',
            'address' => 'Las fatimas 222',
            'type' => 'Jurídica',
            'phone' => '958654512',
            'provider_type_id' => 1,
            'enable' => 0,
        ]);
        Provider::create([
            'name' => 'Anabeth Chase Carrión',
            'document' => '48317520',
            'address' => 'Las fatimas 222',
            'type' => 'Natural',
            'phone' => '958654512',
            'provider_type_id' => 1,
            'enable' => 0,
        ]);

        Provider::create([
            'name' => 'Asociacion Corporativa',
            'document' => '10254123659',
            'address' => 'Las fatimas 222',
            'type' => 'Jurídica',
            'phone' => '958654512',
            'provider_type_id' => 1,
            'enable' => 0,
        ]);
        Provider::create([
            'name' => 'Jason Grace',
            'document' => '48317520',
            'address' => 'Las fatimas 222',
            'type' => 'Natural',
            'phone' => '958654512',
            'provider_type_id' => 1,
            'enable' => 1,
        ]);

        Provider::create([
            'name' => 'Zaragoza Corp SA',
            'document' => '10254123659',
            'address' => 'Las fatimas 222',
            'type' => 'Jurídica',
            'phone' => '958654512',
            'provider_type_id' => 1,
            'enable' => 1,
        ]);
    }
}

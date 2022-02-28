<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::createMany([
            [
                "street" => "Rua Ametista",
                "number" => "41",
                "complement" => "casa 1",
                "district" => "Ouro Verde",
                "lat" => "-22.512676655032",
                "lng" => "-41.918496373016",
                "city_id" => 3657,
                "card_id" => 1
            ],
            [
                "street" => "Rua Fortaleza",
                "number" => "100",
                "district" => "Ouro Verde",
                "lat" => "-22.511507123363",
                "lng" => "-41.918324711639",
                "city_id" => 3657,
                "card_id" => 1
            ]
        ]);
    }
}

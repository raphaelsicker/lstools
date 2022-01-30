<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Locality;
use App\Models\ServiceGroup;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locality = Locality::create([
            'name' => 'Padrão',
            'service_group_id' => ServiceGroup::first()?->id
        ]);

        Card::createMany([
            [
                'order' => 1,
                'locality_id' => $locality->id
            ],
            [
                'order' => 2,
                'locality_id' => $locality->id
            ],
        ]);
    }
}

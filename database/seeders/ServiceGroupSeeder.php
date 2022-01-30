<?php

namespace Database\Seeders;

use App\Models\ServiceGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ServiceGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(App::environment('local')) {
            ServiceGroup::createMany([
                [
                    'name' => 'Catumbi',
                    'shortname' => 'CA',
                    'color' => '#3d85c6'
                ],
                [
                    'name' => 'Rocinha',
                    'shortname' => 'RO',
                    'color' => '#ff9900'
                ],
            ]);

            return;
        }

        ServiceGroup::createMany([
            [
                'name' => 'Padrão',
                'shortname' => 'PA',
                'color' => '#3d85c6'
            ]
        ]);
    }
}

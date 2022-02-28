<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UfSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ServiceGroupSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(AddressSeeder::class);
    }
}

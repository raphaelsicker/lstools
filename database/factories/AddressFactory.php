<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'street' => 'Rua Riachuelo',
            'number' => '100',
            'district' => 'Centro',
            'latitude' => '-22.914653484283534',
            'longitude' => '-43.186830060130255',
            'city_id' => City::name('Rio de Janeiro')->first()->id,
        ];
    }

    public function bh(): AddressFactory
    {
        return $this->state(function () {
            return [
                'street' => 'Rua Belo Horizonte',
                'number' => '500',
                'district' => 'Pampulha',
                'latitude' => '-22.914653484283534',
                'longitude' => '-43.186830060130255',
                'city_id' => City::name('Belo Horizonte')->first()->id
            ];
        });
    }

    public function sp(): AddressFactory
    {
        return $this->state(function () {
            return [
                'street' => 'Rua Chile',
                'number' => '15',
                'district' => 'Moema',
                'latitude' => '-22.914653484283534',
                'longitude' => '-43.186830060130255',
                'city_id' => City::name('São Paulo')->first()->id
            ];
        });
    }
}

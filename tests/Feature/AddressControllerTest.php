<?php

namespace Tests\Feature;

use App\Helpers\Arr;
use App\Helpers\Str;
use App\Models\Address;
use App\Models\City;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSimpleGet()
    {
        Address::factory()->create();
        Address::factory()->sp()->create();

        $response = $this->get('/api/address');
        $response->assertStatus(200);

        $data = $response->json()['data'];
        $this->assertCount(2, $data);
    }

    public function testGetFiltering()
    {
        Address::factory()->create();
        Address::factory(['street' => 'Rua da Assembleia'])->create();
        Address::factory()->sp()->create();
        Address::factory()->bh()->create();

        $query = Arr::query([
            'filters' => [
                'city_id' => City::name('Rio de Janeiro')->first()->id
            ]
        ]);

        $response = $this->get('/api/address?' . $query);
        $response->assertStatus(200);

        $data = $response->json()['data'];
        $this->assertCount(2, $data);
    }

    public function testStore()
    {
        $address = Address::factory()->bh()->make();

        $response = $this->post('/api/address', $address->toArray());
        $response->assertStatus(200);

        $data = $response->json();
        $this->assertEquals($address->street, $data['street']);
    }
}

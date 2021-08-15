<?php

namespace Tests\Unit;

use App\Models\Address;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddressTest extends TestCase
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
    public function testCreateAddress()
    {
        Address::factory()->create();
        Address::factory()->bh()->create();

        $this->assertCount(2, Address::all());
    }
}

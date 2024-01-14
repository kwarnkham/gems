<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->user = User::query()->first();
    }

    public function test_add_a_price_to_an_item()
    {
        $item = Item::factory()->create();
        $response = $this->actingAs($this->user)->postJson('api/prices', [
            'usd' => fake()->numberBetween(100, 1000),
            'mmk' => fake()->numberBetween(100, 1000),
            'item_id' => $item->id
        ]);

        $response->assertCreated();

        $this->assertDatabaseCount('prices', 1);
        $this->assertEquals($item->prices()->first()->mmk, $response->json()['mmk']);
    }

    public function test_make_a_price_inactive()
    {
        $item = Item::factory()->create();
        $response = $this->actingAs($this->user)->postJson('api/prices', [
            'usd' => fake()->numberBetween(100, 1000),
            'mmk' => fake()->numberBetween(100, 1000),
            'item_id' => $item->id
        ]);

        $response->assertCreated();

        $response = $this->actingAs($this->user)->putJson("api/prices/{$response->json()['id']}", [
            'usd' => fake()->numberBetween(100, 1000),
            'mmk' => fake()->numberBetween(100, 1000),
            'active' => false
        ]);

        $response->assertOk();

        $this->assertFalse($response->json()['active']);
    }

    public function test_list_prices_of_an_item()
    {
        $item = Item::factory()->create();
        $item->prices()->create(['usd' => 100, 'mmk' => 340000]);

        $response = $this->actingAs($this->user)->getJson("api/prices?item_id={$item->id}");

        $response->assertOk();
    }
}

<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->user = User::query()->first();
    }

    public function test_create_an_item()
    {
        $item = Item::factory()->make()->toArray();
        $response = $this->actingAs($this->user)->postJson('api/items', $item);
        $response->assertCreated();
        $this->assertDatabaseCount('items', 1);
    }

    public function test_update_an_item()
    {
        $item = Item::factory()->create();
        $updatedItem = Item::factory()->make()->toArray();
        $response = $this->actingAs($this->user)->putJson("api/items/{$item->fresh()->id}", $updatedItem);
        $response->assertOk();
        $this->assertEquals($updatedItem['name'], $item->fresh()->name);
        $this->assertEquals($updatedItem['description'], $item->fresh()->description);
    }

    public function test_list_items()
    {
        Item::factory()->count(20)->create();
        $response = $this->getJson("api/items");
        $response->assertOk();
        $response->assertJsonCount(10, 'data.data');
    }

    public function test_find_an_item()
    {
        Item::factory()->count(20)->create();
        $item = Item::inRandomOrder()->first();
        $response = $this->getJson("api/items/{$item->id}");
        $response->assertOk();
        $this->assertEquals($response->json()['id'], $item->id);
    }
}

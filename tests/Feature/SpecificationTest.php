<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpecificationTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->user = User::query()->first();
    }

    public function test_add_specification_to_an_item(): void
    {
        $item = Item::factory()->create();
        $response = $this->actingAs($this->user)->postJson('api/specifications', [
            'item_id' => $item->id
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('specifications', 1);
    }

    public function test_update_specification_of_an_item(): void
    {
        $item = Item::factory()->create();
        $response = $this->actingAs($this->user)->postJson('api/specifications', [
            'item_id' => $item->id
        ]);

        $response = $this->actingAs($this->user)->putJson("api/specifications/{$response->json()['id']}", [
            'carat_weight' => 3
        ]);

        $this->assertEquals($response->json()['carat_weight'], 3);
    }
}

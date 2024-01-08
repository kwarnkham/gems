<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->user = User::query()->first();
    }

    public function test_create_an_item()
    {
        $item = [
            'name' => $this->faker()->unique()->name(),
            'description' => $this->faker()->sentence()
        ];

        $response = $this->actingAs($this->user)->postJson('api/items', $item);
        $response->assertCreated();
        $this->assertDatabaseCount('items', 1);
    }
}

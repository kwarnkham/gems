<?php

namespace Tests\Feature;

use App\Enums\PreOrderStatus;
use App\Models\Contact;
use App\Models\PreOrder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PreOrderTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->user = User::query()->first();
    }

    public function test_create_a_pre_order(): void
    {
        $preOrder = PreOrder::factory()->make();
        $this->actingAs($this->user)->postJson('api/pre-orders', [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            ...$preOrder->toArray()
        ])->assertCreated();

        $this->assertDatabaseCount('pre_orders', 1);
    }

    public function test_update_a_pre_order(): void
    {
        $contact = Contact::query()->create(['name' => fake()->name(), 'phone' => fake()->phoneNumber()]);
        $preOrder = PreOrder::factory()->create(['contact_id' => $contact->id]);
        $updatedPreOrder = PreOrder::factory()->make();
        $response = $this->actingAs($this->user)->putJson('api/pre-orders/' . $preOrder->id, $updatedPreOrder->toArray());
        $response->assertOk();
        $this->assertEquals($updatedPreOrder->carat, $response->json()['carat']);
    }

    public function test_get_a_pre_order(): void
    {
        $contact = Contact::query()->create(['name' => fake()->name(), 'phone' => fake()->phoneNumber()]);
        $preOrder = PreOrder::factory()->create(['contact_id' => $contact->id]);
        $response = $this->actingAs($this->user)->getJson('api/pre-orders/' . $preOrder->id);
        $response->assertOk();
    }

    public function test_list_pre_orders(): void
    {
        $response = $this->actingAs($this->user)->getJson('api/pre-orders');
        $response->assertOk();
    }

    public function test_complete_a_pre_order(): void
    {
        $contact = Contact::query()->create(['name' => fake()->name(), 'phone' => fake()->phoneNumber()]);
        $preOrder = PreOrder::factory()->create(['contact_id' => $contact->id]);
        $response = $this->actingAs($this->user)->postJson("api/pre-orders/{$preOrder->id}/status", [
            'status' => PreOrderStatus::COMPLETED->value
        ]);
        $response->assertOk();
        $this->assertEquals($preOrder->fresh()->status, PreOrderStatus::COMPLETED->value);
    }
}

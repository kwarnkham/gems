<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeetTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->user = User::query()->first();
    }

    public function test_create_a_meet(): void
    {
        $contact = Contact::factory()->create();
        $response = $this->actingAs($this->user)->postJson('api/meets', [
            'contact_id' => $contact->id,
            'note' => fake()->sentence()
        ]);

        $response->assertCreated();
    }
}

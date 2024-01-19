<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->user = User::query()->first();
    }

    public function test_make_a_contact()
    {
        $contact = Contact::factory()->make();

        $this->postJson('api/contacts', $contact->toArray())->assertCreated();

        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_list_contacts()
    {
        $this->actingAs($this->user)->getJson('api/contacts')->assertOk();
    }

    public function test_find_a_contact()
    {
        $contact = Contact::factory()->create();
        $this->actingAs($this->user)->getJson("api/contacts/{$contact->id}")->assertOk();
    }
}

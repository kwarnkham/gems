<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_make_a_contact()
    {
        $this->postJson('api/contacts', [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'message' => fake()->sentence(),
        ])->assertCreated();

        $this->assertDatabaseCount('contacts', 1);
    }
}

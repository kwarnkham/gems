<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_login()
    {
        $this->postJson('api/login', [
            'name' => 'admin',
            'password' => 'password',
        ])->assertOk();
    }

    public function test_logout()
    {
        $data = $this->postJson('api/login', [
            'name' => 'admin',
            'password' => 'password',
        ])->json();

        $this->actingAs(User::query()->find($data['user']['id']))->postJson('api/logout')->assertOk();
    }
}

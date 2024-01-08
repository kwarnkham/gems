<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PictureTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->user = User::query()->first();
    }

    public function test_add_pictures_to_an_item()
    {
        $item = Item::factory()->create();
        $pictures = [UploadedFile::fake()->image('1.jpg'), UploadedFile::fake()->image('2.png')];
        $response = $this->actingAs($this->user)->postJson("api/items/{$item->id}/pictures", [
            'pictures' => $pictures
        ]);

        $response->assertCreated();

        $this->assertDatabaseCount('pictures', count($pictures));
        // dump(Picture::first()->getRawOriginal('name'));
    }

    public function test_remove_a_picture_from_an_item()
    {
        $item = Item::factory()->create();
        $pictures = [UploadedFile::fake()->image('1.jpg'), UploadedFile::fake()->image('2.png')];
        $this->actingAs($this->user)->postJson("api/items/{$item->id}/pictures", [
            'pictures' => $pictures
        ]);

        $response = $this->actingAs($this->user)->deleteJson("api/pictures/{$item->pictures()->first()->id}");
        $response->assertOk();

        $this->assertDatabaseCount('pictures', count($pictures) - 1);
    }
}

<?php

namespace Tests\Feature;

use App\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class PhotoDetailApiTest
 * @package Tests\Feature
 */
class PhotoDetailApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function should_return_the_correct_json()
    {
        factory(Photo::class)->create();
        $photo = Photo::first();

        $response = $this->json('GET', route('photo.show', [
            'id' => $photo->id,
        ]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $photo->id,
                'url' => $photo->url,
                'owner' => [
                    'name' => $photo->owner->name,
                ],
            ]);
    }
}

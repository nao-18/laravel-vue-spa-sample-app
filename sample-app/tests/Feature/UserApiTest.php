<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class UserApiTest
 * @package Tests\Feature
 */
class UserApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed 
     */
    private $user;

    /**
     * @void
     */
    public function setUp(): void
    {
        parent::setUp();
        // create a test user.
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function should_get_login_user()
    {
        $response = $this->actingAs($this->user)->json('GET', route('user'));
        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => $this->user->name,
            ]);
    }

    /**
     * @test
     */
    public function should_get_an_empty_string_if_you_are_not_logged_in()
    {
        $response = $this->json('GET', route('user'));
        $response->assertStatus(200);
        $this->assertEquals("", $response->content());
    }
}

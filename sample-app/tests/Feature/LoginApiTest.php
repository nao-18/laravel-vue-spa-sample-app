<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class LoginApiTest
 * @package Tests\Feature
 */
class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * a test user
     * @var User|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed 
     */
    private User $user;

    /**
     * @void
     */
    public function setUp(): void
    {
        parent::setUp();
        // create a test user
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function should_authentication_registered_user()
    {
        $response = $this->json('POST', route('login'),[
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['name' => $this->user->name]);

        $this->assertAuthenticatedAs($this->user);
    }
}

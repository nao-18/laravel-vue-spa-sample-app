<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class LogoutApiTest
 * @package Tests\Feature
 */
class LogoutApiTest extends TestCase
{
    use RefreshDatabase;

    /**
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
    public function should_logout_user()
    {
        $response = $this->actingAs($this->user)
            ->json('POST', route('logout'));

        $response->assertStatus(200);
        $this->assertGuest();
    }
}

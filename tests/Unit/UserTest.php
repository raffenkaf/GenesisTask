<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testPositiveCreateUser()
    {
        $response = $this->json('POST', '/api/users', ['name' => 'Vasilij']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'name' => 'Vasilij',
                'bonus_balance' => 0
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Vasilij'
        ]);
    }

    public function testPositiveUpdateUser()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->withHeaders(['User-Id' => $user->id])
            ->json('PUT', '/api/users/' . $user->id, ['name' => 'Petr']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Petr',
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Petr'
        ]);
    }

    public function testNegativeAuthRestrict()
    {
        $user = factory(User::class)->create();

        $showResponse = $this->json('GET', '/api/users/' . $user->id);

        $showResponse->assertStatus(401);
    }

    public function testPositiveAuthRestrict()
    {
        $user = factory(User::class)->create();

        $showResponse = $this
            ->withHeaders(['User-Id' => $user->id])
            ->json('GET', '/api/users/' . $user->id);

        $showResponse->assertStatus(200)
            ->assertJson([
                'name' => $user->name,
            ]);
    }
}

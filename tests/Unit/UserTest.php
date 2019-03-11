<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function positiveCreateUserTest()
    {
        $response = $this->json('POST', '/api/users', ['name' => 'Vasilij']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Vasilij',
                'bonus_balance' => 0
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Vasilij'
        ]);
    }


}

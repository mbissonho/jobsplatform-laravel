<?php

namespace Tests\Feature\Api;

use Illuminate\Support\Arr;
use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{

    protected $userData = [
        'name' => 'John Doe',
        'email' => 'johndoe@mail.com',
        'password' => '12345678',
        'password_confirmation' => '12345678'
    ];

    public function test_user_can_register()
    {
        $this->postJson(
            route('api.auth.candidate.register'),
            $this->userData
        )
        ->assertCreated();

        $this->assertDatabaseHas('users', ['email' => 'johndoe@mail.com']);
    }

    public function test_user_cannot_register_with_a_already_taken_email()
    {
        User::factory()->create(Arr::only($this->userData, ['name', 'email']));

        $this->postJson(
            route('api.auth.candidate.register'),
            $this->userData
        )
        ->assertUnprocessable();
    }

}

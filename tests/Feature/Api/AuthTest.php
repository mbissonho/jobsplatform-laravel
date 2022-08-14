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

    public function test_user_can_register_yourself()
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
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);
    }

    public function test_user_can_login_and_receive_a_token_by_passing_valid_credentials()
    {
        $this->registerWithUserData();

        $this->postJson(
            route('api.auth.candidate.login'),
            Arr::only($this->userData, ['email', 'password'])
        )
        ->assertOk()
        ->assertSee('plainTextToken');
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $this->postJson(
            route('api.auth.candidate.login'),
            ['email' => 'invalid@mail.com', 'password' => 'wrong']
        )
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['user']);
    }

    /**
     * @param array $userData
     * @return false|string
     */
    private function registerWithUserData(array $userData = []): bool|string
    {
        if(empty($userData)) {
            $userData = $this->userData;
        }

        return $this->postJson(
            route('api.auth.candidate.register'),
            $userData
        )->getContent();
    }

}

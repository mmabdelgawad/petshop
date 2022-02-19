<?php

namespace Tests\Feature\Auth;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_missing_email_and_password_validation()
    {
        $response = $this->json('POST', self::API_PREFIX.'/user/login');
        $response
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('email')
            ->assertJsonValidationErrorFor('password');
    }

    public function test_user_not_found()
    {
        $response = $this->json('POST', self::API_PREFIX.'/user/login', [
            'email' => 'petshop@buckhill.com',
            'password' => 'password',
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'User not found'
            ]);
    }

    public function test_successful_login()
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->json('POST', self::API_PREFIX.'/user/login', [
            'email' => 'petshop@buckhill.com',
            'password' => 'password',
        ]);

        $response
            ->assertStatus(200)
            ->assertSee('token');
    }
}

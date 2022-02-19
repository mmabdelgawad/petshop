<?php

namespace Tests\Unit\Auth;

use App\Repositories\UserRepository;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    private UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = app(UserRepository::class);
    }

    public function test_failed_find_by_email_and_password()
    {
        $response = $this->userRepository->findByEmailAndPassword("", "");
        self::assertNull($response);
    }

    public function test_success_find_by_email_and_password()
    {
        $this->seed(UserSeeder::class);
        $response = $this->userRepository->findByEmailAndPassword("petshop@buckhill.com", "password");
        self::assertModelExists($response);
    }

    public function test_update_last_login_at()
    {
        $this->seed(UserSeeder::class);
        $user = $this->userRepository->findByEmailAndPassword("petshop@buckhill.com", "password");
        $this->userRepository->updateLastLoginAt($user);
        self::assertTrue($user->wasChanged('last_login_at'));
    }

    public function test_get_user_by_uuid()
    {
        $this->seed(UserSeeder::class);
        $user = $this->userRepository->findByEmailAndPassword("petshop@buckhill.com", "password");
        $response = $this->userRepository->getUserByUuid($user->uuid);
        self::assertModelExists($response);
    }
}

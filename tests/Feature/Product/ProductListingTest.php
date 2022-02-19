<?php

namespace Tests\Feature\Product;

use App\Services\UserService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductListingTest extends TestCase
{
    use RefreshDatabase;

    private UserService $userService;

    public function test_success_product_list()
    {
        $this->seed(DatabaseSeeder::class);

        $token = $this->userService->login("petshop@buckhill.com", "password");

        $response = $this->json('GET', self::API_PREFIX . '/products', [], [
            'Authorization' => "Bearer {$token}"
        ]);

        $response
            ->assertStatus(200);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = app(UserService::class);
    }
}

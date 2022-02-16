<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // seed new users
        User::factory(1)->create([
            'first_name' => 'petshop',
            'last_name' => 'buckhill',
            'email' => 'petshop@buckhill.com',
            'is_admin' => 0,
            'email_verified_at' => now(),
            'last_login_at' => null,
            'is_marketing' => 0,
        ]);
        User::factory(9)->create();

        // seed brands and categories
        Brand::factory(10)->create();
        $uuids = Category::factory(10)->create()->pluck('uuid')->toArray();

        // seed products
        foreach ($uuids as $uuid) {
            Product::factory(10)->create([
                'category_uuid' => $uuid,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uuids = Category::query()->pluck('uuid')->toArray();
        foreach ($uuids as $uuid) {
            Product::factory(10)->create([
                'category_uuid' => $uuid,
            ]);
        }
    }
}

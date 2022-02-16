<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brands = Brand::query()->pluck('uuid')->toArray();
        return [
            'uuid' => $this->faker->uuid(),
            'title' => $this->faker->name,
            'price' => $this->faker->numberBetween(10, 99),
            'description' => $this->faker->paragraph(10),
            'metadata' => json_encode(['brand' => $this->faker->randomElement($brands)]),
        ];
    }
}

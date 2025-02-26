<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(10, 500),
            'old_price' => $this->faker->numberBetween(500, 1000),
            'sizes' => [
                ['price' => $this->faker->numberBetween(50, 200), 'size' => '500 pellets'],
                ['price' => $this->faker->numberBetween(200, 400), 'size' => '110 pellets'],
                ['price' => $this->faker->numberBetween(400, 600), 'size' => '300 pellets']
            ],
            'product_details' => $this->faker->sentence(),
            'ingredients' => $this->faker->words(5, true),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'brand_name' => $this->faker->company(),
            'rating' => $this->faker->randomFloat(1, 0, 5),
            'rating_count' => $this->faker->numberBetween(100, 1000),
            'review_count' => $this->faker->numberBetween(50, 500),
            'image' => $this->faker->imageUrl(400, 400, 'products', true, 'Faker'),
            'sub_category_id' => SubCategory::inRandomOrder()->first()->id ?? 1,
        ];
    }
}

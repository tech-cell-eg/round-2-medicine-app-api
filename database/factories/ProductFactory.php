<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(10, 500),
            'product_details' => $this->faker->sentence(),
            'ingredients' => $this->faker->words(5, true),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'brand_name' => $this->faker->company(),
            'rating' => $this->faker->randomFloat(1, 0, 5), 
        ];
    }
}

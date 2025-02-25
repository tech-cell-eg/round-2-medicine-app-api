<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
            'user_name' => $this->faker->name(),
            'comment' => $this->faker->sentence(10),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}

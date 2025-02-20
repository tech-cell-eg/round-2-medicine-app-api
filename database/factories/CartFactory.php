<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;

class CartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}

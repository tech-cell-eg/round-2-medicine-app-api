<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'type' => $this->faker->randomElement(['order', 'message', 'alert']),
            'notifiable_id' => $this->faker->randomNumber(),
            'notifiable_type' => 'App\\Models\\User', 
            'data' => json_encode(['message' => $this->faker->sentence]),
            'read_at' => $this->faker->boolean ? now() : null,
        ];
    }
}

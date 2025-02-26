<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'type' => $this->faker->randomElement(['order', 'message', 'alert']),
            'notifiable_id' => User::inRandomOrder()->first()->id, 
            'notifiable_type' => User::class, 
            'data' => $this->faker->sentence, 
            'read_at' => $this->faker->boolean ? now() : null,
        ];
    }
}

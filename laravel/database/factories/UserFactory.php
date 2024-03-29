<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->email(),
            'name' => $this->faker->name(),
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'settings' => $this->faker->randomNumber(),
        ];
    }
}

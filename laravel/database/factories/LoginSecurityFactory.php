<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoginSecurityFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'google2fa_enable' => $this->faker->boolean(),
            'user_id' => User::factory(),
        ];
    }
}

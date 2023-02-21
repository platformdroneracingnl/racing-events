<?php

namespace Database\Factories;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'registration_reg_id' => Registration::factory(),
        ];
    }
}

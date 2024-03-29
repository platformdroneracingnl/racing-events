<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'failsafe' => $this->faker->boolean(),
            'reg_id' => $this->faker->unique()->integer,
            'status_id' => \App\Models\Status::factory(),
            'user_id' => \App\Models\User::factory(),
            'vtx_power' => $this->faker->boolean(),
        ];
    }
}

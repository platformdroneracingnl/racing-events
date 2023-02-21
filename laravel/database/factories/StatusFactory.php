<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'registration_reg_id' => Registration::factory(),
        ];
    }
}

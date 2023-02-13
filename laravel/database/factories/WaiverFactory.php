<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Models\Waiver;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaiverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => Event::factory(),
            'option_1' => $this->faker->boolean(),
            'option_2' => $this->faker->boolean(),
            'option_3' => $this->faker->boolean(),
            'registration_id' => Registration::factory(),
            'user_id' => User::factory(),
            'registration_reg_id' => Registration::factory(),
        ];
    }
}

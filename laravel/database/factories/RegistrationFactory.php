<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Registration;

class RegistrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Registration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'failsafe' => $this->faker->boolean,
            'reg_id' => $this->faker->unique()->integer,
            'status_id' => \App\Models\Status::factory(),
            'user_id' => \App\Models\User::factory(),
            'vtx_power' => $this->faker->boolean,
        ];
    }
}
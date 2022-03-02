<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Waiver;

class WaiverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Waiver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'option_1' => $this->faker->boolean,
            'option_2' => $this->faker->boolean,
            'option_3' => $this->faker->boolean,
            'registration_id' => \App\Models\Registration::factory(),
            'user_id' => \App\Models\User::factory(),
            'registration_reg_id' => \App\Models\Registration::factory(),
        ];
    }
}

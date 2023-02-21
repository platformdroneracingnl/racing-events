<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category' => $this->faker->word(),
            'date' => $this->faker->date(),
            'description' => $this->faker->text(),
            'end_registration' => $this->faker->dateTime(),
            'google_calendar' => $this->faker->boolean(),
            'location_id' => Location::factory(),
            'max_registrations' => $this->faker->randomNumber(),
            'mollie_payments' => $this->faker->boolean(),
            'name' => $this->faker->name(),
            'online' => $this->faker->boolean(),
            'price' => $this->faker->numberBetween($min = 0, $max = 100),
            'registration' => $this->faker->boolean(),
            'start_registration' => $this->faker->dateTime(),
            'user_id' => User::factory(),
            'waitlist' => $this->faker->boolean(),
        ];
    }
}

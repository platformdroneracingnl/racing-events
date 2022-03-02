<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category' => $this->faker->word,
            'city' => $this->faker->city,
            'country' => 151,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'name' => $this->faker->name,
            'province' => $this->faker->word,
            'street' => $this->faker->word,
            'zip_code' => $this->faker->postcode,
            'event_id' => \App\Models\Event::factory(),
        ];
    }
}

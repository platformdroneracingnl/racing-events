<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->name,
            'street' => $this->faker->word,
            'zip_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'province' => $this->faker->word,
            'country_id' => Country::factory(),
            'category' => $this->faker->word,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'street' => $this->faker->word(),
            'zip_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'province' => $this->faker->word(),
            'country_id' => Country::factory(),
            'category' => $this->faker->word(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}

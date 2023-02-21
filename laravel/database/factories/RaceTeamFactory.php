<?php

namespace Database\Factories;

use App\Models\RaceTeam;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class RaceTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'image' => UploadedFile::fake()->image('raceteam.png'),
        ];
    }
}

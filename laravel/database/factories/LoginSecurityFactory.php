<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LoginSecurity;

class LoginSecurityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoginSecurity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'google2fa_enable' => $this->faker->boolean,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\LoginSecurity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'google2fa_enable' => $this->faker->boolean(),
            'user_id' => User::factory(),
        ];
    }
}

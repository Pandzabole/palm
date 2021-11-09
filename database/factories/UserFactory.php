<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Admin',
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => 1,
            'role_id' => User::MAIN_ADMIN,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is suspended.
     *
     * @return Factory
     */
    public function roleSiteAdmin(): Factory
    {
        return $this->state([
            'role_id' => User::ADMIN,
        ]);
    }

    /**
     * Indicate that the user is suspended.
     *
     * @return Factory
     */
    public function roleMicroAdmin(): Factory
    {
        return $this->state([
            'role_id' => User::MICRO_ADMIN,
        ]);
    }
}

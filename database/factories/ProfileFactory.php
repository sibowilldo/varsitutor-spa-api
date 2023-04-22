<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'given_name' => $this->faker->firstName,
            'family_name' => $this->faker->lastName,
            'name' => $this->faker->name,
            'contact_number' => $this->faker->phoneNumber,
            'province_city' => 'KZN, '.$this->faker->randomElement(['PMB', 'Durban', 'Westville', 'Hillcrest'])
        ];
    }
}

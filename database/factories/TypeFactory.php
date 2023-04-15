<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    public static array $types = [
        ['id' => 1, 'name' => '3 Months Contract'],
        ['id' => 2, 'name' => '6 Months Contract'],
        ['id' => 3, 'name' => '1 Year Contract'],
        ['id' => 4, 'name' => '2 Year Contract'],
        ['id' => 5, 'name' => 'Permanent'],
        ['id' => 6, 'name' => 'Short-Term Contract'],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = $this->faker->unique()->randomElement(self::$types);

        return [
            'id' => $types['id'],
            'name' => $types['name'],
            'description' => $this->faker->realText(),
        ];
    }
}

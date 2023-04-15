<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public static array $categories = [
        ['id' => 1, 'name' => 'Tutor'],
        ['id' => 2, 'name' => 'Teaching Assistant'],
        ['id' => 3, 'name' => 'Research Assistant'],
        ['id' => 4, 'name' => 'Temp Lecturer'],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = $this->faker->unique()->randomElement(self::$categories);

        return [
            'id' => $categories['id'],
            'name' => $categories['name'],
            'description' => $this->faker->realText(),
        ];
    }
}

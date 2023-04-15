<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faculty>
 */
class FacultyFactory extends Factory
{
    public static array $faculties = [
        [
            'id' => 1,
            'name' => 'Faculty of Accounting and Informatics',
            'thumbnail_path' => '/images/faculties/fai.jpg',
        ],
        [
            'id' => 2,
            'name' => 'Faculty of Applied Sciences',
            'thumbnail_path' => '/images/faculties/fas.jpg',
        ],
        [
            'id' => 3,
            'name' => 'Faculty of Arts and Design',
            'thumbnail_path' => '/images/faculties/fad.jpg',
        ],
        [
            'id' => 4,
            'name' => 'Faculty of Engineering and the Built Environment',
            'thumbnail_path' => '/images/faculties/febe.jpg',
        ],
        [
            'id' => 5,
            'name' => 'Faculty of Health Sciences',
            'thumbnail_path' => '/images/faculties/fhs.jpg',
        ],
        [
            'id' => 6,
            'name' => 'Faculty of Management Sciences',
            'thumbnail_path' => '/images/faculties/fms.jpg',
        ],

    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faculties = $this->faker->unique()->randomElement(self::$faculties);

        return [
            'id' => $faculties['id'],
            'name' => $faculties['name'],
            'description' => $this->faker->realText(),
            'email' => $this->faker->safeEmail(),
            'contact_number' => $this->faker->phoneNumber(),
            'thumbnail_path' => $faculties['thumbnail_path'],
        ];
    }
}

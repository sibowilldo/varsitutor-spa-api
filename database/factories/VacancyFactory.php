<?php

namespace Database\Factories;

use App\Enums\LocationEnum;
use App\Enums\RolesEnum;
use App\Models\Category;
use App\Models\Department;
use App\Models\Status;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = [
            LocationEnum::RITSON->value,
            LocationEnum::ML_SULTAN->value,
            LocationEnum::STEVE_BIKO->value,
            LocationEnum::INDUMISO->value,
        ];

        return [
            'user_id' => User::role(RolesEnum::TEACHER->value)->inRandomOrder()->first()->id,
            'department_id' => Department::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'type_id' => Type::inRandomOrder()->first()->id,
            'status_id' => Status::where('model_type', 'vacancies')->inRandomOrder()->first()->id,
            'title' => $this->faker->realText(25),
            'description' => $this->faker->realText(),
            'location' => $this->faker->randomElement($locations),
            'expires_at' => $this->faker->dateTimeBetween(startDate: '1 days', endDate: rand(1, 7).' days'),
        ];
    }
}

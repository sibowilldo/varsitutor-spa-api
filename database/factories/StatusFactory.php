<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    public static array $statuses = [
        [
            'id' => 1,
            'name' => 'active',
            'model_type' => 'users',
            'priority' => 3],
        [
            'id' => 2,
            'name' => 'inactive',
            'model_type' => 'users',
            'priority' => 2],
        [
            'id' => 3,
            'name' => 'blocked',
            'model_type' => 'users',
            'priority' => 1],
        [
            'id' => 4,
            'name' => 'draft',
            'model_type' => 'vacancies',
            'priority' => 3],
        [
            'id' => 5,
            'name' => 'published',
            'model_type' => 'vacancies',
            'priority' => 3],
        [
            'id' => 6,
            'name' => 'approved',
            'model_type' => 'vacancies',
            'priority' => 3],
        [
            'id' => 7,
            'name' => 'rejected',
            'model_type' => 'vacancies',
            'priority' => 3],
        [
            'id' => 8,
            'name' => 'expired',
            'model_type' => 'vacancies',
            'priority' => 2],
        [
            'id' => 9,
            'name' => 'closed',
            'model_type' => 'vacancies',
            'priority' => 1],
        [
            'id' => 10,
            'name' => 'sent',
            'model_type' => 'applications',
            'priority' => 3],
        [
            'id' => 11,
            'name' => 'received',
            'model_type' => 'applications',
            'priority' => 3],
        [
            'id' => 12,
            'name' => 'rejected',
            'model_type' => 'applications',
            'priority' => 3],
        [
            'id' => 13,
            'name' => 'withdrawn',
            'model_type' => 'applications',
            'priority' => 3],
        [
            'id' => 14,
            'name' => 'shortlisted',
            'model_type' => 'applications',
            'priority' => 3],
        [
            'id' => 15,
            'name' => 'scheduled',
            'model_type' => 'applications',
            'priority' => 3],
        [
            'id' => 16,
            'name' => 'interview',
            'model_type' => 'applications',
            'priority' => 2],
        [
            'id' => 17,
            'name' => 'successful',
            'model_type' => 'applications',
            'priority' => 1],
        [
            'id' => 18,
            'name' => 'unsuccessful',
            'model_type' => 'applications',
            'priority' => 1],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->unique()->randomElement(self::$statuses);

        return [
            'id' => $status['id'],
            'name' => $status['name'],
            'model_type' => $status['model_type'],
            'description' => $this->faker->realText(),
            'priority' => $status['priority'],
        ];
    }
}

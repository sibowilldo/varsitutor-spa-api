<?php

namespace Database\Factories;

use App\Enums\InternalIdTypeEnum;
use App\Models\Status;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        list($intIdType, $internalId) = $this->generateUniqueInternalId();

        $email = $internalId.($intIdType->value ===  InternalIdTypeEnum::STAFF->value
            ? '@dut.ac.za'
            : '@dut4life.ac.za');

        return [
            'internal_identification' => $internalId,
            'internal_identification_type' => $intIdType,
            'email' => $email,
            'email_verified_at' => now(),
            'status_id' => Status::where('model_type', 'users')->inRandomOrder()->first()->id,
            'password' => '$2y$10$t8LKomqa/MbEmvMKW29M/.Sck23nWQtnR3NZKho99pSywHvi9WYE6',
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     */
    public function withPersonalTeam(callable $callback = null): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(fn (array $attributes, User $user) => [
                    'name' => $user->profile->name.'\'s Team',
                    'user_id' => $user->id,
                    'personal_team' => true,
                ])
                ->when(is_callable($callback), $callback),
            'ownedTeams'
        );
    }

    /**
     * @return array
     */
    public function generateUniqueInternalId(): array
    {
        $year = fake()->dateTimeBetween(startDate: '-10 years')->format('Y');
        $intIdType = fake()->randomElement([InternalIdTypeEnum::STAFF, InternalIdTypeEnum::STUDENT]);
        $preStudentNumber = substr($year, 0, 1) . substr($year, 2);

        $internalId = $intIdType->value === InternalIdTypeEnum::STAFF->value
            ? fake()->unique()->randomNumber(6, true)
            : $preStudentNumber . fake()->unique()->randomNumber(5, true);

        return [$intIdType, $internalId];
    }
}

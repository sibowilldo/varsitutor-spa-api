<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\InternalIdTypeEnum;
use App\Enums\RolesEnum;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            StatusSeeder::class,
            TypeSeeder::class,
            CategorySeeder::class,
            FacultySeeder::class,
            DepartmentSeeder::class,
        ]);

        $admin = User::factory()->has(
            Profile::factory()->count(1)
                ->state(function (array $attributes, User $user) {
                    return ['given_name' => 'Sibo', 'family_name' => 'Msomi', 'name'=>'S. Msomi'];
                }))->create([
            'email' => 'sibongiseni.msomi@outlook.com',
            'password' => '$2y$10$OBm9crEB50bQ8JerluBz5.oW0eugpAObE4kwuPzIGMGoGQpsceAPm']);

        $admin->assignRole(RolesEnum::ADMIN->value);

        // seed random students & staff
        $users = User::factory(60)->has(Profile::factory()->count(1))->create();

        foreach($users as $user){
            str($user->email)->contains('@dut.ac.za', true)
                ? $user->assignRole( fake()->randomElement([RolesEnum::TEACHER->value,RolesEnum::HOD->value]))
                : $user->assignRole( RolesEnum::APPLICANT->value);
        }


        $this->call([
            VacancySeeder::class,
        ]);
    }
}

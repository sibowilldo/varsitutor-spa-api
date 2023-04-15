<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        User::factory(10)->has(Profile::factory()->count(1))->create();

        $this->call([
            VacancySeeder::class,
        ]);
    }
}

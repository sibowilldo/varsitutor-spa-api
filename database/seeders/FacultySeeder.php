<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Database\Factories\FacultyFactory;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::factory(count(FacultyFactory::$faculties))->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Department;
use Database\Factories\DepartmentFactory;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory(count(DepartmentFactory::$departments))->create();

    }
}

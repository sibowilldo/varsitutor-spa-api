<?php

namespace Database\Seeders;

use App\Models\Type;
use Database\Factories\TypeFactory;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::factory(count(TypeFactory::$types))->create();
    }
}

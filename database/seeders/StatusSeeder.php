<?php

namespace Database\Seeders;

use App\Models\Status;
use Database\Factories\StatusFactory;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::factory(count(StatusFactory::$statuses))->create();
    }
}

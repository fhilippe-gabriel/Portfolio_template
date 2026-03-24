<?php

namespace Database\Seeders;

use App\Models\projects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        projects::factory(1)->create();
    }
}

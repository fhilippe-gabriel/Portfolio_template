<?php

namespace Database\Seeders;

use App\Models\contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        contact::factory(1)->create();
    }
}

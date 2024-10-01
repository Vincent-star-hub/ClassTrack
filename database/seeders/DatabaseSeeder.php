<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   public function run()
    {
        User::factory()->count(1)->create(['role' => 'admin']); // Create 1 admin
        User::factory()->count(5)->create(['role' => 'teacher']); // Create 5 teachers
    }
}

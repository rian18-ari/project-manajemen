<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'user1@test.com',
            'role' => 'member',
            'password' => bcrypt('password')
        ]);
        
        User::create([
            'name' => 'Test admin',
            'email' => 'admin@test.com',
            'role' => 'owner',
            'password' => bcrypt('password')
        ]);

        Project::create([
            'title' => 'Test Project 01',
            'description' => 'Test Project Description',
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-31',
            'color' => '#FF0000',
            'user_id' => 1,
            'is_completed' => false,
        ]);
        
        Project::create([
            'title' => 'Test Project 02',
            'description' => 'Test Project Description',
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-31',
            'color' => '#4A90E2',
            'user_id' => 1,
            'is_completed' => false,
        ]);

        Task::create([
            'title' => 'Test Task 01',
            'description' => 'Test Task Description',
            'is_completed' => false,
            'user_id' => 1,
            'project_id' => 1,
        ]);

        Task::create([
            'title' => 'Test Task 02',
            'description' => 'Test Task Description',
            'is_completed' => false,
            'user_id' => 1,
            'project_id' => 2,
        ]);
    }
}

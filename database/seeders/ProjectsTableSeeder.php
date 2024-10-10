<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        // Sample project data
        $projects = [
            [
                'name' => 'Project Alpha',
                'description' => 'This is the description for Project Alpha.',
                'cost' => 1000,
                'start_date' => now(),
                'deadline' => now()->addDays(30),
                'created_by' => 1, // Assuming the user with ID 1 exists
                'status_id' => 1,  // Assuming the status with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Beta',
                'description' => 'This is the description for Project Beta.',
                'cost' => 2000,
                'start_date' => now(),
                'deadline' => now()->addDays(60),
                'created_by' => 1,
                'status_id' => 2,  // Assuming the status with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Gamma',
                'description' => 'This is the description for Project Gamma.',
                'cost' => 1500,
                'start_date' => now(),
                'deadline' => now()->addDays(45),
                'created_by' => 1,
                'status_id' => 3,  // Assuming the status with ID 3 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Delta',
                'description' => 'This is the description for Project Delta.',
                'cost' => 1200,
                'start_date' => now(),
                'deadline' => now()->addDays(15),
                'created_by' => 1,
                'status_id' => 4,  // Assuming the status with ID 4 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Epsilon',
                'description' => 'This is the description for Project Epsilon.',
                'cost' => 3000,
                'start_date' => now(),
                'deadline' => now()->addDays(90),
                'created_by' => 1,
                'status_id' => 1,  // Assuming the status with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the data into the database
        DB::table('projects')->insert($projects);
    }
}

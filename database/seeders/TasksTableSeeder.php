<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        // بيانات المهام
        $tasks = [
            [
                'title' => 'Complete the project report',
                'description' => 'Finalize the project report and send it to the manager.',
                'due_date' => now()->addDays(7), // تاريخ الاستحقاق بعد 7 أيام
                'priority' => 'High',
                'category_id' => 1, // تأكد من وجود الفئة بهذا المعرف
                'status_id' => 1, // تأكد من وجود الحالة بهذا المعرف
                'assigned_to' => 1, // تأكد من وجود المستخدم بهذا المعرف
                'project_id' => 1, // تأكد من وجود المشروع بهذا المعرف
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Prepare presentation slides',
                'description' => 'Create slides for the upcoming presentation.',
                'due_date' => now()->addDays(3),
                'priority' => 'Medium',
                'category_id' => 2,
                'status_id' => 1,
                'assigned_to' => 2,
                'project_id' => 1,
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Schedule a team meeting',
                'description' => 'Set up a meeting with the team to discuss the next steps.',
                'due_date' => now()->addDays(1),
                'priority' => 'Low',
                'category_id' => 1,
                'status_id' => 1,
                'assigned_to' => 3,
                'project_id' => 1,
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Review code changes',
                'description' => 'Go through the latest code changes and provide feedback.',
                'due_date' => now()->addDays(4),
                'priority' => 'Medium',
                'category_id' => 3,
                'status_id' => 1,
                'assigned_to' => 1,
                'project_id' => 1,
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Test the application',
                'description' => 'Perform testing on the new application features.',
                'due_date' => now()->addDays(5),
                'priority' => 'High',
                'category_id' => 4,
                'status_id' => 1,
                'assigned_to' => 2,
                'project_id' => 1,
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tasks')->insert($tasks);
    }
}

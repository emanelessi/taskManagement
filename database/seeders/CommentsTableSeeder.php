<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        // بيانات التعليقات
        $comments = [
            [
                'comment' => 'This task needs immediate attention.',
                'task_id' => 1, // تأكد من وجود المهمة بهذا المعرف
                'created_by' => 1, // تأكد من وجود المستخدم بهذا المعرف
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'comment' => 'I have started working on this task.',
                'task_id' => 2,
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'comment' => 'Please review my progress on this task.',
                'task_id' => 3,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'comment' => 'I need some clarification on the requirements.',
                'task_id' => 4,
                'created_by' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'comment' => 'The deadline for this task is approaching.',
                'task_id' => 5,
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('comments')->insert($comments);
    }
}

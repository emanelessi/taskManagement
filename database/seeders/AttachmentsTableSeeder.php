<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttachmentsTableSeeder extends Seeder
{
    public function run()
    {
        // بيانات المرفقات
        $attachments = [
            [
                'file_path' => 'taskImage.svg',
                'task_id' => 1, // تأكد من وجود المهمة بهذا المعرف
                'uploaded_by' => 1, // تأكد من وجود المستخدم بهذا المعرف
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_path' => 'taskImage.svg',
                'task_id' => 2,
                'uploaded_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_path' => 'taskImage.svg',
                'task_id' => 3,
                'uploaded_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_path' => 'taskImage.svg',
                'task_id' => 4,
                'uploaded_by' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_path' => 'taskImage.svg',
                'task_id' => 5,
                'uploaded_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // إدخال البيانات في قاعدة البيانات
        DB::table('attachments')->insert($attachments);
    }
}

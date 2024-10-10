<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // بيانات المستخدمين
        $users = [
            [
                'name' => 'Admin',
                'image' => null,
                'email_verified_at' => now(),
                'email' => 'admin@admin.com',
                'password' =>  bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'User One',
                'image' => null,
                'email' => 'user1@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Two',
                'image' => null,
                'email' => 'user2@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Three',
                'image' => null,
                'email' => 'user3@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Four',
                'image' => null,
                'email' => 'user4@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password4'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Five',
                'image' => null,
                'email' => 'user5@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password5'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}

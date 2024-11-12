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
            ],
            [
                'name' => 'project manager',
                'image' => null,
                'email' => 'manager@admin.com',
                'email_verified_at' => now(),
                'password' =>  bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'team member1',
                'image' => null,
                'email' => 'member1@admin.com',
                'email_verified_at' => now(),
                'password' =>  bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'team member2',
                'image' => null,
                'email' => 'member2@admin.com',
                'email_verified_at' => now(),
                'password' =>  bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'team member3',
                'image' => null,
                'email' => 'member3@admin.com',
                'email_verified_at' => now(),
                'password' =>  bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'team member4',
                'image' => null,
                'email' => 'member4@admin.com',
                'email_verified_at' => now(),
                'password' =>  bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}

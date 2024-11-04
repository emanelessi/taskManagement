<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(AttachmentsTableSeeder::class);
        $this->call(RoleAndPermissionSeeder::class);

    }
}

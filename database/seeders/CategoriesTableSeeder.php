<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pending', 'status' => 'enable'],
            ['name' => 'Completed', 'status' => 'enable'],
            ['name' => 'Cancelled', 'status' => 'enable'],
            ['name' => 'Delayed', 'status' => 'enable'],
            ['name' => 'In Progress', 'status' => 'enable'],
        ];
        DB::table('categories')->insert($categories);

    }
}

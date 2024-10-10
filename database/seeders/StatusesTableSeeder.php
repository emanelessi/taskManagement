<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    public function run()
    {
        // Status data
        $statuses = [
            [
                'name' => 'Completed',
                'status' => 'enable',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cancelled',
                'status' => 'disable',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'In Progress',
                'status' => 'enable',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delayed',
                'status' => 'disable',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the data into the database
        DB::table('statuses')->insert($statuses);
    }
}

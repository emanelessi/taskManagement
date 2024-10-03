<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission1 = Permission::create(['name' => 'editor']);


        $role1 = Role::create(['name' => 'editor']);
        $role2 = Role::create(['name' => 'admin']);

        $role1->givePermissionTo($permission1);

        $role2->givePermissionTo(Permission::all());
    }
}

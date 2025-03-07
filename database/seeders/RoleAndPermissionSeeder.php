<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view dashboard',
            'view reports',
            'view project report',
            'view task report',
            'manage comments',
            'create comments',
            'edit comments',
            'delete comments',
            'manage projects',
            'create projects',
            'edit projects',
            'delete projects',
            'view project details',
            'manage statuses',
            'create statuses',
            'edit statuses',
            'delete statuses',
            'manage categories',
            'create categories',
            'edit categories',
            'delete categories',
            'manage tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'view task details',
            'manage users',
            'create users',
            'edit users',
            'delete users',
            'delete attachments',
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'project manager']);
        Role::create(['name' => 'team member']);

        $administrator = Role::findByName('administrator');
        $administrator->givePermissionTo(Permission::all());
        $adminUser =  User::where('email', 'admin@admin.com')->first();
        $adminUser->assignRole($administrator);

        $projectManager = Role::findByName('project manager');
        $projectManager->givePermissionTo(Permission::all());
        $managerUser =  User::where('email', 'manager@admin.com')->first();
        $managerUser->assignRole($projectManager);

        $teamMember = Role::findByName('team member');
        $teamMember->givePermissionTo([
            'view dashboard',
            'create comments',
            'manage projects',
            'manage settings',
            'manage tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'view project details',
            'view task details',
            'view reports',
            'view project report',
            'view task report',
        ]);
        $teamUsers = User::whereIn('email', ['member1@admin.com', 'member2@admin.com', 'member3@admin.com', 'member4@admin.com'])->get();

        foreach ($teamUsers as $teamUser) {
            $teamUser->assignRole('team member');
        }

    }
}

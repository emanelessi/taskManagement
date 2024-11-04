<?php

namespace Database\Seeders;

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

        // إنشاء الصلاحيات
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
            'manage settings',
        ];

        // إنشاء الصلاحيات
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // إنشاء الأدوار
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'project manager']);
        Role::create(['name' => 'team member']);

        // إعطاء الصلاحيات للأدوار
        $administrator = Role::findByName('administrator');
        $administrator->givePermissionTo(Permission::all()); // يعطي جميع الصلاحيات

        $projectManager = Role::findByName('project manager');
        $projectManager->givePermissionTo(Permission::all());

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
    }
}

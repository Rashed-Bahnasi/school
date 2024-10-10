<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view_employees', 
            'edit_employees', 
            'view_tasks', 
            'edit_tasks',
            'view_students',
            'edit_students',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'manager' => ['view_employees', 'edit_employees', 'view_tasks', 'edit_tasks', 'view_students', 'edit_students'],
            'supervisor' => ['view_students', 'edit_students', 'view_tasks', 'edit_tasks'],
            'admin_staff' => ['view_employees', 'view_tasks', 'view_students'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);

            $role->syncPermissions($rolePermissions);
        }
    }
}

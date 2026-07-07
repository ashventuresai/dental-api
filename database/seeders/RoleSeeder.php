<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionNames = ['Read', 'Create', 'Edit', 'Delete'];

        $permissions = collect($permissionNames)->map(function (string $permissionName): Permission {
            return Permission::firstOrCreate(
                ['name' => $permissionName, 'guard_name' => 'web'],
                ['name' => $permissionName, 'guard_name' => 'web']
            );
        });

        $rolePermissions = [
            'super admin' => $permissions->all(),
            'admin' => $permissions->all(),
            'doctor' => $permissions->all(),
            'staff' => $permissions->filter(function (Permission $permission): bool {
                return in_array($permission->name, ['Read', 'Create', 'Edit'], true);
            })->values()->all(),
            'patient' => [],
        ];

        foreach ($rolePermissions as $roleName => $permissionsForRole) {
            $role = Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => 'web'],
                ['name' => $roleName, 'guard_name' => 'web']
            );

            $role->syncPermissions($permissionsForRole);
        }
    }
}

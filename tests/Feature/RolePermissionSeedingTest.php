<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;

class RolePermissionSeedingTest extends TestCase
{
    use RefreshDatabase;

    public function test_roles_and_permissions_are_seeded_with_expected_access_levels(): void
    {
        if (!extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('PDO SQLite driver is required for this test.');
        }

        $this->seed([RoleSeeder::class, UserSeeder::class]);

        $this->assertDatabaseHas('roles', ['name' => 'super admin', 'guard_name' => 'web']);
        $this->assertDatabaseHas('roles', ['name' => 'admin', 'guard_name' => 'web']);
        $this->assertDatabaseHas('roles', ['name' => 'doctor', 'guard_name' => 'web']);
        $this->assertDatabaseHas('roles', ['name' => 'staff', 'guard_name' => 'web']);
        $this->assertDatabaseHas('roles', ['name' => 'patient', 'guard_name' => 'web']);

        $permissionNames = Permission::pluck('name')->all();
        $this->assertEqualsCanonicalizing(['Read', 'Create', 'Edit', 'Delete'], $permissionNames);

        $superAdminRole = Role::findByName('super admin');
        $adminRole = Role::findByName('admin');
        $doctorRole = Role::findByName('doctor');
        $staffRole = Role::findByName('staff');

        $this->assertTrue($superAdminRole->hasAllPermissions(['Read', 'Create', 'Edit', 'Delete']));
        $this->assertTrue($adminRole->hasAllPermissions(['Read', 'Create', 'Edit', 'Delete']));
        $this->assertTrue($doctorRole->hasAllPermissions(['Read', 'Create', 'Edit', 'Delete']));
        $this->assertTrue($staffRole->hasAllPermissions(['Read', 'Create', 'Edit']));
        $this->assertFalse($staffRole->hasPermissionTo('Delete'));
    }
}

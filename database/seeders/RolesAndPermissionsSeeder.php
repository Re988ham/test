<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $arrayOfPermissionsNames = [];

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'edit files', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete files', 'guard_name' => 'web']);
        Permission::create(['name' => 'upload files', 'guard_name' => 'web']);
        Permission::create(['name' => 'view files', 'guard_name' => 'web']);

        // Create roles and assign created permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $UserRole = Role::create(['name' => 'user']);
        $UserRole->givePermissionTo([
            'delete files',
            'edit files',
            'upload files',
            'view files',
        ]);

        $OwnerRole = Role::create(['name' => 'owner']);
        $OwnerRole->givePermissionTo([
                'delete files',
                'edit files',
                'upload files',
                'view files',
        ]);
    }
}

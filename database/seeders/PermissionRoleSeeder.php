<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'view users',
            'edit users',
            'create users',
            'delete users',
            'view roles',
            'edit roles',
            'create roles',
            'delete roles',
            'view permissions',
            'edit permissions',
            'create permissions',
            'delete permissions',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }

        // Create Superadmin role and assign all permissions
        $superadminRole = Role::firstOrCreate(
            ['name' => 'Superadmin', 'guard_name' => 'web']
        );
        $superadminRole->syncPermissions(Permission::all());

        // Create user
        $user = User::firstOrCreate(
            ['email' => 'st400971@gmail.com'],
            [
                'name' => 'Sandeep Timalsina',
                'password' => bcrypt('superuser@11'),
            ]
        );

        // Assign role to user
        $user->assignRole($superadminRole);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view_categories',
            'manage_categories',

            'view_menus',
            'manage_menus',

            'view_tables',
            'manage_tables',

            'view_bookings',
            'manage_bookings',

            'view_orders',
            'manage_orders',

            'view_payments',
            'manage_payments',

            'manage_users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
        ]);

        $kasir = Role::firstOrCreate([
            'name' => 'Kasir',
        ]);

        $admin->syncPermissions($permissions);

        $kasir->syncPermissions([
            'view_tables',

            'view_bookings',
            'manage_bookings',

            'view_orders',
            'manage_orders',

            'view_payments',
            'manage_payments',
        ]);
    }
}

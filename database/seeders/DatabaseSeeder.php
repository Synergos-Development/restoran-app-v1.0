<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);

        $admin = User::firstOrCreate(
            [
                'email' => 'admin@restoran.test',
            ],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
            ]
        );

        $kasir = User::firstOrCreate(
            [
                'email' => 'kasir@restoran.test',
            ],
            [
                'name' => 'Kasir',
                'password' => bcrypt('kasir123'),
            ]
        );

        $admin->assignRole('Admin');
        $kasir->assignRole('Kasir');
    }
}
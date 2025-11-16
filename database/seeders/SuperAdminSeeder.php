<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@bouyahya.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@bouyahya.com',
                'password' => bcrypt('admin123'),
                'role' => 'superadmin',
                'email_verified_at' => now(),
            ]
        );

        echo "Superadmin user created successfully!\n";
        echo "Email: admin@bouyahya.com\n";
        echo "Password: admin123\n";
    }
}

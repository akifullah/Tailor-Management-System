<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            TypeAndFieldSeeder::class,
        ]);

        // Create admin user first
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make("12345"),
                'role' => 'admin'
            ]
        );

        // Seed roles and permissions (this will assign admin role to admin user)
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}

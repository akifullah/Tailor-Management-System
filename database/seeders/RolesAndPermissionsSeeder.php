<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder creates all necessary permissions and roles for the application.
     * Admin role gets ALL permissions automatically.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create all Permissions
        $permissions = [
            'manage-users',
            'manage-customers',
            'manage-measurements',
            'manage-types',
            'manage-fields',
            'manage-brands',
            'manage-suppliers',
            'manage-categories',
            'manage-products',
            'manage-orders',
            'manage-purchases',
            'manage-payments',
            'view-reports',
            'manage-roles-permissions',
        ];

        $createdPermissions = [];
        foreach ($permissions as $permission) {
            $createdPermissions[] = Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }

        $this->command->info('Created ' . count($createdPermissions) . ' permissions.');

        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $managerRole = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // IMPORTANT: Assign ALL permissions to admin role
        // This ensures admin has access to everything, including any new permissions added later
        $allPermissions = Permission::where('guard_name', 'web')->get();
        $adminRole->syncPermissions($allPermissions);
        $this->command->info('Assigned all ' . $allPermissions->count() . ' permissions to admin role.');

        // Assign specific permissions to manager role
        $managerPermissions = [
            'manage-customers',
            'manage-measurements',
            'manage-products',
            'manage-orders',
            'view-reports',
        ];
        
        $managerPermissionModels = Permission::whereIn('name', $managerPermissions)
            ->where('guard_name', 'web')
            ->get();
        $managerRole->syncPermissions($managerPermissionModels);
        $this->command->info('Assigned ' . $managerPermissionModels->count() . ' permissions to manager role.');

        // Assign limited permissions to user role
        $userPermissions = [
            'view-reports',
        ];
        
        $userPermissionModels = Permission::whereIn('name', $userPermissions)
            ->where('guard_name', 'web')
            ->get();
        $userRole->syncPermissions($userPermissionModels);
        $this->command->info('Assigned ' . $userPermissionModels->count() . ' permissions to user role.');

        // Assign admin role to admin user(s)
        // Find all users with admin email or admin role in the old 'role' column
        $adminUsers = User::where(function($query) {
            $query->where('email', 'admin@gmail.com')
                  ->orWhere('role', 'admin');
        })->get();

        foreach ($adminUsers as $adminUser) {
            // Remove any existing roles and assign admin role
            $adminUser->syncRoles(['admin']);
            $this->command->info("Assigned admin role to user: {$adminUser->email}");
        }

        if ($adminUsers->isEmpty()) {
            $this->command->warn('No admin user found. Please create an admin user and assign the admin role manually.');
        }

        // Clear cache again to ensure fresh data
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $this->command->info('Roles and Permissions seeded successfully!');
    }
}


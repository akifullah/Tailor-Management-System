<?php

if (!function_exists('getFirstAccessibleRoute')) {
    /**
     * Get the first accessible route based on user permissions
     * 
     * @param \App\Models\User $user
     * @return string
     */
    function getFirstAccessibleRoute($user)
    {
        // Define routes in priority order with their required permissions
        $routes = [
            'reports.dashboard' => 'view-reports',
            'users.index' => 'manage-users',
            'customers.index' => 'manage-customers',
            'products.index' => 'manage-products',
            'orders.index' => 'manage-orders',
            'brands.index' => 'manage-brands',
            'categories.index' => 'manage-categories',
            'suppliers.index' => 'manage-suppliers',
            'measurements.create' => 'manage-measurements',
            'types.index' => 'manage-types',
            'fields.index' => 'manage-fields',
            'purchases.index' => 'manage-purchases',
            'roles.index' => 'manage-roles-permissions',
            'permissions.index' => 'manage-roles-permissions',
        ];

        // Check each route in priority order
        foreach ($routes as $route => $permission) {
            if ($user->can($permission)) {
                return route($route);
            }
        }

        // If no specific permission, default to dashboard (which should be accessible to all authenticated users)
        return route('dashboard');
    }
}


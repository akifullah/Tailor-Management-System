<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check permission
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'Unauthorized action.');
        }

        // Handle searching based on type/value from the request
        $query = User::query();

        $type = $request->input('type');
        $value = $request->input('value');

        if ($type && $value !== null && $value !== '') {
            // Only apply if both type and value are given
            if (in_array($type, ['name', 'id', 'phone', 'email'])) {
                if ($type === 'id') {
                    $query->where($type, $value);
                } else {
                    $query->where($type, 'like', '%' . $value . '%');
                }
            }
        }

        $data['users'] = $query->with(['roles', 'permissions'])->get();
        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();
        return view("admin.users.index", $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check permission
        if (!auth()->user()->can('manage-users')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "worker_type" => "required",
            "email" => "required|email|unique:users,email" . ($request->id ? ',' . $request->id : ''),
            "password" => ($request->id ? "nullable" : "required") . "|min:5"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation failed",
                "errors" => $validator->errors(),
            ]);
        }

        // Only take valid fields
        $userData = $request->only(['name', 'email', "phone", "address", "worker_type"]);

        // Handle password
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user = User::updateOrCreate(
            ['id' => $request->id],
            $userData
        );

        // Set session flash message for display after page refresh
        session()->flash('success', $request->id ? 'User updated successfully.' : 'User created successfully.');

        return response()->json([
            'success' => true,
            'message' => $request->id ? 'User updated successfully.' : 'User created successfully.',
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Check permission
        if (!auth()->user()->can('manage-users')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.',
            ], 403);
        }

        // Soft delete the user (uses Eloquent's SoftDeletes trait)
        $user = User::findOrFail($id);
        $user->delete(); // This will perform a soft delete

        // Set session flash message for display after page refresh
        session()->flash('success', 'User deleted successfully.');

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.',
        ]);
    }

    /**
     * Assign roles and permissions to a user
     */
    public function assignRolesPermissions(Request $request, User $user)
    {
        // Check permission
        if (!auth()->user()->can('manage-roles-permissions')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }

        // Sync roles
        if ($request->has('roles')) {
            $roles = Role::whereIn('id', $request->roles)->get();
            $user->syncRoles($roles);
        } else {
            $user->syncRoles([]);
        }

        // Sync permissions
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $user->syncPermissions($permissions);
        } else {
            $user->syncPermissions([]);
        }

        session()->flash('success', 'Roles and permissions assigned successfully.');

        return response()->json([
            'success' => true,
            'message' => 'Roles and permissions assigned successfully.',
            'user' => $user->load(['roles', 'permissions']),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check permission
        if (!auth()->user()->can('manage-roles-permissions')) {
            abort(403, 'Unauthorized action.');
        }

        $query = Role::query();

        $type = $request->input('type');
        $value = $request->input('value');

        if ($type && $value !== null && $value !== '') {
            if (in_array($type, ['name', 'id'])) {
                if ($type === 'id') {
                    $query->where($type, $value);
                } else {
                    $query->where($type, 'like', '%' . $value . '%');
                }
            }
        }

        $roles = $query->with('permissions')->get();
        $permissions = Permission::all();

        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed - using modal
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check permission
        if (!auth()->user()->can('manage-roles-permissions')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name' . ($request->id ? ',' . $request->id : ''),
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

        if ($request->id) {
            $role = Role::findOrFail($request->id);
            $role->name = $request->name;
            $role->save();
        } else {
            $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        }

        // Sync permissions
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }

        session()->flash('success', $request->id ? 'Role updated successfully.' : 'Role created successfully.');

        return response()->json([
            'success' => true,
            'message' => $request->id ? 'Role updated successfully.' : 'Role created successfully.',
            'role' => $role->load('permissions'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Not needed - using modal
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Using store method with id for updates
        $request->merge(['id' => $id]);
        return $this->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Check permission
        if (!auth()->user()->can('manage-roles-permissions')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.',
            ], 403);
        }

        $role = Role::findOrFail($id);
        
        // Check if role is assigned to any user
        if ($role->users()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete role. It is assigned to one or more users.',
            ], 422);
        }

        $role->delete();

        session()->flash('success', 'Role deleted successfully.');

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully.',
        ]);
    }
}


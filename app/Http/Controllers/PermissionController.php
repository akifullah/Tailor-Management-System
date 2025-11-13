<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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

        $query = Permission::query();

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

        $permissions = $query->get();

        return view('admin.permissions.index', compact('permissions'));
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
            'name' => 'required|string|unique:permissions,name' . ($request->id ? ',' . $request->id : ''),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }

        if ($request->id) {
            $permission = Permission::findOrFail($request->id);
            $permission->name = $request->name;
            $permission->save();
        } else {
            $permission = Permission::create(['name' => $request->name, 'guard_name' => 'web']);
        }

        session()->flash('success', $request->id ? 'Permission updated successfully.' : 'Permission created successfully.');

        return response()->json([
            'success' => true,
            'message' => $request->id ? 'Permission updated successfully.' : 'Permission created successfully.',
            'permission' => $permission,
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
        $permission = Permission::findOrFail($id);
        return response()->json($permission);
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

        $permission = Permission::findOrFail($id);
        
        // Check if permission is assigned to any role
        if ($permission->roles()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete permission. It is assigned to one or more roles.',
            ], 422);
        }

        $permission->delete();

        session()->flash('success', 'Permission deleted successfully.');

        return response()->json([
            'success' => true,
            'message' => 'Permission deleted successfully.',
        ]);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["users"] = User::get();
        // return $data;
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
        $validator = Validator::make($request->all(), [
            "name" => "required",
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
        $userData = $request->only(['name', 'email']);

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
}

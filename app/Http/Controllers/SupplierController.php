<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["suppliers"] = Supplier::latest()->get();
        return view("admin.suppliers.index", $data);
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
        $validate = Validator::make($request->all(), [
            "name" => "required",
            "email" => "nullable|email",
            "phone" => "required"
        ]);
        if ($validate->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Failed.",
                "errors" => $validate->errors()
            ]);
        }
        $supplierData = $request->only(['name', 'email', 'address', 'phone']);

        $supplier = Supplier::updateOrCreate(
            ['id' => $request->id],
            $supplierData
        );
        session()->flash('success', $request->id ? 'Supplier updated successfully.' : 'Supplier created successfully.');
        return response()->json([
            'success' => true,
            "message" => $request->id ? 'Supplier updated successfully.' : 'Supplier created successfully.',
            'data' => $supplier,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $delete =   $supplier->delete();
        if (!$delete) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier deletion failed.',
            ]);
        }
        session()->flash('success', 'Supplier deleted successfully.');
        return response()->json([
            'success' => true,
            'message' => 'Supplier deleted successfully.',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
        $type = $request->input('type');
        $value = $request->input('value');

        if ($type && $value !== null && $value !== '') {
            if ($type === 'name') {
                $query->where('name', 'like', '%' . $value . '%');
            } elseif ($type === 'id') {
                $query->where('id', $value);
            }
        }

        $categories = $query->get();
        return view('admin.categories.index', compact('categories'));
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
            'name' => [
                "required",
                Rule::unique('categories', 'name')->ignore($request->id),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Failed.",
                "errors" => $validator->errors()
            ]);
        }

        $categoryData = $request->only(['name']);
        $category = Category::updateOrCreate(
            ['id' => $request->id],
            $categoryData
        );
        session()->flash('success', $request->id ? 'Category updated successfully.' : 'Category created successfully.');
        return response()->json([
            'success' => true,
            "message" => $request->id ? 'Category updated successfully.' : 'Category created successfully.',
            'data' => $category,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $delete =   $category->delete();
        if (!$delete) {
            return response()->json([
                'success' => false,
                'message' => 'Category could not be deleted.',
            ]);
        }
        session()->flash('success', 'Category deleted successfully.');
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.',
        ]);
    }
}

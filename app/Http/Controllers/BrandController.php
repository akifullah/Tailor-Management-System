<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }


    public function index()
    {
        $brands = $this->brandService->getAll();

        return view('admin.brands.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => [
                "required",
                Rule::unique('brands', 'name')->ignore($request->id),
            ],
            'description' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Failed.",
                "errors" => $validate->errors()
            ]);
        }

        $data = $request->only(['name', 'description']);
        if (!$request->id) {
            $data['created_by'] = Auth::user()->name ?? null;
        }

        $brand = Brand::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        session()->flash('success', $request->id ? 'Brand updated successfully.' : 'Brand created successfully.');
        return response()->json([
            'success' => true,
            "message" => $request->id ? 'Brand updated successfully.' : 'Brand created successfully.',
            'data' => $brand,
        ]);
    }

    public function show($id)
    {
        $brand = $this->brandService->find($id);
        if ($brand) {
            return response()->json($brand);
        }
        return response()->json(['message' => 'Brand not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'description']);
        $brand = $this->brandService->update($id, $data);
        if ($brand) {
            return response()->json($brand);
        }
        return response()->json(['message' => 'Brand not found'], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->brandService->delete($id);
        if ($deleted) {
            session()->flash("success", "Brand deleted successfully.");
            return response()->json(
                [
                    "success" => true,
                    'message' => 'Brand deleted successfully'
                ]
            );
        }
        return response()->json(
            [
                "success" => false,
                'message' => 'Brand not found'
            ],
            404
        );
    }
}

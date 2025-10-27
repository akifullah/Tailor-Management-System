<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\options;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["types"] = Type::get();
        // return $data;
        return view("admin.types.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                "name" => "required|unique:types,name," . $request->id,
                "name_prefix" => "required"
            ]
        );

        if ($validate->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation failed",
                "errors" => $validate->errors(),
            ]);
        }

        if ($request->has('combine')) {
            $request->merge([
                'combine' => json_encode(explode(',', $request->combine))
            ]);
        }

        $data = $request->except(['_token', 'id']);

        $type = Type::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        return response()->json([
            "success" => true,
            "message" => "type added succesfully",
            "data" => $type
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        return $request->all();
        $validate = Validator::make(
            $request->all(),
            [
                "name" => "required|unique:types,name," . $request->id,
                "name_prefix" => "required"
            ]
        );

        if ($validate->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation failed",
                "errors" => $validate->errors(),
            ]);
        }

        if ($request->has('combine')) {
            $request->merge(['combine' => json_encode(explode(',', $request->combine))]);
        }

        $updated = $type->update($request->all());

        if (! $updated) {
            return response()->json([
                "success" => false,
                "message" => "Failed to update type",
            ], 500);
        }

        return response()->json([
            "success" => true,
            "message" => "Type updated successfully",
            "data" => $type->fresh()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        //
    }


    // public function getType($name)
    // {
    //     $type = Type::with('fields')->where('name', $name)->first();

    //     if (!$type) {
    //         return response()->json(['message' => 'Type not found'], 404);
    //     }

    //     $combine = is_array($type->combine)
    //         ? $type->combine
    //         : (json_decode($type->combine, true) ?? []);

    //     // If type has combine items, load their fields too
    //     $combinedFields = [];
    //     if (!empty($combine)) {
    //         $combinedTypes = Type::with('fields')
    //             ->whereIn('name', $combine)
    //             ->get();

    //         foreach ($combinedTypes as $combinedType) {
    //             $combinedFields[$combinedType->name] = $combinedType->fields;
    //         }
    //     }else{
    //          $combinedFields[$type->name] = $type->fields;
    //     }

    //     return response()->json([
    //         'fields' => $combinedFields, // might be empty for combined types
    //         'combine' => $combine,
    //         'combined_fields' => $combinedFields, // extra combined data
    //     ]);
    // }

    public function getType()
    {
        $types = Type::with('fields')->get();

        $result = $types->mapWithKeys(function ($type) {
            // if it's a combined type
            if ($type->is_combined && $type->combine) {
                return [
                    $type->name => [
                        'combine' => json_decode($type->combine)
                    ]
                ];
            }

            // regular type
            return [
                $type->name => [
                    'fields' => $type->fields
                ]
            ];
        });
        return  $result;
        return response()->json([
            "options" => $result
        ]);

        if (!$type) {
            return response()->json(['error' => 'Type not found'], 404);
        }

        $combine = $type->combine; // ✅ already array
        $combinedFields = [];

        if (!empty($combine)) {
            $combinedTypes = Type::with('fields')
                ->whereIn('name', $combine)
                ->get();

            $key = implode('_', $combine); // e.g. "kameez_shalwar"
            $combinedFields[$key] = [
                'combine' => $combine,
                'fields' => $combinedTypes->flatMap->fields->values(),
            ];
        } else {
            $combinedFields[$type->name] = [
                'fields' => $type->fields,
            ];
        }

        return response()->json($combinedFields);
    }
}

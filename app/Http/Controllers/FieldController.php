<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Type;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["types"] = Type::get();
        return view('admin.types.fields', $data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Field $field)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Field $field)
    {
        //
    }


    public function getFieldsByTypeId($id)
    {
        $fields = Field::where('type_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $fields
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkerType;
use Illuminate\Support\Facades\Validator;
class WorkerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workerTypes = WorkerType::all();
        return view('admin.worker_types.index', compact('workerTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.worker_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'type' => 'required|unique:worker_types,type',
            'description' => 'nullable',
            'worker_cost' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }


        $workerType = WorkerType::create($request->all());
        return redirect()->route('workers.types.index')->with('success', 'Worker type created successfully');
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
        $workerType = WorkerType::find($id);
        return view('admin.worker_types.edit', compact('workerType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'type' => 'required|unique:worker_types,type,' . $id,
            'description' => 'nullable',
            'worker_cost' => 'required|numeric',
        ]);

        
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $workerType = WorkerType::find($id);
        $workerType->update($request->all());

        // Update all users' worker_cost where worker_type_id matches the updated WorkerType's id
        \App\Models\User::where('worker_type_id', $workerType->id)
            ->update(['worker_cost' => $workerType->worker_cost]);
        
        return redirect()->route('workers.types.index')->with('success', 'Worker type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($workerType)
    {
        try {
       
        $workerType = WorkerType::find($workerType);
       
        $workerType->delete();
        session()->flash('success', 'Worker type deleted successfully');
        
        return response()->json([
            "success"=> true,
            "message"=> "Worker Type delete Successfully"
        ]);
    } catch (\Throwable $th) {
        return response()->json([
            "success"=> false,
            "message"=> "Worker Type deletion Failed"
        ]);
    }
    }
}

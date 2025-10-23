<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $measurements = Measurement::with('customer')->latest()->paginate(20);
        return view('admin.measurements.index', compact('measurements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::select('id', 'name')->get();
        return view('admin.measurements.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|string',
        ]);

        // Get all form fields except _token
        $data = collect($request->except(['_token', 'customer_id', 'type', 'notes']))
            ->filter(fn($v) => $v !== null && $v !== '');

        Measurement::create([
            'customer_id' => $request->customer_id,
            'type' => $request->type,
            'data' => $data,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Measurement added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Measurement $measurement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Measurement $measurement)
    {
        $customers = Customer::select('id', 'name')->get();
        return view('admin.measurements.edit', compact('measurement', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Measurement $measurement)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|string',
        ]);
        return $request->all();

        $data = collect($request->except(['_token', '_method', 'customer_id', 'type', 'notes']))
            ->filter(fn($v) => $v !== null && $v !== '');
        $measurement->update([
            'customer_id' => $request->customer_id,
            'type' => $request->type,
            'data' => json_encode($data),
            'notes' => $request->notes,
        ]);

        return redirect()->route('measurements.index')->with('success', 'Measurement updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return redirect()->back()->with('success', 'Measurement deleted.');
    }
}

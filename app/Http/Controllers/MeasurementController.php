<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Measurement;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $measurements = Measurement::with('customer')->get();

        // Convert the JSON 'data' column to an object, and eager customer is fine (already done)
        $measurements->transform(function ($measurement) {
            if (is_string($measurement->data)) {
                $measurement->data = json_decode($measurement->data);
            }
            return $measurement;
        });

        return view('admin.measurements.index', compact('measurements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($customer = null)
    {

        $selectedCustomer = $customer ? Customer::find($customer) : null;
        $types = Type::get();
        $customers = Customer::select('id', 'name', "phone")->get();
        return view('admin.measurements.create', compact('customers', "types", "selectedCustomer"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'customer_id' => 'required|exists:customers,id',
        //     'type' => 'required|string',
        // ]);

        // // Get all form fields except _token
        // $data = collect($request->except(['_token', 'customer_id', 'type', 'notes']))
        //     ->filter(fn($v) => $v !== null && $v !== '');

        // Measurement::create([
        //     'customer_id' => $request->customer_id,
        //     'type' => $request->type,
        //     'data' => json_encode($data),
        //     'notes' => $request->notes,
        // ]);

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|string',
        ]);

        // Get all fields except the system ones
        $data = collect($request->except(['_token', 'customer_id', 'type', 'notes']))
            ->filter(fn($v) => $v !== null && $v !== '');

        // Group by prefix before underscore (e.g. "kameez_length" → "kameez" → ["length" => "1200"])
        $grouped = [];

        foreach ($data as $key => $value) {
            if (strpos($key, '_') !== false) {
                [$prefix, $field] = explode('_', $key, 2);
                $grouped[$prefix][$field] = $value;
            } else {
                // fallback for keys without underscore
                $grouped[$key] = $value;
            }
        }

        Measurement::create([
            'customer_id' => $request->customer_id,
            'type' => $request->type,
            'data' => json_encode($grouped, JSON_PRETTY_PRINT),
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
        if (is_string($measurement->data)) {
            $measurement->data = json_decode($measurement->data, true);
        }

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

        // Get all fields except the system ones
        $data = collect($request->except(['_token', '_method', 'customer_id', 'type', 'notes']))
            ->filter(fn($v) => $v !== null && $v !== '');

        // Group by prefix before underscore (e.g. "kameez_length" → "kameez" → ["length" => "1200"])
        $grouped = [];
        foreach ($data as $key => $value) {
            if (strpos($key, '_') !== false) {
                [$prefix, $field] = explode('_', $key, 2);
                $grouped[$prefix][$field] = $value;
            } else {
                $grouped[$key] = $value;
            }
        }

        $measurement->update([
            'customer_id' => $request->customer_id,
            'type' => $request->type,
            'data' => json_encode($grouped, JSON_PRETTY_PRINT),
            'notes' => $request->notes,
        ]);

        return redirect()->route('measurements.index')->with('success', 'Measurement updated successfully!');
    }

    // public function update(Request $request, Measurement $measurement)
    // {
    //     $request->validate([
    //         'customer_id' => 'required|exists:customers,id',
    //         'type' => 'required|string',
    //     ]);

    //     $data = $request->except(['_token', '_method', 'customer_id', 'type', 'notes']);
    //     $measurement->update([
    //         'customer_id' => $request->customer_id,
    //         'type' => $request->type,
    //         'data' => json_encode($data),
    //         'notes' => $request->notes,
    //     ]);

    //     return redirect()->route('measurements.index')->with('success', 'Measurement updated successfully!');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return redirect()->back()->with('success', 'Measurement deleted.');
    }
}

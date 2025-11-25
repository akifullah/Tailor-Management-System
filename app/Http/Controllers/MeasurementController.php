<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Measurement;
use App\Models\SewingOrderItem;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Measurement::with('customer');

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $measurements = $query->latest()->get();

        // Convert the JSON 'data' column to an object
        $measurements->transform(function ($measurement) {
            if (is_string($measurement->data)) {
                $measurement->data = json_decode($measurement->data);
            }
            return $measurement;
        });

        $customers = Customer::select('id', 'name', "phone")->orderBy('name')->get();

        // All possible types
        $types = [
            'pant',
            'shirt',
            'kameez',
            'shalwar',
            'kameez_shalwar',
            'coat',
            'waistcoat'
        ];

        return view('admin.measurements.index', compact('measurements', 'customers', 'types'));
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

        $styleKeys = [
            "style_patty",
            "style_collar",
            "style_front_pocket",
            "style_side_pocket",
            "style_cuff",
            "style_sleeve",
            "style_chak_patti",
            "style_daman",
            "style_shalwar",
            "style_shalwar_jeeb",
            "style_pancha_design",
            "style_stitching_detail",
            "style_button_detail",
            "style_cloth_type",
            "style_patty_width",
            "style_patty_length",
            "style_collar_width",
            "style_front_pocket_width",
            "style_front_pocket_length"
        ];
        $style = array_filter($request->only($styleKeys), fn($value) => $value !== null);
        if (empty($style)) {
            $style = null;
        }
        // Get all fields except the system ones
        $data = collect($request->except([
            '_token',
            'customer_id',
            'type',
            'notes',
            "style_patty",
            "style_collar",
            "style_front_pocket",
            "style_side_pocket",
            "style_cuff",
            "style_sleeve",
            "style_chak_patti",
            "style_daman",
            "style_shalwar",
            "style_shalwar_jeeb",
            "style_pancha_design",
            "style_stitching_detail",
            "style_button_detail",
            "style_cloth_type",
            "style_patty_width",
            "style_patty_length",
            "style_collar_width",
            "style_front_pocket_width",
            "style_front_pocket_length"
        ]))
            ->filter(fn($v) => $v !== null && $v !== '');

        // Group by prefix before underscore (e.g. "kameez_length" → "kameez" → ["length" => "1200"])
        $grouped = [];

        // foreach ($data as $key => $value) {
        //     if (strpos($key, '_') !== false) {
        //         [$prefix, $field] = explode('_', $key, 2);
        //         $grouped[$prefix][$field] = $value;
        //     } else {
        //         // fallback for keys without underscore
        //         $grouped[$key] = $value;
        //     }
        // }


        // Step 1: Group by prefix
        foreach ($data as $key => $value) {
            if (strpos($key, '_') !== false) {
                [$prefix, $field] = explode('_', $key, 2);
                $grouped[$prefix][$field] = $value;
            } else {
                $grouped[$key] = $value;
            }
        }

        // Step 2: Merge main + extra fields with keys
        // $final = [];

        // foreach ($grouped as $prefix => $fields) {

        //     $final[$prefix] = [];

        //     foreach ($fields as $field => $value) {

        //         if (str_contains($field, '_extra')) {

        //             // extract main field (before _extra)
        //             [$main] = explode('_extra', $field);

        //             // ensure main exists
        //             if (!isset($final[$prefix][$main])) {
        //                 $final[$prefix][$main] = [
        //                     'value' => $fields[$main] ?? null,
        //                     'extra' => []
        //                 ];
        //             }

        //             // store extra as key-value pair
        //             $final[$prefix][$main]['extra'][$field] = $value;
        //         } else {

        //             // normal field, only add if not already handled
        //             if (!isset($final[$prefix][$field])) {
        //                 $final[$prefix][$field] = [
        //                     'value' => $value
        //                 ];
        //             }
        //         }
        //     }
        // }


        Measurement::create([
            'customer_id' => $request->customer_id,
            'type' => $request->type,
            'data' => json_encode($grouped),
            "style" => json_encode($style),
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
        // return $measurement;
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

        $styleKeys = [
            "style_patty",
            "style_collar",
            "style_front_pocket",
            "style_side_pocket",
            "style_cuff",
            "style_sleeve",
            "style_chak_patti",
            "style_daman",
            "style_shalwar",
            "style_shalwar_jeeb",
            "style_pancha_design",
            "style_stitching_detail",
            "style_button_detail",
            "style_cloth_type",
            "style_patty_width",
            "style_patty_length",
            "style_collar_width",
            "style_front_pocket_width",
            "style_front_pocket_length"
        ];
        $style = array_filter($request->only($styleKeys), fn($value) => $value !== null);
        if (empty($style)) {
            $style = null;
        }


        // Get all fields except the system ones
        $data = collect($request->except([
            '_token',
            '_method',
            'customer_id',
            'type',
            'notes',
            "style_patty",
            "style_collar",
            "style_front_pocket",
            "style_side_pocket",
            "style_cuff",
            "style_sleeve",
            "style_chak_patti",
            "style_daman",
            "style_shalwar",
            "style_shalwar_jeeb",
            "style_pancha_design",
            "style_stitching_detail",
            "style_button_detail",
            "style_cloth_type",
            "sewing_order_id",
            "style_patty_width",
            "style_patty_length",
            "style_collar_width",
            "style_front_pocket_width",
            "style_front_pocket_length",
            "item_id"
        ]))
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
            'style' => json_encode($style),
            'notes' => $request->notes,
        ]);

        $sewingItem = null;
        if ($request->filled('sewing_order_id') && $request->filled('item_id')) {
            $sewingItem = SewingOrderItem::where('sewing_order_id', $request->sewing_order_id)
                ->where('id', $request->item_id)
                ->first();
            $sewingItem->customer_measurement = json_encode($measurement);
            $sewingItem->save();
            return redirect()->route('sewing-orders.show', $request->sewing_order_id)->with('success', 'Measurement updated successfully!');
        }

        return redirect()->route('measurements.create')->with('success', 'Measurement updated successfully!');
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

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["customers"] = Cache::remember("customers", 60 * 1, function () {
            return Customer::get();
        });
        // return $data;
        return view("admin.customers.index", $data);
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
        $customerData = $request->only(['name', 'email', 'address', 'phone']);

        $customer = Customer::updateOrCreate(
            ['id' => $request->id],
            $customerData
        );
        Cache::forget("customers");
        session()->flash('success', $request->id ? 'Customer updated successfully.' : 'Customer created successfully.');

        return response()->json([
            'success' => true,
            'message' => $request->id ? 'Customer updated successfully.' : 'Customer created successfully.',
            'user' => $customer,
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
        $customer = Customer::find($id);

        $customer->delete();

        return response()->json([
            "success" => true,
            "message" => "Customer deleted."
        ]);
    }



    // Get Customers Measurements
    public function getMeasurementsByUser($id)
    {
        if (!$id) abort(404);
        $customer =  Customer::with("measurements")->where("id", $id)->first();
        if ($customer && $customer->measurements) {
            $customer->measurements->transform(function ($measurement) {
                $measurement->data = json_decode($measurement->data, true);
                return $measurement;
            });
        }

        $data["customer"] = $customer;
        return view("admin.customers.customer_measurement", $data);
    }
}

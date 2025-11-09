<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function updateStatus(Request $request, OrderItem $item)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,progress,completed',
        ]);

        $item->update(['status' => $validated['status']]);

        return response()->json(['success' => true, 'message' => 'Item status updated successfully']);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderTrackingApiController extends Controller
{
    /**
     * Provide order tracking info by order number (ID) or customer phone.
     * GET or POST param: ?order_number= or ?phone=
     */
    public function track(Request $request)
    {
        $order_number = $request->input('order_number');
        $phone = $request->input('phone');

        // 1. Try by order_number
        if ($order_number) {
            $order = Order::with(['items'])
                ->where('order_number', $order_number)
                ->latest()
                ->first();
        } elseif ($phone) {
            $customer = Customer::where('phone', $phone)->first();
            $order = $customer
                ? Order::with(['items'])
                    ->where('customer_id', $customer->id)
                    ->orderByDesc('order_number')
                    ->first()
                : null;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please provide phone or order_number.'
            ], 400);
        }

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.'
            ], 404);
        }

        // Order status mapping
        $statusMap = [
            'pending'    => 'Pending',
            'in_progress'=> 'In Progress',
            'completed'  => 'Completed',
            'delivered'  => 'Delivered',
            'cancelled'  => 'Cancelled',
            'on_hold'    => 'On Hold',
        ];

        // For badge: only 4 are tracked
        $orderProgressStatuses = ['pending', 'in_progress', 'completed', 'delivered'];
        $orderStatus = $order->order_status;
        $statusBadge = in_array($orderStatus, $orderProgressStatuses) ? $statusMap[$orderStatus] ?? ucfirst($orderStatus) : ucfirst($orderStatus);

        // Items progress logic
        $itemStatuses = ['pending' => 'Pending', 'progress' => 'In Progress', 'completed' => 'Completed', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'];
        $itemProgressSteps = ['pending', 'progress', 'completed', 'delivered'];
        $items = $order->items->map(function ($item) use ($itemStatuses, $itemProgressSteps) {
            $status = $item->status;
            // For item UI progress bar: only the 4 main steps (skip 'cancelled')
            $progressIndex = array_search($status, $itemProgressSteps);
            $progress = $progressIndex === false ? 0 : (($progressIndex+1) / count($itemProgressSteps)) * 100;

            return [
                'name' => $item->product_name,
                'price' => $item->sell_price,
                'status' => $itemStatuses[$status] ?? ucfirst($status),
                'progress_percent' => $progress,
                'cancelled' => $status === 'cancelled',
            ];
        });

        return response()->json([
            'success' => true,
            'order' => [
                'order_number' => $order->order_number,
                'statusBadge' => $statusBadge,
                'order_status' => $statusMap[$orderStatus] ?? ucfirst($orderStatus),
                'item_count' => $order->items->count(),
                'total_amount' => $order->total_amount,
                'customer_name' => $order->customer->name ?? null,
                'items' => $items,
            ]
        ]);
    }
}


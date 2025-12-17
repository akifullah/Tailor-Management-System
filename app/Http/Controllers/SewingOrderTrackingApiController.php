<?php

namespace App\Http\Controllers;

use App\Models\SewingOrder;
use App\Models\Customer;
use Illuminate\Http\Request;

class SewingOrderTrackingApiController extends Controller
{
    /**
     * Provide sewing order tracking info by sewing_order_number or customer phone.
     * GET or POST param: ?sewing_order_number= or ?phone=
     */
    public function track(Request $request)
    {
        $sewing_order_number = $request->input('sewing_order_number');
        $phone = $request->input('phone');

        // 1. Try by sewing_order_number
        if ($sewing_order_number) {
            $order = SewingOrder::with(['items'])
                ->where('sewing_order_number', $sewing_order_number)
                ->latest()
                ->first();
        } elseif ($phone) {
            $customer = Customer::where('phone', $phone)->first();
            $order = $customer
                ? SewingOrder::with(['items'])
                    ->where('customer_id', $customer->id)
                    ->orderByDesc('sewing_order_number')
                    ->first()
                : null;

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please provide phone or sewing_order_number.'
            ], 400);
        }

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Sewing order not found.'
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
            'sewing'     => 'Sewing',
            'cutter'     => 'Cutter',
        ];

        // For badge: only 4 are tracked (assuming logic similar)
        $orderProgressStatuses = ['pending', 'in_progress', 'completed', 'delivered'];
        $orderStatus = $order->order_status;
        $statusBadge = in_array($orderStatus, $orderProgressStatuses) ? $statusMap[$orderStatus] ?? ucfirst($orderStatus) : ucfirst($orderStatus);

        // Items progress logic
        $itemStatuses = [
            'pending'   => 'Pending',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
            'on_hold'   => 'On Hold',
            'sewing'    => 'Sewing',
            'cutter'    => 'Cutter',
        ];
        $itemProgressSteps = ['pending', 'in_progress', 'completed', 'delivered'];
        $items = $order->items->map(function ($item) use ($itemStatuses, $itemProgressSteps) {
            $status = $item->status;
            // For item UI progress bar: only the 4 main steps (skip 'cancelled', 'on_hold', etc)
            $progressIndex = array_search($status, $itemProgressSteps);
            $progress = $progressIndex === false ? 0 : (($progressIndex+1) / count($itemProgressSteps)) * 100;

            return [
                'name' => $item->product_name,
                'price' => $item->sewing_price,
                'status' => $itemStatuses[$status] ?? ucfirst($status),
                'progress_percent' => $progress,
                'cancelled' => $status === 'cancelled',
            ];
        });

        return response()->json([
            'success' => true,
            'order' => [
                'sewing_order_number' => $order->sewing_order_number,
                'statusBadge' => $statusBadge,
                'order_status' => $statusMap[$orderStatus] ?? ucfirst($orderStatus),
                "delivery_date" => $order->delivery_date ? date('F j, Y', strtotime($order->delivery_date)) : null,
                'item_count' => $order->items->count(),
                'total_amount' => $order->total_amount,
                'customer_name' => $order->customer->name ?? null,
                'items' => $items,
            ]
        ]);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\SewingOrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerLedgerController extends Controller
{
    public function indexForAdmin(Request $request)
    {
        $search = $request->input('search');

        $workersQuery = User::with(['sewingOrderItems', 'workerPayments']);

        if (!empty($search)) {
            $workersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        }

        $workers = $workersQuery->get();

        $workers = $workers->map(function (User $worker) {
            $paid = $worker->workerPayments()
                ->where('type', 'payment')
                ->sum('amount');

            $worker->ledger_summary = [
                'paid' => $paid,
            ];

            return $worker;
        });

        return view('admin.workers.ledger_index', compact('workers'));
    }

    public function showForAdmin(User $worker)
    {
        $worker->load(['sewingOrderItems.sewingOrder.customer', 'workerPayments' => function ($q) {
            $q->where('type', 'payment')->orderByDesc('payment_date');
        }]);

        $workItems = $worker->sewingOrderItems()->with(['sewingOrder.customer'])->get();

        // Work status stats for this worker (all assigned items)
        $workStats = [
            'total'      => $workItems->count(),
            'pending'    => $workItems->where('status', 'pending')->count(),
            'in_progress'=> $workItems->where('status', 'in_progress')->count(),
            'completed'  => $workItems->whereIn('status', ['completed', 'delivered'])->count(),
            // 'delivered'  => $workItems->where('status', 'delivered')->count(),
            'on_hold'    => $workItems->where('status', 'on_hold')->count(),
            'cancelled'  => $workItems->where('status', 'cancelled')->count(),
        ];

        $paid = $worker->workerPayments()
            ->where('type', 'payment')
            ->sum('amount');

        $summary = [
            'paid' => $paid,
        ];

        $payments = $worker->workerPayments()
            ->where('type', 'payment')
            ->orderByDesc('payment_date')
            ->get();

        return view('admin.workers.ledger_show', compact('worker', 'summary', 'workItems', 'payments', 'workStats'));
    }

    public function addPaymentForAdmin(Request $request, User $worker)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,online,bank_transfer,cheque',
            'payment_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $paymentDate = $validated['payment_date'] ?? now();

        Payment::create([
            'payable_type' => User::class,
            'payable_id' => $worker->id,
            'type' => 'payment',
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'payment_date' => $paymentDate,
            'notes' => $validated['notes'] ?? null,
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.workers.ledger.show', $worker->id)
            ->with('success', 'Payment added for worker successfully.');
    }

    public function myLedger()
    {
        $worker = Auth::user();

        $worker->load(['sewingOrderItems.sewingOrder.customer', 'workerPayments' => function ($q) {
            $q->where('type', 'payment')->orderByDesc('payment_date');
        }]);

        $workItems = $worker->sewingOrderItems()->with(['sewingOrder.customer'])->get();

        // Work status stats for this worker (all assigned items)
        $workStats = [
            'total'      => $workItems->count(),
            'pending'    => $workItems->where('status', 'pending')->count(),
            'in_progress'=> $workItems->where('status', 'in_progress')->count(),
            'completed'  => $workItems->whereIn('status', ['completed', 'delivered'])->count(),
            // 'delivered'  => $workItems->where('status', 'delivered')->count(),
            'on_hold'    => $workItems->where('status', 'on_hold')->count(),
            'cancelled'  => $workItems->where('status', 'cancelled')->count(),
        ];

        $paid = $worker->workerPayments()
            ->where('type', 'payment')
            ->sum('amount');

        $summary = [
            'paid' => $paid,
        ];

        $payments = $worker->workerPayments()
            ->where('type', 'payment')
            ->orderByDesc('payment_date')
            ->get();

        return view('admin.workers.my_ledger', compact('worker', 'summary', 'workItems', 'payments', 'workStats'));
    }
}

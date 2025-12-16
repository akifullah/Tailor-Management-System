<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Expense;
use App\Models\SewingOrderItem;
use App\Models\User;
use Carbon\Carbon;
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
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
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

    public function showForAdmin(User $worker, Request $request)
    {
        $worker->load(['workerPayments' => function ($q) {
            $q->where('type', 'payment')->orderByDesc('payment_date');
        }]);

        // Load all work items for stats calculation
        $allWorkItems = $worker->sewingOrderItems()
            ->with(['sewingOrder.customer'])
            ->get();

        // Work status stats based on worker's individual pivot status
        $workStats = [
            'total'       => $allWorkItems->count(),
            'pending'     => $allWorkItems->filter(fn($item) => $item->pivot->status === 'pending')->count(),
            'in_progress' => $allWorkItems->filter(fn($item) => $item->pivot->status === 'in_progress')->count(),
            'cutter'      => $allWorkItems->filter(fn($item) => $item->pivot->status === 'cutter')->count(),
            'sewing'      => $allWorkItems->filter(fn($item) => $item->pivot->status === 'sewing')->count(),
            'completed'   => $allWorkItems->filter(fn($item) => $item->pivot->status === 'completed')->count(),
            'on_hold'     => $allWorkItems->filter(fn($item) => $item->pivot->status === 'on_hold')->count(),
            'cancelled'   => $allWorkItems->where('status', 'cancelled')->count(),
        ];

        $completedAmount = $allWorkItems
            ->filter(fn($item) => $item->pivot->status === 'completed')
            ->sum(fn($item) => ($item->pivot->worker_cost ?? 0) * $item->qty);

        $paid = $worker->workerPayments()
            ->where('type', 'payment')
            ->sum('amount');

        $summary = [
            'completed_amount' => $completedAmount,
            'paid' => $paid,
            'remaining' => $completedAmount - $paid,
        ];

        $payments = $worker->workerPayments()
            ->where('type', 'payment')
            ->orderByDesc('payment_date')
            ->get();

        // Paginated work items by status
        $pendingItems = $worker->sewingOrderItems()
            ->wherePivot('status', 'pending')
            ->with(['sewingOrder.customer'])
            ->latest()
            ->paginate(15, ['*'], 'pending_page');

        $inProgressItems = $worker->sewingOrderItems()
            ->wherePivot('status', 'in_progress')
            ->with(['sewingOrder.customer'])
            ->latest()
            ->paginate(15, ['*'], 'in_progress_page');

        $completedItems = $worker->sewingOrderItems()
            ->wherePivot('status', 'completed')
            ->with(['sewingOrder.customer'])
            ->latest()
            ->paginate(15, ['*'], 'completed_page');

        // Determine active tab based on query parameters
        $activeTab = 'pending'; // default
        if ($request->has('completed_page')) {
            $activeTab = 'completed';
        } elseif ($request->has('in_progress_page')) {
            $activeTab = 'in_progress';
        } elseif ($request->has('pending_page')) {
            $activeTab = 'pending';
        }

        return view('admin.workers.ledger_show', compact(
            'worker', 
            'summary', 
            'payments', 
            'workStats',
            'pendingItems',
            'inProgressItems',
            'completedItems',
            'activeTab'
        ));
    }

    public function addPaymentForAdmin(Request $request, User $worker)
    {
        // return $worker;
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,online,bank_transfer,cheque',
            'payment_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $paymentDate = $validated['payment_date']
            ? Carbon::parse($validated['payment_date'])
            : now();

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

        // Mirror worker payment in expenses for accounting
        Expense::create([
            'title' => 'Payment to ' . $worker->name,
            'amount' => $validated['amount'],
            'description' => 'Payment to ' . $worker->name,
            'date' => $paymentDate,
            'category' => 'Worker Payment',
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.workers.ledger.show', $worker->id)
            ->with('success', 'Payment added for worker successfully.');
    }

    public function myLedger()
    {
        $worker = Auth::user();

        $worker->load(['workerPayments' => function ($q) {
            $q->where('type', 'payment')->orderByDesc('payment_date');
        }]);

        // Load work items with pivot data for this specific worker
        $workItems = $worker->sewingOrderItems()
            ->with(['sewingOrder.customer'])
            ->get();

        // Work status stats based on worker's individual pivot status
        $workStats = [
            'total'       => $workItems->count(),
            'pending'     => $workItems->filter(fn($item) => $item->pivot->status === 'pending')->count(),
            'in_progress' => $workItems->filter(fn($item) => $item->pivot->status === 'in_progress')->count(),
            'cutter'      => $workItems->filter(fn($item) => $item->pivot->status === 'cutter')->count(),
            'sewing'      => $workItems->filter(fn($item) => $item->pivot->status === 'sewing')->count(),
            'completed'   => $workItems->filter(fn($item) => $item->pivot->status === 'completed')->count(),
            'on_hold'     => $workItems->filter(fn($item) => $item->pivot->status === 'on_hold')->count(),
            'cancelled'   => $workItems->where('status', 'cancelled')->count(),
        ];

        $paid = $worker->workerPayments()
            ->where('type', 'payment')
            ->sum('amount');

        $summary = [
            'completed_amount' => $workItems
                ->filter(fn($item) => $item->pivot->status === 'completed')
                ->sum(fn($item) => ($item->pivot->worker_cost ?? 0) * $item->qty),
            'paid' => $paid,
            'remaining' => $workItems
                ->filter(fn($item) => $item->pivot->status === 'completed')
                ->sum(fn($item) => ($item->pivot->worker_cost ?? 0) * $item->qty) - $paid,
        ];

        $payments = $worker->workerPayments()
            ->where('type', 'payment')
            ->orderByDesc('payment_date')
            ->get();

        return view('admin.workers.my_ledger', compact('worker', 'summary', 'workItems', 'payments', 'workStats'));
    }
}

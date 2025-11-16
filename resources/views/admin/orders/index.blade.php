@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Orders</h4>
            </div>
            <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">Add Order</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <form id="orderSearchForm" method="GET" action="">
                                <div class="row g-2 justify-content-end align-items-end">
                                    <div class="col-md-2">
                                        <label for="search_type" class="form-label">Search By</label>
                                        <select name="type" id="search_type" class="form-select" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="order_number" {{ request('type') == 'order_number' ? 'selected' : '' }}>Order Number
                                            </option>
                                            <option value="customer" {{ request('type') == 'customer' ? 'selected' : '' }}>
                                                Customer</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="search_value" class="form-label">Input Value</label>
                                        <input type="text" required name="value" id="search_value" class="form-control"
                                            value="{{ request('value') }}" placeholder="Enter value">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="status_filter" class="form-label">Order Status</label>
                                        <select name="order_status" id="status_filter" class="form-select">
                                            <option value="">All Statuses</option>
                                            <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ request('order_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ request('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="returned" {{ request('order_status') == 'returned' ? 'selected' : '' }}>Returned</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="payment_status_filter" class="form-label">Payment Status</label>
                                        <select name="payment_status" id="payment_status_filter" class="form-select">
                                            <option value="">All</option>
                                            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="item_status_filter" class="form-label">Item Status</label>
                                        <select name="item_status" id="item_status_filter" class="form-select">
                                            <option value="">All</option>
                                            <option value="all_done" {{ request('item_status') == 'all_done' ? 'selected' : '' }}>All Done</option>
                                            <option value="partial" {{ request('item_status') == 'partial' ? 'selected' : '' }}>Partial Done</option>
                                            <option value="returned" {{ request('item_status') == 'returned' ? 'selected' : '' }}>All Returned</option>
                                            <option value="not_returned" {{ request('item_status') == 'not_returned' ? 'selected' : '' }}>Any Not Returned</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 align-self-end">
                                        <div class="d-flex gap-1">
                                            <button type="submit" class="btn px-2 btn-primary">Search</button>
                                            <a href="{{ route(Route::currentRouteName()) }}"
                                                class="btn px-2 btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Order Number</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Total Amount</th>
                                    <th>Payment Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->isNotEmpty())
                                    @foreach ($orders as $order)
                                        @php
                                            // Calculate total paid (only payments, not refunds)
                                            $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
                                            // Calculate total refunded
                                            $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
                                            // Net paid = total paid - total refunded
                                            $netPaid = $totalPaid - $totalRefunded;
                                            // Remaining = order total - net paid
                                            $remaining = $order->total_amount - $netPaid;
                                        @endphp
                                        <tr style="background-color: {{ $order->is_return ? 'rgba(255, 0, 0, 0.1)' : '' }} ;">
                                            <td>{{ $order->id }}</td>
                                            <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->order_number }}</a></td>
                                            <td>
                                                {{ $order->order_date->format('Y-m-d') }}

                                            @if ($order->is_return && $order->return_date)
                                                <br/><small class="text-muted">Return Date: {{ $order->return_date instanceof \Carbon\Carbon ? $order->return_date->format('Y-m-d') : $order->return_date }}</small>
                                            @endif
                                            </td>
                                            <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                            <td>{{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                @if($order->order_status === 'cancelled' || $order->is_return)
                                                    <span class="badge bg-secondary">--</span>
                                                @else
                                                    <span class="badge bg-{{ $remaining <= 0 ? 'success' : 'warning' }}">
                                                        {{ $remaining <= 0 ? 'Paid' : 'Pending' }}
                                                    </span>
                                                    @if ($remaining > 0)
                                                        <br><small class="text-muted">Remaining: Rs
                                                            {{ number_format($remaining, 2) }}</small>
                                                    @elseif ($remaining < 0)
                                                        <br><small class="text-danger">Overpaid: Rs
                                                            {{ number_format(abs($remaining), 2) }}</small>
                                                    @endif
                                                    @if ($totalRefunded > 0)
                                                        <br><small class="text-info">Refunded: Rs
                                                            {{ number_format($totalRefunded, 2) }}</small>
                                                    @endif
                                                @endif
                                            </td>


                                            <td>
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm bg-info-subtle">
                                                    <i class="mdi mdi-eye fs-14 text-info"></i>
                                                </a>


                                                <a href="#" title="return" data-bs-toggle="modal"
                                                    data-bs-target="#returnModal{{ $order->id }}">
                                                    <button class="btn btn-sm bg-danger-subtle">
                                                        <i class="mdi mdi-undo fs-14 text-danger"></i>
                                                    </button>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="returnModal{{ $order->id }}" tabindex="-1"
                                                    aria-labelledby="returnModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="returnModalLabel">Return Order</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="returnForm{{ $order->id }}" action="{{ route('orders.return', $order->id) }}" method="POST" enctype="multipart/form-data">

                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="return_date" class="form-label">Return
                                                                            Date</label>
                                                                        <input type="date" class="form-control" id="return_date"
                                                                            name="return_date" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="reason" class="form-label">Reason</label>
                                                                        <textarea class="form-control" id="reason" name="reason"
                                                                            rows="3" required></textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Return</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">
                                            No orders found.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Attach submit handler for all return forms generated per order
            $('[id^="returnForm"]').on('submit', function(e) {
                e.preventDefault();

                var form = this;
                var formData = new FormData(form);
                var submitButton = $(form).find('button[type="submit"]');
                submitButton.prop('disabled', true);
                submitButton.text('Processing...');

                $.ajax({
                    url: $(form).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Find the modal associated with this form and hide it
                            let modalSelector = '#returnModal' + $(form).attr('id').replace('returnForm', '');
                            $(modalSelector).modal('hide');
                            window.location.reload();
                        } else {
                            alert('Error: ' + response.message);
                            submitButton.prop('disabled', false);
                            submitButton.text('Submit');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                        submitButton.prop('disabled', false);
                        submitButton.text('Submit');
                    }
                });
            });
        });
    </script>
@endsection
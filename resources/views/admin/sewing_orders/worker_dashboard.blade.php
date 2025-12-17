@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">My Assigned Sewing Items</h4>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row align-items-stretch">
            <div class="col-md-3 mb-3">
                <div class="card h-100 border-primary">
                    <div class="card-body">
                        <h5>Total Assigned</h5>
                        <h2 class="text-primary">{{ $stats['total_assigned'] }}</h2>
                        {{-- <small class="text-muted">Total Value: Rs {{ number_format($stats['total_value'], 2) }}</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5>Pending</h5>
                        <h2 class="text-secondary">{{ $stats['pending'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100 border-warning">
                    <div class="card-body">
                        <h5>In Progress</h5>
                        <h2 class="text-warning">{{ $stats['in_progress'] }}</h2>
                        {{-- <small class="text-muted">Value: Rs {{ number_format($stats['in_progress_value'], 2) }}</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100 border-success">
                    <div class="card-body">
                        <h5>Completed</h5>
                        <h2 class="text-success">{{ $stats['completed'] }}</h2>
                        {{-- <small class="text-muted">Value: Rs {{ number_format($stats['completed_value'], 2) }}</small> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-stretch mb-3">
            <div class="col-md-4">
                <div class="card h-100 border-success">
                    <div class="card-body">
                        <h6>Amount For Completed Items</h6>
                        <h3 class="text-success">Rs {{ number_format($stats['completed_amount'] ?? 0, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-success">
                    <div class="card-body">
                        <h6>Total Paid To Me</h6>
                        <h3 class="text-success">Rs {{ number_format($stats['paid_amount'] ?? 0, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-warning">
                    <div class="card-body">
                        <h6>Remaining (Completed - Paid)</h6>
                        <h3 class="text-warning">Rs {{ number_format($stats['remaining_amount'] ?? 0, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats Cards -->
        <div class="row align-items-stretch mb-3">
            {{-- <div class="col-md-3 mb-3">
                <div class="card h-100 border-info">
                    <div class="card-body">
                        <h5>On Hold</h5>
                        <h2 class="text-info">{{ $stats['on_hold'] }}</h2>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-md-3 mb-3">
                <div class="card h-100 border-danger">
                    <div class="card-body">
                        <h5>Cancelled</h5>
                        <h2 class="text-danger">{{ $stats['cancelled'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100 border-success">
                    <div class="card-body">
                        <h5>Delivered</h5>
                        <h2 class="text-success">{{ $stats['delivered'] }}</h2>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5>Completion Rate</h5>
                        <h2 class="text-primary">
                            @if ($stats['total_assigned'] > 0)
                                {{ number_format(($stats['completed'] / $stats['total_assigned']) * 100, 1) }}%
                            @else
                                0%
                            @endif
                        </h2>
                        <small class="text-muted">{{ $stats['completed'] }} of {{ $stats['total_assigned'] }} items</small>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="mb-3">
                            <form method="GET" action="{{ route('worker.dashboard') }}">
                                <div class="row g-2 justify-content-end align-items-end">
                                    <div class="col-md-3">
                                        <label for="status" class="form-label">Filter by Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="">All Statuses</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            {{-- <option value="on_hold" {{ request('status') == 'on_hold' ? 'selected' : '' }}>
                                                On Hold</option> --}}
                                            <option value="in_progress"
                                                {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                                            </option>
                                            {{-- <option value="cutter" {{ request('status') == 'cutter' ? 'selected' : '' }}>
                                                Cutter</option>
                                            <option value="sewing" {{ request('status') == 'sewing' ? 'selected' : '' }}>
                                                Sewing</option> --}}
                                            <option value="completed"
                                                {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 align-self-end">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Sewing Order #</th>
                                    <th>Customer</th>
                                    <th>Product Name</th>
                                    <th>Color</th>
                                    <th>Worker Cost</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($items->isNotEmpty())
                                    @foreach ($items as $item)
                                        <tr
                                            @if ($item->status == 'cancelled') style="background-color: rgba(255,0,0,0.1);" @endif>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <a href="{{ route('sewing-orders.show', $item->sewingOrder->id) }}">
                                                    {{ $item->sewingOrder->sewing_order_number }}
                                                </a>
                                            </td>
                                            <td>{{ $item->sewingOrder->customer->name ?? '--' }}</td>
                                            <td class="text-capitalize">{{ $item->product_name }}</td>
                                            <td>{{ $item->color ?? '--' }}</td>
                                            @php
                                                $workerPivot = $item->workers->first()?->pivot;
                                                $workerCost = $workerPivot->worker_cost ?? 0;
                                            @endphp
                                            <td>Rs {{ number_format($workerCost, 2) }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>Rs {{ number_format($workerCost * $item->qty, 2) }}</td>
                                            <td>
                                                @php
                                                    // Get the worker's individual status from pivot table
$workerStatus = $item->workers->first()->pivot->status ?? 'pending';
                                                @endphp
                                                <span
                                                    class="badge bg-{{ ['pending' => 'secondary', 'on_hold' => 'info', 'in_progress' => 'warning', 'cutter' => 'primary', 'sewing' => 'info', 'completed' => 'success'][$workerStatus] ?? 'secondary' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $workerStatus)) }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $workerStatus = $item->workers->first()->pivot->status ?? 'pending';
                                                @endphp
                                                <select class="form-select form-select-sm status-select"
                                                    data-item-id="{{ $item->id }}"
                                                    style="width: auto; display: inline-block;">
                                                    <option value="pending"
                                                        {{ $workerStatus == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    {{-- <option value="on_hold"
                                                        {{ $workerStatus == 'on_hold' ? 'selected' : '' }}>On Hold
                                                    </option> --}}
                                                    <option value="in_progress"
                                                        {{ $workerStatus == 'in_progress' ? 'selected' : '' }}>In
                                                        Progress</option>
                                                    {{-- <option value="cutter"
                                                        {{ $workerStatus == 'cutter' ? 'selected' : '' }}>Cutter
                                                    </option>
                                                    <option value="sewing"
                                                        {{ $workerStatus == 'sewing' ? 'selected' : '' }}>Sewing
                                                    </option> --}}
                                                    <option value="completed"
                                                        {{ $workerStatus == 'completed' ? 'selected' : '' }}>
                                                        Completed</option>
                                                </select>
                                                @if ($item->customer_measurement)
                                                    <button type="button" class="btn btn-sm btn-primary mt-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#measurementModal{{ $item->id }}">
                                                        View Measurement
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">
                                            No assigned items found.
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

    <!-- Measurement Modals -->
    @foreach ($items as $itemIndex => $item)
        @if ($item->customer_measurement)
            @php
                // Handle measurement data - could be array or JSON string
                $measurement = $item->customer_measurement;
                if (is_string($measurement)) {
                    $measurement = json_decode($measurement, true) ?? [];
                }

                // Parse the nested data field if it's a JSON string
$measurementData = [];
if (isset($measurement['data'])) {
    if (is_string($measurement['data'])) {
        $measurementData = json_decode($measurement['data'], true) ?? [];
    } elseif (is_array($measurement['data'])) {
        $measurementData = $measurement['data'];
                    }
                }
            @endphp
            <div class="modal fade" id="measurementModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="measurementModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="measurementModalLabel{{ $item->id }}">
                                Measurement Details: {{ ucfirst(str_replace('_', ' ', $measurement['type'] ?? 'N/A')) }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            @php
                                // $measurement['data'] is now a nested keyed array like ['kameez' => [...], 'shalwar' => [...]]
                                $dataGroups = [];
                                if (isset($measurement['data'])) {
                                    if (is_string($measurement['data'])) {
                                        $decoded = json_decode($measurement['data'], true);
                                        if (is_array($decoded)) {
                                            $dataGroups = $decoded;
                                        }
                                    } elseif (is_array($measurement['data'])) {
                                        $dataGroups = $measurement['data'];
                                    } elseif (is_object($measurement['data'])) {
                                        $dataGroups = (array) $measurement['data'];
                                    }
                                }
                            @endphp

                            <div class="row">
                                <div class="col-md-6">
                                    @if (!empty($dataGroups))
                                        <div class="table-responsive">
                                            @foreach ($dataGroups as $groupLabel => $groupFields)
                                                <h4 class="mt-3 text-center" style="font-weight: 700;">
                                                    {{ ucfirst($groupLabel) }}
                                                </h4>
                                                <table class="table table-bordered table-striped mb-2">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50%">Field</th>
                                                            <th style="width: 50%">Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            // Define pairs of main keys and their extras for relevant groups
                                                            $mainExtraPairs = [
                                                                'shoulder' => ['shoulder_extra1'],
                                                                'sleeve' => ['sleeve_extra1'],
                                                                'chest' => ['chest_extra1'],
                                                                'waist' => ['waist_extra1'],
                                                            ];
                                                            $usedKeys = [];
                                                        @endphp
                                                        @foreach ($groupFields as $fieldKey => $fieldValue)
                                                            @php
                                                                // If this key is an extra for a previous main field, skip it
                                                                $alreadyHandled = false;
                                                                foreach ($mainExtraPairs as $main => $extras) {
                                                                    if (in_array($fieldKey, $extras)) {
                                                                        $alreadyHandled = true;
                                                                        break;
                                                                    }
                                                                }
                                                                if ($alreadyHandled || in_array($fieldKey, $usedKeys)) {
                                                                    continue;
                                                                }
                                                            @endphp

                                                            @if (isset($mainExtraPairs[$fieldKey]))
                                                                <tr>
                                                                    <td class="text-capitalize" style="width: 150px">
                                                                        <strong>{{ str_replace('_', ' ', ucwords($fieldKey, '_')) }}</strong>
                                                                    </td>
                                                                    <td>
                                                                        {{ $fieldValue ?? 'N/A' }}
                                                                        @foreach ($mainExtraPairs[$fieldKey] as $idx => $extraKey)
                                                                            @if (isset($groupFields[$extraKey]) && $groupFields[$extraKey] !== '')
                                                                                <span class="">
                                                                                    | ({{ $groupFields[$extraKey] }})
                                                                                </span>
                                                                                @php $usedKeys[] = $extraKey; @endphp
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td class="text-capitalize" style="width: 150px">
                                                                        <strong>{{ str_replace('_', ' ', ucwords($fieldKey, '_')) }}</strong>
                                                                    </td>
                                                                    <td>{{ $fieldValue ?? 'N/A' }}</td>
                                                                </tr>
                                                            @endif

                                                            @php $usedKeys[] = $fieldKey; @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            No measurement data available.
                                        </div>
                                    @endif

                                </div>

                                <div class="col-md-6">
                                    @if (isset($measurement['style']))
                                        @php
                                            // Handle both JSON string and array formats
                                            if (is_string($measurement['style'])) {
                                                $styleData = json_decode($measurement['style'], true);
                                            } else {
                                                $styleData = (array) $measurement['style'];
                                            }
                                            $rows = [];
                                            $grouped = [];

                                            // Allowed keys for extra values
                                            $allowedExtraKeys = [
                                                'style_patty_width',
                                                'style_patty_length',
                                                'style_collar_width',
                                                'style_front_pocket_width',
                                                'style_front_pocket_length',
                                                'style_shalwar_jeeb',
                                            ];
                                            // Group keys by prefix
                                            if ($styleData) {
                                                foreach ($styleData as $key => $value) {
                                                    $parts = explode('_', $key);
                                                    $prefix = $parts[0] . '_' . $parts[1];

                                                    // special case: style_front_pocket
                                                    if ($parts[1] === 'front') {
                                                        $prefix = $parts[0] . '_' . $parts[1] . '_' . $parts[2];
                                                    }

                                                    $grouped[$prefix][$key] = $value;
                                                }

                                                // Build rows
                                                foreach ($grouped as $prefix => $items) {
                                                    // If prefix main key does NOT exist, show items as normal rows
                                                    if (!isset($items[$prefix])) {
                                                        foreach ($items as $key => $value) {
                                                            $rows[] = [
                                                                'attribute' => str_replace('style_', '', $key),
                                                                'value' => $value,
                                                            ];
                                                        }
                                                        continue;
                                                    }

                                                    // Otherwise: normal processing
                                                    $mainKey = $prefix;
                                                    $mainValue = $items[$mainKey] ?? '';

                                                    $extraValues = [];

                                                    foreach ($items as $k => $v) {
                                                        if ($k !== $mainKey && in_array($k, $allowedExtraKeys)) {
                                                            $label = str_replace($mainKey . '_', '', $k);
                                                            $extraValues[] = ucfirst($label) . ': ' . $v;
                                                        }
                                                    }

                                                    $rows[] = [
                                                        'attribute' => str_replace('style_', '', $mainKey),
                                                        'value' =>
                                                            $mainValue .
                                                            (count($extraValues)
                                                                ? '   | (' . implode(', ', $extraValues) . ')'
                                                                : ''),
                                                    ];
                                                }
                                            }
                                        @endphp

                                        @if(!empty($rows))
                                            <h4 class="mt-3 mb-1 text-capitalize" style="font-weight:700;">Style Details
                                            </h4>
                                            <table class="table table-bordered table-striped mb-2">
                                                <thead>
                                                    <tr>
                                                        <th>Attribute</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($rows as $row)
                                                        <tr>
                                                            <td class="text-capitalize" style="width:150px;">
                                                                {{ Str::title(str_replace(['style_', '_'], ['', ' '], $row['attribute'])) }}
                                                            </td>
                                                            <td>{{ $row['value'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    @endif
                                </div>

                            </div>


                            @if (!empty($measurement['notes']))
                                <div class="mt-3">
                                    <strong>Notes:</strong>
                                    <p class="mt-2">{{ $measurement['notes'] }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.status-select').on('change', function() {
                const itemId = $(this).data('item-id');
                const status = $(this).val();
                $.ajax({
                    url: `/worker/sewing-order-items/${itemId}/update-status`,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                        _method: 'PUT'
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert('Failed to update status');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Failed to update status. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection

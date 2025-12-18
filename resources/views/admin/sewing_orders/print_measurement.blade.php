<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Measurement Details - {{ $item->sewingOrder->sewing_order_number }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/ZEB-TAILORS-Icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', sans-serif;
            color: #1f2937;
            -webkit-print-color-adjust: exact;
            font-size: 12px;
            font-weight: 600;
            /* Reduced base font size */
        }

        .print-container {
            background-color: #fff;
            padding: 15px;
            /* Reduced padding */
            margin: 10px auto;
            max-width: 700px;
            /* Reduced max-width */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }

        .header-section {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-name {
            font-size: 14px;
            /* Reduced font size */
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.5px;
        }

        .document-title {
            font-size: 12px;
            /* Reduced font size */
            font-weight: 600;
            color: #4b5563;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            /* Reduced gap */
            margin-bottom: 15px;
        }

        .info-card {
            background-color: #f9fafb;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }

        .info-label {
            font-size: 10px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 12px;
            font-weight: 500;
            color: #111827;
        }

        .section-title {
            font-size: 12px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 15px;
            padding-bottom: 4px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
        }

        /* .section-title::before {
            content: '';
            display: inline-block;
            width: 3px;
            height: 14px;
            background-color: #3b82f6;
            background-color: transparent;
            margin-right: 6px;
            border-radius: 2px;
        } */

        .measurement-table {
            width: 100%;
            border-collapse: collapse;
            /* Changed to collapse for compactness */
            margin-bottom: 10px;
            border: 1px solid #e5e7eb;
        }

        .measurement-table th,
        .measurement-table td {
            padding: 4px 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        .measurement-table th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
            text-align: left;
            width: 40%;
        }

        .measurement-table tr:last-child td,
        .measurement-table tr:last-child th {
            border-bottom: none;
        }

        .notes-box {
            background-color: #fffbeb;
            border: 1px solid #fcd34d;
            padding: 8px;
            border-radius: 6px;
            color: #92400e;
            margin-top: 10px;
            font-size: 11px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #5d6066;
            font-size: 11px;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            display: flex;
            justify-content: space-between;
        }

        .btn-print-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 10px;
        }

        .btn-custom {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 0.8rem;
        }

        .btn-primary-custom {
            background-color: #3b82f6;
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #2563eb;
        }

        .btn-secondary-custom {
            background-color: #fff;
            color: #4b5563;
            border: 1px solid #e5e7eb;
        }

        .btn-secondary-custom:hover {
            background-color: #f3f4f6;
        }

        .detail-list-item {
            line-height: 2;
        }

        @media print {
            @page {
                size: 4.5in 7in;
                margin: 0 auto;
            }

            body {
                background-color: #fff;
                font-size: 7pt;
                padding: 10px;
                width: 4.5in;
                margin: 0 auto;
                /* height: 7in; */
            }

            .print-container {
                box-shadow: none;
                margin: 0;
                padding: 0;
                width: 100%;
                max-width: none;
                border: none;
            }

            .btn-print-container {
                display: none;
            }

            .info-card {
                border: 1px solid #e5e7eb;
                padding: 5px;
            }

            .measurement-table th,
            .measurement-table td {
                padding: 3px 4px;
                font-size: 8pt;
            }

            .header-section {
                margin-bottom: 5px;
                padding-bottom: 0px;
            }

            .info-grid {
                gap: 5px;
                margin-bottom: 10px;
            }

            h5 {
                margin-top: 5px !important;
                margin-bottom: 2px !important;
                font-size: 8pt !important;
            }

            .brand-name {
                font-size: 10pt !important;
            }

            .document-title {
                font-size: 8pt !important;
            }

            .info-label {
                font-size: 7pt !important;
            }

            .info-value {
                font-size: 8pt !important;
            }

            .section-title {
                font-size: 8pt !important;
                margin-bottom: 5px !important;
            }

            .footer {
                font-size: 6pt !important;
            }
        }
    </style>
</head>

<body>

    <div class="btn-print-container">
        <button onclick="window.print()" class="btn-custom btn-primary-custom">
            Print Measurement
        </button>
        <button onclick="window.close()" class="btn-custom btn-secondary-custom">
            Close
        </button>
    </div>

    <div class="print-container">
        <div class="header-section">
            <div class="brand-name">{{ config('app.name') }}</div>
            <div class="document-title">Measurement Sheet</div>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">Customer Details </div>
                @if ($item->sewingOrder->customer->customer_id)
                    <div class="info-value">Customer ID: #{{ $item->sewingOrder->customer->customer_id }}</div>
                @endif
                <div class="info-value">Name: {{ $item->sewingOrder->customer->name }}</div>
                <div style="detail-list-item">Phone: {{ $item->sewingOrder->customer->phone }}</div>
                <div style="detail-list-item">Address: {{ $item->sewingOrder->customer->address }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">Order Details</div>
                <div class="info-value">Order #: {{ $item->sewingOrder->sewing_order_number }}</div>
                <div style="detail-list-item font-weight: 600;">Item:
                    {{ ucfirst($item?->product_name) }} |
                    @if ($item?->color)
                        {{ ucfirst($item?->color) }} |
                    @endif
                    (Qty: {{ $item?->qty }})
                </div>
                <div style="detail-list-item">Order Date:
                    {{ $item->sewingOrder->order_date->format('d M, Y') }}</div>
                <div style="detail-list-item">Delivery Date:
                    {{ $item->sewingOrder->delivery_date->format('d M, Y') }}</div>
            </div>
        </div>

        <div class="row g-0">
            <div
                class="col-{{ isset($measurement['style']) && (is_array($measurement['style']) || is_object($measurement['style'])) ? '4' : '12' }}">
                {{-- <div class="section-title">
                    {{ ucfirst(str_replace('_', ' ', $measurement['type'] ?? 'Standard')) }} Measurements
                </div> --}}

                @if (isset($measurement['data']) && (is_array($measurement['data']) || is_object($measurement['data'])))
                    @foreach ($measurement['data'] as $groupKey => $fields)
                        @if (is_array($fields) || is_object($fields))
                            <h5 class="section-title text-capitalize fw-bold text-secondary ps-1"
                                style="font-size: 0.95rem; color: #6b7280;">
                                {{ str_replace('_', ' ', $groupKey) }} Measurement
                            </h5>
                            <table class="measurement-table">
                                <tbody>
                                    @php
                                        // Same logic as in customer_measurement.blade.php
                                        $mainExtraPairs = [
                                            'shoulder' => ['shoulder_extra1'],
                                            'sleeve' => ['sleeve_extra1'],
                                            'chest' => ['chest_extra1'],
                                            'waist' => ['waist_extra1'],
                                        ];
                                        $usedKeys = [];
                                    @endphp
                                    @foreach ($fields as $key => $itemVal)
                                        @php
                                            // If this key is an extra for a previous main field, skip it
                                            $alreadyHandled = false;
                                            foreach ($mainExtraPairs as $main => $extras) {
                                                if (in_array($key, $extras)) {
                                                    $alreadyHandled = true;
                                                    break;
                                                }
                                            }
                                            if ($alreadyHandled || in_array($key, $usedKeys)) {
                                                continue;
                                            }
                                        @endphp

                                        @if (isset($mainExtraPairs[$key]))
                                            <tr>
                                                <th class="text-capitalize" style="width: 80px;">
                                                    {{ Str::title(str_replace('_', ' ', $key)) }}
                                                </th>
                                                <td>
                                                    {{ $itemVal }}
                                                    @foreach ($mainExtraPairs[$key] as $idx => $extraKey)
                                                        @if (isset($fields[$extraKey]) && $fields[$extraKey] !== '')
                                                            <span>
                                                                | ({{ $fields[$extraKey] }})
                                                            </span>
                                                            @php $usedKeys[] = $extraKey; @endphp
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <th class="text-capitalize" style="width: 80px;">
                                                    {{ Str::title(str_replace('_', ' ', $key)) }}
                                                </th>
                                                <td>{{ $itemVal }}</td>
                                            </tr>
                                        @endif
                                        @php $usedKeys[] = $key; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <table class="measurement-table">
                                <tbody>
                                    <tr>
                                        <th class="text-capitalize">{{ Str::title(str_replace('_', ' ', $groupKey)) }}
                                        </th>
                                        <td>{{ $fields }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    @endforeach
                @else
                    <div class="alert alert-info">No structured measurement data available.</div>
                @endif
            </div>
            <div class="col-8 px-2">
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
                                    (count($extraValues) ? '   | (' . implode(', ', $extraValues) . ')' : ''),
                            ];
                        }
                    @endphp

                    <h5 class="section-title fw-bold text-secondary" style="font-size: 0.95rem; color: #6b7280;">
                        Style Details
                    </h5>
                    <table class="measurement-table">
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <th class="text-capitalize" style="width: 80px">
                                        {{ Str::title(str_replace(['style_', '_'], ['', ' '], $row['attribute'])) }}
                                    </th>
                                    <td>{{ $row['value'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>



        @if (isset($measurement['notes']) && $measurement['notes'])
            <div class="section-title" style="margin-top: 20px;">
                Notes
            </div>
            <div class="notes-box">
                <strong>Note:</strong> {{ $measurement['notes'] }}
            </div>
        @endif

        <div class="footer">
            <p>Generated by {{ config('app.name') }}
                {{-- on {{ now()->format('d M, Y h:i A') }} --}}
            </p>
            <p>Developed by <span style="font-weight: 600">webspires.com.pk</strong></p>
        </div>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>

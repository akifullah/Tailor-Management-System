@php
    $payments = $sewingOrder->payments ?? collect([]);
    $totalPaid = $payments ? $payments->where('type', 'payment')->sum('amount') : 0;
    $totalRefunded = $payments ? $payments->where('type', 'refund')->sum('amount') : 0;
    $netPaid = $totalPaid - $totalRefunded;
    $remaining = $sewingOrder->total_amount - $netPaid;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sewing Order Receipt - {{ $sewingOrder->sewing_order_number }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/ZEB-TAILORS-Icon.png') }}">
    <style>
        body {
            font-family: monospace;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        .receipt {
            width: 80mm;
            padding: 5px 5px 15px;
            margin: 0 auto;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 2px 0;
            font-size: 12px;
        }

        th {
            border-bottom: 1px dashed #000;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="receipt">
        <div class="center bold">
            <div>{{ config('app.name', 'Tailor Management') }}</div>
        </div>
        <div class="line"></div>
        <div>
            <div>Order #: <span class="bold">{{ $sewingOrder->sewing_order_number }}</span></div>
            <div>Date: {{ $sewingOrder?->order_date?->format('Y-m-d') }}</div>
            @if($sewingOrder->customer)
                <div>Customer: {{ $sewingOrder->customer->name }}</div>
                @if($sewingOrder->customer->phone)
                    <div>Phone: {{ $sewingOrder->customer->phone }}</div>
                @endif
            @endif
        </div>
        <div class="line"></div>
        <table>
            <thead>
                <tr>
                    <th style="text-align:left;">Item</th>
                    <th class="right">Qty</th>
                    <th class="right">Price</th>
                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sewingOrder->items as $item)
                    <tr>
                        <td style="max-width: 35mm; word-wrap: break-word;">
                            {{ $item->product_name }}
                        </td>
                        <td class="right">{{ number_format($item->qty, 0) }}</td>
                        <td class="right">{{ number_format($item->sewing_price, 2) }}</td>
                        <td class="right">{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="line"></div>
        <table>
            <tr>
                <td class="bold">Total</td>
                <td class="right bold">Rs {{ number_format($sewingOrder->total_amount, 2) }}</td>
            </tr>

            <tr>
                <td>Refunded</td>
                <td class="right">Rs -{{ number_format($totalRefunded, 2) }}</td>
            </tr>
            <tr>
                <td>Total Paid</td>
                <td class="right bold">Rs {{ number_format($netPaid, 2) }}</td>
            </tr>
            <tr>
                <td class="bold">Remaining</td>
                <td class="right bold">Rs {{ number_format($remaining, 2) }}</td>
            </tr>
        </table>
        <div class="line"></div>
        <div class="center">
            Thank you! Made by webspires.com.pk
        </div>
    </div>
</body>

</html>
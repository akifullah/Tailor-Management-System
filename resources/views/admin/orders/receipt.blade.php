@php
    $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
    $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
    $netPaid = $totalPaid - $totalRefunded;
    $discount = $order->discount_amount ?? 0;
    $remaining = $order->total_amount - $netPaid - $discount ;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Receipt - {{ $order->order_number }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/ZEB-TAILORS-Icon.png') }}">
    <style>
        body {
            font-family: monospace;
            font-size: 13px;
            margin: 0;
            padding: 0;
            font-weight: 600;
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
            <div>Order #: <span class="bold">{{ $order->order_number }}</span></div>
            <div>Date: {{ $order?->order_date?->format('Y-m-d') }}</div>
            @if($order->customer)
                <div>Customer: {{ $order->customer->name }}</div>
                @if($order->customer->phone)
                    <div>Phone: {{ $order->customer->phone }}</div>
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
                @foreach($order->items as $item)
                    <tr>
                        <td style="max-width: 35mm; word-wrap: break-word;">
                            {{ $item->product ? $item->product->title : 'Custom Item' }}
                        </td>
                        <td class="right">{{ number_format($item->quantity_meters, 2) }}</td>
                        <td class="right">{{ number_format($item->sell_price, 2) }}</td>
                        <td class="right">{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="line"></div>
        <table>
            <tr>
                <td class="bold">Total</td>
                <td class="right bold">Rs {{ number_format($order->total_amount, 2) }}</td>
            </tr>

            {{-- <tr>
                <td>Refunded</td>
                <td class="right">Rs -{{ number_format($totalRefunded, 2) }}</td>
            </tr> --}}
            <tr>
                <td>Discount</td>
                <td class="right bold">Rs {{ number_format($discount, 2) }}</td>
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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk #{{ $transaction->transaction_id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            margin: 0;
            padding: 10px;
        }
        .receipt {
            width: 80mm;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .item {
            margin: 5px 0;
        }
        .total {
            margin-top: 10px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        @media print {
            body {
                width: 80mm;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt">
        <div class="header">
            <h2>{{ $transaction->outlet->outlet_name }}</h2>
            <p>{{ $transaction->outlet->address }}</p>
            <p>{{ $transaction->outlet->contact_info }}</p>
            <p>================================</p>
            <p>No: #{{ $transaction->transaction_id }}</p>
            <p>{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            <p>Kasir: {{ $transaction->user->username }}</p>
            <p>================================</p>
        </div>

        @foreach($transaction->items as $item)
        <div class="item">
            <div>{{ $item->product->product_name }}</div>
            <div>{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</div>
            <div style="text-align: right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
        </div>
        @endforeach

        <div class="total">
            <p>Total: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
            <p>Bayar: Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</p>
            <p>Kembali: Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</p>
            <p>================================</p>
            <p style="text-align: center">Terima Kasih</p>
            <p style="text-align: center">Atas Kunjungan Anda</p>
        </div>
    </div>
</body>
</html>

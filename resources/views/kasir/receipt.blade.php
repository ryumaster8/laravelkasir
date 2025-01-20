<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            max-width: 300px;
            margin: 0 auto;
            padding: 10px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mb-1 { margin-bottom: 5px; }
        .border-top { border-top: 1px dashed #000; padding-top: 5px; }
        .border-bottom { border-bottom: 1px dashed #000; padding-bottom: 5px; }
        .bold { font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 3px 0; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="text-center mb-1">
        <h2 style="margin:0">{{ $transaction->outlet->outlet_name }}</h2>
        <p>{{ $transaction->outlet->address }}</p>
        <p>Telp: {{ $transaction->outlet->contact_info }}</p>
    </div>

    <div class="border-bottom mb-1">
        <table>
            <tr>
                <td>No. Struk</td>
                <td>: {{ $transaction->transaction_id }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ $transaction->transaction_date }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>: {{ session('username') }}</td> <!-- Add cashier name -->
            </tr>
            @if($transaction->customer)
            <tr>
                <td>Customer</td>
                <td>: {{ $transaction->customer->customer_name }}</td>
            </tr>
            @endif
        </table>
    </div>

    <!-- Add Customer Info Section for Wholesale -->
    @if($transaction->sale_type === 'grosir' && $transaction->wholesaleCustomer)
    <div class="customer-info">
        <p>Pelanggan: {{ $transaction->wholesaleCustomer->customer_name }}</p>
       
    </div>
    <hr>
    @endif

    <table class="mb-1">
        <thead>
            <tr>
                <th class="text-left">Item</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->items as $item)
            <tr>
                <td>{{ $item->product->product_name }}</td>
                <td class="text-right">{{ $item->quantity }}</td>
                <td class="text-right">{{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="border-top">
        <table>
            <tr>
                <td>Subtotal</td>
                <td class="text-right">{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>PPN ({{ $transaction->tax_rate }}%)</td>
                <td class="text-right">{{ number_format($transaction->tax_amount, 0, ',', '.') }}</td>
            </tr>
            <tr class="bold">
                <td>Total</td>
                <td class="text-right">{{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunai</td>
                <td class="text-right">{{ number_format($transaction->payment_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kembali</td>
                <td class="text-right">{{ number_format($transaction->change_amount, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="text-center" style="margin-top:20px">
        <p>Terima kasih atas kunjungan Anda</p>
        <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
    </div>

    <button class="no-print" onclick="window.print()" style="width:100%; padding:10px; margin-top:20px;">
        Cetak Struk
    </button>
</body>
</html>

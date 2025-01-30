@extends('layouts.layout')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Detail Transaksi #{{ $transaction->transaction_id }}
            </h1>
            <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <!-- Transaction Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Transaction Details -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold mb-4 text-gray-700">Informasi Transaksi</h3>
                <table class="w-full">
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">Tanggal</td>
                        <td class="py-2 text-gray-800">: {{ $transaction->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">Operator</td>
                        <td class="py-2 text-gray-800">: {{ $transaction->user->username }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">Outlet</td>
                        <td class="py-2 text-gray-800">: {{ $transaction->outlet->outlet_name }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">Pelanggan</td>
                        <td class="py-2 text-gray-800">: {{ $transaction->sale_type === 'grosir' ? ($transaction->wholesaleCustomer->customer_name ?? '-') : '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">Jenis Penjualan</td>
                        <td class="py-2">
                            <span class="px-2 py-1 text-xs rounded-full {{ $transaction->sale_type === 'grosir' ? 'bg-purple-100 text-purple-800' : 'bg-indigo-100 text-indigo-800' }}">
                                : {{ ucfirst($transaction->sale_type) }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">Status</td>
                        <td class="py-2">
                            <span class="px-2 py-1 text-xs rounded-full {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                : {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Payment Details -->
            <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="font-semibold mb-4 text-blue-700">Informasi Pembayaran</h3>
                <table class="w-full">
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">Metode Pembayaran</td>
                        <td class="py-2">
                            <span class="px-2 py-1 text-xs rounded-full {{ $transaction->payment_method === 'tunai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                : {{ ucfirst($transaction->payment_method) }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">Total Item</td>
                        <td class="py-2 text-gray-800">: {{ $transaction->items->count() }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">Total Pembayaran</td>
                        <td class="py-2 text-gray-800">: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Items Table -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-4">Daftar Produk</h3>
            <table id="itemsTable" class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Barcode</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Serial</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Pro</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diskon</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($transaction->items as $index => $item)
                    <tr>
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">{{ $item->product->product_name }}</td>
                        <td class="px-4 py-3">{{ $item->product ? $item->product->product_code : 'N/A' }}</td>
                        <td class="px-4 py-3">
                            @if($item->product->has_serial_number)
                                {{ optional($item->productSerial)->serial_number ?? '-' }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full {{ $item->product->has_serial_number ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $item->product->has_serial_number ? 'Serial' : 'Non Serial' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $item->quantity }}</td>
                        <td class="px-4 py-3">{{ $item->formatted_price }}</td>
                        <td class="px-4 py-3">
                            @if($item->discount > 0)
                                {{ $item->discount }}{{ $item->discount_type === 'percentage' ? '%' : '' }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $item->formatted_subtotal }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full {{ $item->transaction_items_status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($item->transaction_items_status) }}
                            </span>
                        </td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#itemsTable').DataTable({
        responsive: true,
        pageLength: 10,
        ordering: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        }
    });
});
</script>
@endpush

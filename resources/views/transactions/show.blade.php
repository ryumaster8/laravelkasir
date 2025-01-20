@extends('layouts.layout')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container-fluid px-6 py-4">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-file-invoice mr-2"></i>Detail Transaksi
                    </h2>
                    <div class="space-x-2">
                        <a href="{{ route('transactions.group') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <a href="{{ route('receipt.print', $transaction->transaction_id) }}" 
                           target="_blank" 
                           class="btn btn-primary">
                            <i class="fas fa-print mr-1"></i> Cetak
                        </a>
                    </div>
                </div>

                <!-- Info Transaksi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-3">Informasi Transaksi</h3>
                        <table class="w-full">
                            <tr>
                                <td class="py-2 text-gray-600">No Transaksi</td>
                                <td class="py-2">: {{ $transaction->transaction_id }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-gray-600">Tanggal</td>
                                <td class="py-2">: {{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-gray-600">Outlet</td>
                                <td class="py-2">: {{ $transaction->outlet->outlet_name }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-gray-600">Operator</td>
                                <td class="py-2">: {{ $transaction->user->username }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-3">Informasi Pembayaran</h3>
                        <table class="w-full">
                            <tr>
                                <td class="py-2 text-gray-600">Metode Pembayaran</td>
                                <td class="py-2">: {{ ucfirst($transaction->payment_method) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-gray-600">Status</td>
                                <td class="py-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 text-gray-600">Total</td>
                                <td class="py-2 font-bold">: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Detail Items -->
                <div class="mt-6">
                    <h3 class="text-lg font-medium mb-3">Detail Item</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($transaction->items as $index => $item)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $item->product->product_name }}</td>
                                    <td class="px-6 py-4">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $item->transaction_items_status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
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
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<style>
    .btn {
        @apply inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-sm focus:outline-none focus:ring-2 focus:ring-offset-2;
    }
    .btn-primary {
        @apply text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500;
    }
    .btn-secondary {
        @apply text-gray-700 bg-gray-100 hover:bg-gray-200 focus:ring-gray-500;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#itemsTable').DataTable({
        pageLength: 10,
        ordering: true,
        info: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });
});
</script>
@endpush

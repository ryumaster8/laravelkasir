@extends('layouts.layout')

@section('title', 'Detail Penjualan Harian')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Detail Penjualan Tanggal {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
            </h1>
            <a href="{{ route('sales.report') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <!-- Transaction Overview -->
        <div class="overflow-x-auto">
            <table class="min-w-full mb-6 border">
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <!-- Left side -->
                        <td class="p-4">
                            <table class="w-full">
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium w-1/3">Outlet</td>
                                    <td class="py-2 text-gray-800 w-2/3">: {{ $transactions->first()->outlet->outlet_name }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium">Operator</td>
                                    <td class="py-2 text-gray-800">: {{ $transactions->first()->user->username }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium">Total Transaksi</td>
                                    <td class="py-2 text-gray-800">: {{ $transactions->count() }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium">Total Penjualan</td>
                                    <td class="py-2 text-gray-800">: Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium">Total Item</td>
                                    <td class="py-2 text-gray-800">: {{ $transactions->sum(function($t) { return $t->items->count(); }) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Transactions Table -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-list mr-2"></i>Daftar Transaksi
            </h2>
            <table id="transactionsTable" class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Item</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($transactions as $index => $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->created_at->format('H:i:s') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">#{{ $transaction->transaction_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->user->username }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $transaction->sale_type === 'grosir' 
                                ? $transaction->wholesaleCustomer->customer_name ?? '-'
                                : '-' 
                            }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->items->count() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full {{ $transaction->payment_method === 'tunai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($transaction->payment_method) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full {{ $transaction->sale_type === 'grosir' ? 'bg-purple-100 text-purple-800' : 'bg-indigo-100 text-indigo-800' }}">
                                {{ ucfirst($transaction->sale_type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <a href="{{ route('transactions.detail', ['id' => $transaction->transaction_id]) }}" 
                               class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i> Detail Produk
                            </a>
                            <a href="{{ route('receipt.print', $transaction->transaction_id) }}" 
                               target="_blank"
                               class="text-green-600 hover:text-green-900">
                                <i class="fas fa-print"></i> Cetak
                            </a>
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
    $('#transactionsTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[1, 'asc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
@endpush

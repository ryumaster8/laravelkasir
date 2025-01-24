@extends('layouts.layout')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Laporan Penjualan</h1>
        @if(Auth::user()->is_parent)
        <div class="flex gap-4">
            <a href="{{ route('sales.report') }}" 
               class="px-4 py-2 {{ !request()->routeIs('sales.report.group') ? 'bg-indigo-600' : 'bg-gray-500' }} text-white rounded-md hover:opacity-90">
                Outlet Ini
            </a>
            <a href="{{ route('sales.report.group') }}" 
               class="px-4 py-2 {{ request()->routeIs('sales.report.group') ? 'bg-indigo-600' : 'bg-gray-500' }} text-white rounded-md hover:opacity-90">
                Semua Outlet
            </a>
        </div>
        @endif
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row justify-between gap-4">
                <form id="filterForm" class="flex flex-wrap gap-4 flex-grow">
                    <div class="w-full md:w-auto">
                        <input type="date" name="start_date" id="start_date" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="w-full md:w-auto">
                        <input type="date" name="end_date" id="end_date"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="w-full md:w-auto">
                        <select name="status" id="status" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Status</option>
                            <option value="completed">Selesai</option>
                            <option value="cancelled">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="w-full md:w-auto">
                        <select name="payment_method" id="payment_method"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Pembayaran</option>
                            <option value="tunai">Tunai</option>
                            <option value="mbanking">M-Banking</option>
                        </select>
                    </div>
                    @if(request()->routeIs('sales.report.group') && isset($outlets))
                    <div class="w-full md:w-auto">
                        <select name="outlet_id" id="outlet_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Outlet</option>
                            @foreach($outlets as $outlet)
                            <option value="{{ $outlet->outlet_id }}" 
                                {{ request('outlet_id') == $outlet->outlet_id ? 'selected' : '' }}>
                                {{ $outlet->outlet_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Filter
                    </button>
                </form>
                {{-- <button onclick="exportToExcel()" 
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 whitespace-nowrap">
                    Export Excel
                </button> --}}
            </div>
        </div>
        
        {{-- 
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total Transaksi -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-4 text-white shadow-lg">
                    <p class="text-sm font-medium opacity-75">Total Transaksi</p>
                    <p class="text-3xl font-bold mt-2">{{ $summary['total_transactions'] }}</p>
                </div>

                <!-- Total Penjualan -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-4 text-white shadow-lg">
                    <p class="text-sm font-medium opacity-75">Total Penjualan</p>
                    <p class="text-3xl font-bold mt-2">Rp {{ number_format($summary['total_sales'], 0, ',', '.') }}</p>
                </div>

                <!-- Total Item -->
                <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg p-4 text-white shadow-lg">
                    <p class="text-sm font-medium opacity-75">Total Item Terjual</p>
                    <p class="text-3xl font-bold mt-2">{{ $summary['total_items'] }}</p>
                </div>

                <!-- Rata-rata Transaksi -->
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-4 text-white shadow-lg">
                    <p class="text-sm font-medium opacity-75">Rata-rata Transaksi</p>
                    <p class="text-3xl font-bold mt-2">Rp {{ number_format($summary['average_transaction'], 0, ',', '.') }}</p>
                </div>
            </div> --}}

            <div class="overflow-x-auto">
                <table id="salesTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Transaksi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Item</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            @if(request()->routeIs('sales.report.group'))
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Outlet
                            </th>
                            @endif
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $transaction->transaction_id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $transaction->wholesaleCustomer->customer_name ?? 'Retail' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $transaction->items_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ ucfirst($transaction->payment_method) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            @if(request()->routeIs('sales.report.group'))
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $transaction->outlet->outlet_name }}
                            </td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('transactions.show', $transaction->transaction_id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#salesTable').DataTable({
        order: [[0, 'desc']],
        pageLength: 25
    });

    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        window.location.href = '{{ route("sales.report") }}?' + $(this).serialize();
    });
});

function exportToExcel() {
    let params = new URLSearchParams(window.location.search);
    params.append('export', 'excel');
    window.location.href = '{{ route("sales.report") }}?' + params.toString();
}
</script>
@endpush
@endsection

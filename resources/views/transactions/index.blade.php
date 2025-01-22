@extends('layouts.layout')

@section('title', 'Daftar Transaksi')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<style>
.btn-group .btn {
    padding: 0.375rem 1rem;
    font-size: 0.9rem;
}
.btn-group .btn i {
    margin-right: 5px;
}
.alert i {
    margin-right: 5px;
}
</style>
@endpush

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Transaksi</h2>
                
                @if($isParentUser)
                    <div class="flex space-x-4 mb-4">
                        <a href="{{ route('transactions.index') }}" 
                           class="{{ !isset($showingGroupData) 
                                ? 'bg-indigo-600 text-white' 
                                : 'bg-white text-indigo-600 border border-indigo-600' }} 
                                px-4 py-2 rounded-md hover:opacity-90 flex items-center">
                            <i class="fas fa-store mr-2"></i>
                            Data Outlet Ini
                        </a>
                        <a href="{{ route('transactions.group') }}" 
                           class="{{ isset($showingGroupData) 
                                ? 'bg-indigo-600 text-white' 
                                : 'bg-white text-indigo-600 border border-indigo-600' }} 
                                px-4 py-2 rounded-md hover:opacity-90 flex items-center">
                            <i class="fas fa-store-alt mr-2"></i>
                            Data Semua Outlet
                        </a>
                    </div>
                @endif
            </div>

            <div class="p-6">
                @if(isset($showingGroupData))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Menampilkan data transaksi dari semua outlet dalam group
                    </div>
                @endif

                <!-- Filter -->
                <div class="mb-6">
                    <form action="{{ route('transactions.index') }}" method="GET" class="flex items-center space-x-4">
                        <div class="flex items-center space-x-4">
                            <!-- Date Filter -->
                            <div class="flex items-center space-x-2">
                                <input type="date" name="start_date" value="{{ request('start_date') }}" 
                                       class="form-input rounded-md shadow-sm border-gray-300">
                                <span class="text-gray-500">sampai</span>
                                <input type="date" name="end_date" value="{{ request('end_date') }}" 
                                       class="form-input rounded-md shadow-sm border-gray-300">
                            </div>

                            <!-- Operator Filter -->
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-500">Operator:</span>
                                <select name="operator_id" class="form-select rounded-md shadow-sm border-gray-300">
                                    <option value="">Semua Operator</option>
                                    @foreach($operators as $operator)
                                        <option value="{{ $operator->user_id }}" {{ request('operator_id') == $operator->user_id ? 'selected' : '' }}>
                                            {{ $operator->username }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Filter
                        </button>
                        
                        @if(request()->anyFilled(['start_date', 'end_date', 'operator_id']))
                            <a href="{{ route('transactions.index') }}" 
                               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table id="transactionsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Operator</th>
                                @if(isset($showingGroupData))
                                    <th>Outlet</th>
                                @endif
                                <th>Jenis Penjualan</th>
                                <th>Total Amount</th>
                                <th>Jumlah Produk</th>
                                <th>Tanggal Transaksi</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $index => $transaction)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        #{{ $transaction->transaction_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ optional($transaction->user)->username ?? '-' }}
                                    </td>
                                    @if(isset($showingGroupData))
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ optional($transaction->outlet)->outlet_name ?? '-' }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ ucfirst($transaction->sale_type) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $transaction->items_count ?? count($transaction->items) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $transaction->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ ucfirst($transaction->payment_method) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('transactions.show', $transaction->transaction_id) }}" 
                                               class="bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700 flex items-center">
                                                <i class="fas fa-eye mr-1"></i>
                                                Detail
                                            </a>
                                            <a href="{{ route('receipt.print', $transaction->transaction_id) }}" 
                                               target="_blank"
                                               class="bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700 flex items-center">
                                                <i class="fas fa-print mr-1"></i>
                                                Cetak
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transactionsTable').DataTable({
            responsive: true,
            processing: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            order: [[0, 'asc']],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush

@endsection

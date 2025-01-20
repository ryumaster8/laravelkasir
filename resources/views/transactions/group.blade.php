@extends('layouts.layout')

@section('title', 'Transaksi Group Outlet')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<style>
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 20px;
    }
    .badge-outlet {
        @apply px-2.5 py-1 rounded-full text-xs font-medium;
    }
</style>
@endpush

@section('content')
<div class="px-6 py-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-store-alt mr-2"></i>Transaksi Semua Outlet
                    </h2>
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>

                <table id="transactionsTable" class="w-full">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Outlet</th>
                            <th>No Transaksi</th>
                            <th>Operator</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge-outlet bg-blue-100 text-blue-800">
                                        {{ $transaction->outlet->outlet_name ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $transaction->transaction_id }}</td>
                                <td>{{ $transaction->user->username ?? '-' }}</td>
                                <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge-outlet {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('transactions.show', $transaction->transaction_id) }}" 
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function() {
    $('#transactionsTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[0, 'desc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json',
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        columnDefs: [
            {
                targets: [1, 5, 6], // outlet, status, dan aksi columns
                orderable: false
            }
        ]
    });
});
</script>
@endpush

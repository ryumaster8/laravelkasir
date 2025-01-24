@extends('layouts.layout')

@section('title', 'Daftar Produk Outlet')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Produk Outlet</h1>
            <p class="mt-2 text-sm text-gray-700">Kelola semua produk outlet Anda di sini</p>
        </div>

        <x-flash-message />

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <!-- DataTable -->
                <table id="productsTable" class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barcode</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Modal</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Jual</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($products as $key => $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $product->product_code }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-medium">{{ $product->product_name }}</div>
                                <div class="text-gray-500">{{ $product->brand }}</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $product->category->category_name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                <span class="font-medium {{ $product->stock < 10 ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $product->has_serial_number ? $product->serials->where('status', 'available')->count() : $product->stock }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($product->price_modal, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    @if ($product->has_serial_number)
                                        <div class="flex space-x-1">
                                            <a href="{{ route('self-products.edit', $product->product_id) }}" 
                                               class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <a href="{{ route('self-products.add-serial', $product->product_id) }}"
                                               class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <i class="fas fa-plus mr-1"></i> Seri
                                            </a>
                                            <button type="button" onclick="showStockModal('{{ $product->product_id }}')"
                                                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                <i class="fas fa-exchange-alt mr-1"></i> Transfer
                                            </button>
                                        </div>
                                    @else
                                        <div class="flex space-x-1">
                                            <a href="{{ route('self-products.edit-non-serial', $product->product_id) }}"
                                               class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <a href="{{ route('self-products.add-stock', $product->product_id) }}"
                                               class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <i class="fas fa-plus mr-1"></i> Stok
                                            </a>
                                            <a href="{{ route('self-products.transfer-stock', $product->product_id) }}"
                                               class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                <i class="fas fa-exchange-alt mr-1"></i> Transfer
                                            </a>
                                        </div>
                                    @endif
                                </div>
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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://kit.fontawesome.com/e4bb0d77af.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#productsTable').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
            }
        });
    });
</script>
@endpush

<style>
    /* Custom DataTables Styling */
    .dataTables_wrapper .dataTables_filter input {
        @apply rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500;
    }
    .dataTables_wrapper .dataTables_length select {
        @apply rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        @apply px-3 py-1 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        @apply bg-indigo-600 text-white hover:bg-indigo-700;
    }
</style>

@endsection
@extends('layouts.layout')

@section('title', 'Daftar Produk Outlet')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Produk Outlet</h1>
    <x-flash-message />
    
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table id="productsTable" class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-14 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk ID</th>
                    <th class="w-28 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Produk</th>
                    <th class="w-28 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barcode</th>
                    <th class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                    <th class="w-28 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merk</th>
                    <th class="w-28 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="w-28 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                    <th class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomer Serial</th>
                    <th class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="w-28 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Modal</th>
                    <th class="w-28 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Grosir</th>
                    <th class="w-auto px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Ecer</th>
                    <th class="w-auto min-w-[400px] px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $key => $product)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $key + 1 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $product->product_id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $product->has_serial_number ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $product->has_serial_number ? 'Serial' : 'Non-Serial' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $product->product_code }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $product->product_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $product->brand }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $product->category->category_name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $product->supplier->supplier_name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            @if ($product->has_serial_number)
                                @php
                                    $availableSerials = $product->serials->where('status', 'tersedia');
                                @endphp
                                @foreach ($availableSerials as $serial)
                                    {{ $serial->serial_number }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                                @if ($availableSerials->isEmpty())
                                    -
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            @if ($product->has_serial_number)
                                {{ $product->serials->where('status', 'available')->count() }}
                            @else
                                {{ $product->productStock->where('outlet_id', session('outlet_id'))->first()->stock ?? 0 }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($product->price_modal, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($product->price_grosir, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4 text-sm font-medium">
                            @if ($product->has_serial_number)
                                <div class="flex gap-2 min-w-max">
                                    <a href="{{ route('self-products.edit', $product->product_id) }}" 
                                       class="px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                                        Edit
                                    </a>
                                    <a href="{{ route('self-products.add-serial', $product->product_id) }}"
                                       class="px-3 py-1 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700">
                                        Tambah Seri
                                    </a>
                                    <a href="{{ route('self-products.reduce-unit', $product->product_id) }}"
                                       class="px-3 py-1 bg-yellow-600 text-white text-sm font-medium rounded hover:bg-yellow-700">
                                        Kurangi Unit
                                    </a>
                                    <a href="{{ route('self-products.transfer-unit', $product->product_id) }}"
                                       class="px-3 py-1 bg-cyan-600 text-white text-sm font-medium rounded hover:bg-cyan-700">
                                        Pindah Unit
                                    </a>
                                </div>
                            @else
                                <div class="flex gap-2 min-w-max">
                                    <a href="{{ route('self-products.edit-non-serial', $product->product_id) }}"
                                       class="px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                                        Edit
                                    </a>
                                    <a href="{{ route('self-products.add-stock', $product->product_id) }}"
                                       class="px-3 py-1 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700">
                                        Tambah Stok
                                    </a>
                                    <a href="{{ route('self-products.reduce-stock', $product->product_id) }}"
                                       class="px-3 py-1 bg-yellow-600 text-white text-sm font-medium rounded hover:bg-yellow-700">
                                        Kurangi Stok
                                    </a>
                                    <a href="{{ route('self-products.transfer-stock', $product->product_id) }}"
                                       class="px-3 py-1 bg-cyan-600 text-white text-sm font-medium rounded hover:bg-cyan-700">
                                        Pindah Stok
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://kit.fontawesome.com/e4bb0d77af.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#productsTable').DataTable({
            responsive: true
        });
    });
</script>

<style>
    .dataTables_wrapper {
        @apply w-full overflow-x-auto;
    }
    #productsTable {
        @apply w-full table-fixed;
    }
    .dataTables_wrapper select, .dataTables_wrapper .dataTables_filter input {
        @apply border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        @apply px-3 py-1 mx-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        @apply text-white bg-blue-600 border-blue-600 hover:bg-blue-700;
    }
</style>
@endsection
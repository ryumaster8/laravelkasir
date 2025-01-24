@extends('layouts.layout')

@section('title', 'Daftar Produk Outlet')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Produk Outlet</h1>
    <x-flash-message />
    
    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
        <table class="min-w-full divide-y divide-gray-200" id="productsTable">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barcode</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merk</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomer Serial</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Modal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Grosir</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Ecer</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $key => $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->product_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->product_code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->product_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->brand }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->category->category_name ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->supplier->supplier_name ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if ($product->has_serial_number)
                            @foreach ($product->serials as $serial)
                                {{ $serial->serial_number }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if ($product->has_serial_number)
                            {{ $product->serials->where('status', 'available')->count() }}
                        @else
                            {{ $product->stock }}
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($product->price_modal, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($product->price_grosir, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                        @if ($product->has_serial_number)
                            <div class="flex space-x-2">
                                <a href="{{ route('self-products.edit', $product->product_id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                                <a href="{{ route('self-products.add-serial', $product->product_id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                    <i class="fas fa-plus mr-2"></i>Tambah Seri
                                </a>
                                <a href="{{ route('self-products.reduce-unit', $product->product_id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700">
                                    <i class="fas fa-minus mr-2"></i>Kurangi Unit
                                </a>
                                <a href="{{ route('self-products.transfer-unit', $product->product_id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700">
                                    <i class="fas fa-exchange-alt mr-2"></i>Pindah Unit
                                </a>
                            </div>
                        @else
                            <div class="flex space-x-2">
                                <a href="{{ route('self-products.edit-non-serial', $product->product_id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                                <a href="{{ route('self-products.add-stock', $product->product_id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                    <i class="fas fa-plus mr-2"></i>Tambah Stok
                                </a>
                                <a href="{{ route('self-products.reduce-stock', $product->product_id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700">
                                    <i class="fas fa-minus mr-2"></i>Kurangi Stok
                                </a>
                                <a href="{{ route('self-products.transfer-stock', $product->product_id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700">
                                    <i class="fas fa-exchange-alt mr-2"></i>Pindah Stok
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

@push('scripts')
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
@endpush

@endsection

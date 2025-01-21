@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-800">Produk yang Mendapatkan Diskon Aktif</h3>
        </div>
        
        <div class="p-6 overflow-x-auto">
            <table id="applyProductTable" class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Kode Produk</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Harga Sebelum Diskon</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Diskon</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Harga Setelah Diskon</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Diskon Berlaku Sampai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($productsWithDiscount as $index => $discount)
                        @php
                            $product = $discount->product;
                            $discountedPrice = $product ? 
                                ($discount->type == 'percentage' 
                                    ? $product->price * (1 - $discount->value / 100) 
                                    : $product->price - $discount->value) 
                                : 0;
                            
                            // Get product code based on serial/non-serial
                            $productCode = $product ? 
                                ($product->has_serial_number ? 'Serial' : $product->product_code) 
                                : '-';
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $product->product_name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                @if($product && $product->has_serial_number)
                                    <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Serial</span>
                                @else
                                    {{ $productCode }}
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 text-sm rounded-full {{ $discount->type === 'percentage' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    @if ($discount->type === 'percentage')
                                        {{ $discount->value }}%
                                    @else
                                        Rp {{ number_format($discount->value, 0, ',', '.') }}
                                    @endif
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-green-600">
                                Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($discount->end_date)->format('d M Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#applyProductTable').DataTable({
            dom: '<"flex flex-col sm:flex-row justify-between items-center mb-4"lf>rtip',
            language: {
                search: "",
                searchPlaceholder: "Cari...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            },
            pageLength: 10,
            order: [[0, 'asc']],
            responsive: true,
            initComplete: function() {
                // Custom styling for search input
                $('.dataTables_filter input').addClass('px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500');
                // Custom styling for length select
                $('.dataTables_length select').addClass('px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500');
            }
        });
    });
</script>
@endpush

@endsection

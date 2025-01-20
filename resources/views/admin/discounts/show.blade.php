@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 mt-8">
    <!-- Kartu Detail Diskon -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="border-b p-4">
            <h3 class="text-xl font-semibold text-gray-800"><i class="fas fa-tags"></i> Detail Diskon</h3>
        </div>
        <div class="p-6">
            <p class="mb-4"><strong><i class="fas fa-calendar-alt mr-2"></i>Kategori:</strong> {{ $discount->category ? $discount->category->category_name : '-' }}</p>
            <p class="mb-4"><strong><i class="fas fa-list-alt mr-2"></i>Berlaku Untuk:</strong> 
                <span class="px-2 py-1 text-sm text-white bg-blue-600 rounded-full">{{ ucfirst($discount->applies_to) }}</span>
            </p>
            <p class="mb-4"><strong><i class="fas fa-clock mr-2"></i>Periode:</strong> {{ $discount->start_date }} - {{ $discount->end_date }}</p>
            <p class="mb-4"><strong><i class="fas fa-percentage mr-2"></i>Tipe Diskon:</strong> 
                <span class="px-2 py-1 text-sm text-white bg-blue-400 rounded-full">{{ ucfirst($discount->type) }}</span>
            </p>
            <p class="mb-4"><strong><i class="fas fa-coins mr-2"></i>Besar Diskon:</strong> 
                @if ($discount->type === 'percentage')
                    <span class="px-2 py-1 text-sm text-white bg-green-500 rounded-full">{{ $discount->value }}%</span>
                @elseif ($discount->type === 'fixed')
                    <span class="px-2 py-1 text-sm text-white bg-green-500 rounded-full">Rp {{ number_format($discount->value, 0, ',', '.') }}</span>
                @endif
            </p>
            <p class="mb-4"><strong><i class="fas fa-users mr-2"></i>Diskon Berlaku Untuk:</strong> 
                <span class="px-2 py-1 text-sm text-gray-800 bg-yellow-400 rounded-full">{{ $discount->applies_to === 'product' ? 'Produk' : 'Kategori' }}</span>
            </p>
            <p class="mb-4"><strong><i class="fas fa-toggle-on mr-2"></i>Status:</strong> 
                <span class="px-2 py-1 text-sm text-white {{ $discount->is_active ? 'bg-green-500' : 'bg-red-500' }} rounded-full">
                    {{ $discount->is_active ? 'Aktif' : 'Tidak Aktif' }}
                </span>
            </p>

            @if ($discount->applies_to === 'product' && $discount->product)
                <hr class="my-6">
                <h5 class="text-lg font-semibold text-gray-800 mb-4"><i class="fas fa-box mr-2"></i>Produk yang Mendapatkan Diskon</h5>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-600">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Barcode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Harga Sebelum Diskon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Harga Setelah Diskon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Serial Number</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">1</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $discount->product->product_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $discount->product->product_code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($discount->product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($discount->type === 'percentage')
                                        Rp {{ number_format($discount->product->price - ($discount->product->price * $discount->value / 100), 0, ',', '.') }}
                                    @elseif ($discount->type === 'fixed')
                                        Rp {{ number_format($discount->product->price - $discount->value, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $discount->product->has_serial_number ? 'Ya' : 'Tidak' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="border-t p-4 text-right">
            <a href="{{ route('discounts.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection

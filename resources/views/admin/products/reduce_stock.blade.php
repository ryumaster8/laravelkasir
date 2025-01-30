@extends('layouts.layout')

@section('title', 'Kurangi Stok Produk')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-800">{{ $product->product_name }}</h3>
        </div>
        
        <div class="p-6">
            <x-flash-message />
            
            <form action="{{ route('self-products.store-reduce-stock', $product->product_id) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Product ID -->
                <div>
                    <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Produk ID</label>
                    <input type="text" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                           id="product_id" 
                           name="product_id" 
                           value="{{ $product->product_id }}" 
                           readonly>
                </div>

                <!-- Operator -->
                <div>
                    <label for="operator" class="block text-sm font-medium text-gray-700 mb-1">Operator</label>
                    <input type="text" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                           id="operator" 
                           name="operator" 
                           value="{{ $user->username }}" 
                           readonly>
                </div>

                <!-- Outlet -->
                <div>
                    <label for="outlet" class="block text-sm font-medium text-gray-700 mb-1">Outlet</label>
                    <input type="text" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                           id="outlet" 
                           name="outlet" 
                           value="{{ $user->outlet ? $user->outlet->outlet_name : '' }}" 
                           readonly>
                </div>

                <!-- Product Name -->
                <div>
                    <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                           id="product_name" 
                           name="product_name" 
                           value="{{ $product->product_name }}" 
                           readonly>
                </div>

                <!-- Brand -->
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Merek</label>
                    <input type="text" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                           id="brand" 
                           name="brand" 
                           value="{{ $product->brand }}" 
                           readonly>
                </div>

                <!-- Barcode -->
                <div>
                    <label for="product_code" class="block text-sm font-medium text-gray-700 mb-1">Barcode</label>
                    <input type="text" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                           id="product_code" 
                           name="product_code" 
                           value="{{ $product->product_code }}" 
                           readonly>
                </div>

                <!-- Current Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok Saat Ini</label>
                    <input type="number" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                           id="stock" 
                           name="stock" 
                           value="{{ $productStock->stock ?? 0 }}" 
                           readonly>
                </div>

                <!-- Quantity to Reduce -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Stok yang Dikurangi</label>
                    <input type="number" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 
                           @error('quantity') border-red-500 ring-red-100 @enderror"
                           id="quantity" 
                           name="quantity" 
                           value="{{ old('quantity') }}" 
                           min="1" 
                           max="{{ $productStock->stock ?? 0 }}" 
                           step="1">
                    @error('quantity')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Sisa Stok: {{ $productStock->stock ?? 0 }}</p>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('self-products') }}" 
                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Kurangi Stok
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('quantity').addEventListener('input', function(e) {
        const max = parseInt(this.getAttribute('max'));
        const value = parseInt(this.value);
        if (value > max) {
            this.value = max;
        }
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        const qty = document.getElementById('quantity').value;
        
        if(confirm(
            `Apakah Anda yakin ingin mengurangi stok?\n\n` +
            `Detail Pengurangan:\n` +
            `- Produk: {{ $product->product_name }}\n` +
            `- Jumlah: ${qty} {{ $product->unit ?? 'unit' }}\n` +
            `- Operator: {{ $user->username }}\n` +
            `- Outlet: {{ $user->outlet->outlet_name }}\n` +
            `- Stok Saat Ini: {{ $productStock->stock ?? 0 }}\n\n` +
            `Setelah pengurangan, stok akan berkurang sebanyak ${qty} unit.`
        )) {
            this.submit();
        }
    });
</script>
@endpush
@endsection
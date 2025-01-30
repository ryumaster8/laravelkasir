@extends('layouts.layout')

@section('title', 'Tambah Stok Produk')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-800">Tambah Stok untuk {{ $product->product_name }}</h3>
        </div>
        
        <div class="p-6">
            <x-flash-message />
            
            <form action="{{ route('self-products.store-add-stock', $product->product_id) }}" method="POST" class="space-y-6">
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

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            Rp
                        </span>
                        <input type="text" 
                               class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                               id="price" 
                               name="price" 
                               value="{{ number_format($product->price, 2) }}" 
                               readonly>
                    </div>
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

                <!-- Quantity to Add -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Stok yang Ditambahkan</label>
                    <input type="number" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 
                           @error('quantity') border-red-500 ring-red-100 @enderror"
                           id="quantity" 
                           name="quantity" 
                           value="{{ old('quantity') }}" 
                           min="1" 
                           step="1">
                    @error('quantity')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('self-products') }}" 
                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Tambah Stok
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        const qty = document.getElementById('quantity').value;
        const currentStock = {{ $productStock->stock ?? 0 }};
        const newStock = currentStock + parseInt(qty);
        
        if(confirm(
            `Apakah Anda yakin ingin menambah stok?\n\n` +
            `Detail Penambahan:\n` +
            `- Produk: {{ $product->product_name }}\n` +
            `- Jumlah: +${qty} {{ $product->unit ?? 'unit' }}\n` +
            `- Operator: {{ $user->username }}\n` +
            `- Outlet: {{ $user->outlet->outlet_name }}\n` +
            `- Stok Saat Ini: ${currentStock}\n` +
            `- Stok Setelah Penambahan: ${newStock}\n\n` +
            `Aktivitas ini akan dicatat dalam log sistem.`
        )) {
            this.submit();
        }
    });
</script>
@endpush
@endsection
@extends('layouts.layout')

@section('title', 'Pindah Stok Produk')

@section('content')
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl md:max-w-2xl lg:max-w-4xl mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-3xl font-bold text-gray-900">Pindah Stok Produk</h2>
                            <span class="text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </span>
                        </div>

                        <x-flash-message />

                        <form action="{{ route('self-products.store-transfer-stock', $product->product_id) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Product Info Card -->
                            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Produk ID</label>
                                        <div class="mt-1 text-lg font-semibold text-gray-900">{{ $product->product_id }}</div>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Operator</label>
                                        <div class="mt-1 text-lg font-semibold text-gray-900">{{ $user->username }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Outlet Selection -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Outlet Asal</label>
                                    <div class="mt-1 p-2 bg-gray-50 border border-gray-300 rounded-md">
                                        {{ $user->outlet ? $user->outlet->outlet_name : '' }}
                                    </div>
                                </div>

                                <div>
                                    <label for="to_outlet_id" class="block text-sm font-medium text-gray-700">
                                        Pindahkan Ke Outlet
                                    </label>
                                    <select id="to_outlet_id" 
                                            name="to_outlet_id" 
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md @error('to_outlet_id') border-red-500 @enderror">
                                        <option value="">-- Pilih Outlet --</option>
                                        @foreach ($outlets as $outlet)
                                            <option value="{{ $outlet->outlet_id }}" {{ old('to_outlet_id') == $outlet->outlet_id ? 'selected' : '' }}>
                                                {{ $outlet->outlet_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('to_outlet_id')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Stock Quantity -->
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">
                                        Jumlah Stok yang Dipindahkan
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="number" 
                                               name="quantity" 
                                               id="quantity" 
                                               class="block w-full pr-12 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('quantity') border-red-500 @enderror"
                                               value="{{ old('quantity') }}"
                                               min="1"
                                               max="{{ $productStock->stock ?? 0 }}"
                                               step="1">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">unit</span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">Sisa Stok: {{ $productStock->stock ?? 0 }} unit</p>
                                    @error('quantity')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center space-x-4 pt-6">
                                <button type="submit" 
                                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 ease-in-out transform hover:-translate-y-1">
                                    Pindah Stok
                                </button>
                                <a href="{{ route('self-products') }}" 
                                   class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg text-center transition duration-200 ease-in-out transform hover:-translate-y-1">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Add any custom JavaScript here
    document.getElementById('quantity').addEventListener('input', function(e) {
        const max = parseInt(this.getAttribute('max'));
        const value = parseInt(this.value);
        if (value > max) {
            this.value = max;
        }
    });
</script>
@endpush

@endsection
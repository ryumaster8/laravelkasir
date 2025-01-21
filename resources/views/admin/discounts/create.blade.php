@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 mt-10">
    <div class="bg-white rounded-lg shadow-md">
        <div class="border-b border-gray-400 px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-800">Tambah Diskon</h3>
        </div>
        <div class="p-6">
            <x-flash-message />
            <form action="{{ route('discounts.store') }}" method="POST">
                @csrf

                <!-- Nama Diskon -->
                <div class="mb-4">
                    <label for="discount_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Diskon</label>
                    <input type="text" name="discount_name" id="discount_name" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           placeholder="Masukkan nama diskon" 
                           value="{{ old('discount_name') }}" 
                           required>
                </div>

                <!-- Tipe Diskon -->
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Diskon</label>
                    <select name="type" id="type" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            required>
                        <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Persentase</option>
                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Nominal Tetap</option>
                    </select>
                </div>

                <!-- Nilai Diskon -->
                <div class="mb-4">
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-2">Nilai Diskon</label>
                    <input type="number" name="value" id="value" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           placeholder="Masukkan nilai diskon" 
                           value="{{ old('value') }}" 
                           required>
                </div>

                <!-- Berlaku Untuk -->
                <div class="mb-4">
                    <label for="applies_to" class="block text-sm font-medium text-gray-700 mb-2">Berlaku Untuk</label>
                    <select name="applies_to" id="applies_to" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            required>
                        <option value="">-- Pilih --</option>
                        <option value="product" {{ old('applies_to') == 'product' ? 'selected' : '' }}>Produk Tertentu</option>
                        <option value="category" {{ old('applies_to') == 'category' ? 'selected' : '' }}>Kategori Produk</option>
                    </select>
                </div>

                <!-- Pilih Produk -->
                <div class="mb-4 {{ old('applies_to') == 'product' ? '' : 'hidden' }}" id="product_select">
                    <label for="product_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Produk</label>
                    <select name="product_id" id="product_id" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->product_id }}" {{ old('product_id') == $product->product_id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Kategori -->
                <div class="mb-4 {{ old('applies_to') == 'category' ? '' : 'hidden' }}" id="category_select">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kategori</label>
                    <select name="category_id" id="category_id" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Mulai -->
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           value="{{ old('start_date') }}" 
                           required>
                </div>

                <!-- Tanggal Berakhir -->
                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir</label>
                    <input type="date" name="end_date" id="end_date" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           value="{{ old('end_date') }}" 
                           required>
                </div>

                <!-- Footer -->
                <div class="border-t border-gray-400 px-6 py-4 mt-6 flex justify-between">
                    <a href="{{ route('discounts.index') }}" 
                       class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                        Kembali
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const appliesToSelect = document.getElementById('applies_to');
        const productSelect = document.getElementById('product_select');
        const categorySelect = document.getElementById('category_select');
        const productInput = document.getElementById('product_id');
        const categoryInput = document.getElementById('category_id');

        appliesToSelect.addEventListener('change', function () {
            const value = this.value;

            if (value === 'product') {
                productSelect.classList.remove('hidden');
                categorySelect.classList.add('hidden');
                categoryInput.value = 0; // Set kategori ke 0 jika tidak relevan
            } else if (value === 'category') {
                productSelect.classList.add('hidden');
                categorySelect.classList.remove('hidden');
                productInput.value = 0; // Set produk ke 0 jika tidak relevan
            }
        });

        // Inisialisasi awal berdasarkan nilai applies_to
        appliesToSelect.dispatchEvent(new Event('change'));
    });
</script>

@endsection

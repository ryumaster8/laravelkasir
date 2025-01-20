@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <x-flash-message />

    <h3 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($discount) ? 'Edit Diskon' : 'Tambah Diskon' }}</h3>

    <form action="{{ isset($discount) ? route('discounts.update', $discount->discount_id) : route('discounts.store') }}" method="POST">
        @csrf
        @if (isset($discount))
            @method('PUT')
        @endif

        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 space-y-4">
                <!-- Nama Diskon -->
                <div>
                    <label for="discount_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Diskon</label>
                    <input type="text" name="discount_name" id="discount_name" 
                           class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                           placeholder="Masukkan nama diskon" 
                           value="{{ old('discount_name', $discount->discount_name ?? '') }}">
                </div>

                <!-- Tipe Diskon -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Diskon</label>
                    <select name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="percentage" {{ old('type', $discount->type ?? '') == 'percentage' ? 'selected' : '' }}>Persentase</option>
                        <option value="fixed" {{ old('type', $discount->type ?? '') == 'fixed' ? 'selected' : '' }}>Nominal Tetap</option>
                    </select>
                </div>

                <!-- Nilai Diskon -->
                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-1">Nilai Diskon</label>
                    <input type="number" name="value" id="value" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           placeholder="Masukkan nilai diskon" 
                           value="{{ old('value', $discount->value ?? '') }}">
                </div>

                <!-- Berlaku Untuk -->
                <div>
                    <label for="applies_to" class="block text-sm font-medium text-gray-700 mb-1">Berlaku Untuk</label>
                    <select name="applies_to" id="applies_to" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="product" {{ old('applies_to', $discount->applies_to ?? '') == 'product' ? 'selected' : '' }}>Produk Tertentu</option>
                        <option value="category" {{ old('applies_to', $discount->applies_to ?? '') == 'category' ? 'selected' : '' }}>Kategori Produk</option>
                    </select>
                </div>

                <!-- Pilih Produk -->
                <div id="product_field" class="hidden">
                    <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Produk</label>
                    <select name="product_id" id="product_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 select2">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->product_id }}" {{ old('product_id', $discount->product_id ?? '') == $product->product_id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Kategori -->
                <div id="category_field" class="hidden">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kategori</label>
                    <select name="category_id" id="category_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 select2">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id', $discount->category_id ?? '') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Mulai -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           value="{{ old('start_date', $discount->start_date ?? '') }}">
                </div>

                <!-- Tanggal Berakhir -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                    <input type="date" name="end_date" id="end_date" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           value="{{ old('end_date', $discount->end_date ?? '') }}">
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-between">
                <a href="{{ route('discounts.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                    {{ isset($discount) ? 'Update Diskon' : 'Simpan Diskon' }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.select2').select2({
            theme: 'default',
            width: '100%'
        });

        const appliesToField = document.getElementById('applies_to');
        const productField = document.getElementById('product_field');
        const categoryField = document.getElementById('category_field');

        function toggleFields() {
            const appliesTo = appliesToField.value;
            productField.style.display = appliesTo === 'product' ? 'block' : 'none';
            categoryField.style.display = appliesTo === 'category' ? 'block' : 'none';
        }

        appliesToField.addEventListener('change', toggleFields);
        toggleFields();
    });
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
@endsection

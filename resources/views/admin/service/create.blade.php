@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Tambah Diskon</h3>
        </div>

        <!-- Body -->
        <div class="p-6">
            <x-flash-message />

            <form action="{{ route('discounts.store') }}" method="POST">
                @csrf

                <!-- Nama Diskon -->
                <div class="mb-6">
                    <label for="discount_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Diskon</label>
                    <input type="text" 
                           name="discount_name" 
                           id="discount_name" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200"
                           placeholder="Masukkan nama diskon" 
                           required>
                </div>

                <!-- Tipe Diskon -->
                <div class="mb-6">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Diskon</label>
                    <select name="type" 
                            id="type" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200"
                            required>
                        <option value="percentage">Persentase</option>
                        <option value="fixed">Nominal Tetap</option>
                    </select>
                </div>

                <!-- Nilai Diskon -->
                <div class="mb-6">
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-2">Nilai Diskon</label>
                    <input type="number" 
                           name="value" 
                           id="value" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200"
                           placeholder="Masukkan nilai diskon" 
                           required>
                </div>

                <!-- Berlaku Untuk -->
                <div class="mb-6">
                    <label for="applies_to" class="block text-sm font-medium text-gray-700 mb-2">Berlaku Untuk</label>
                    <select name="applies_to" 
                            id="applies_to" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200"
                            required>
                        <option value="product">Produk Tertentu</option>
                        <option value="category">Kategori Produk</option>
                    </select>
                </div>

                <!-- Date Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" 
                               name="start_date" 
                               id="start_date" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200"
                               required>
                    </div>

                    <!-- Tanggal Berakhir -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir</label>
                        <input type="date" 
                               name="end_date" 
                               id="end_date" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200"
                               required>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('discounts.index') }}" 
                       class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md transition duration-200">
                        Kembali
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

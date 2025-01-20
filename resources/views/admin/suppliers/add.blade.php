@extends('layouts.layout')

@section('title', 'Tambah Supplier')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-blue-500 px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-white">Tambah Supplier</h3>
                <a href="{{ route('suppliers.index') }}" class="text-white hover:text-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>

            <x-flash-message />

            <form action="{{ route('suppliers.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-6">
                    <!-- Outlet -->
                    <div class="space-y-2">
                        <label for="outlet_id" class="block text-sm font-medium text-gray-700">Outlet</label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" 
                               value="{{ $outletName ?? '' }}" 
                               readonly>
                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                    </div>

                    <!-- Operator -->
                    <div class="space-y-2">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Operator</label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" 
                               value="{{ $username ?? '' }}" 
                               readonly>
                        <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                    </div>

                    <!-- Nama Supplier -->
                    <div class="space-y-2">
                        <label for="supplier_name" class="block text-sm font-medium text-gray-700">Nama Supplier<span class="text-red-500">*</span></label>
                        <input type="text" 
                               class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 @error('supplier_name') border-red-500 @enderror" 
                               id="supplier_name" 
                               name="supplier_name" 
                               value="{{ old('supplier_name') }}" 
                               placeholder="Masukan nama supplier"
                               required>
                        @error('supplier_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kontak Info -->
                    <div class="space-y-2">
                        <label for="contact_info" class="block text-sm font-medium text-gray-700">Kontak Info</label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                               id="contact_info" 
                               name="contact_info" 
                               value="{{ old('contact_info') }}" 
                               placeholder="Masukan kontak info">
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                            id="address" 
                            name="address" 
                            rows="3"
                            placeholder="Masukan Alamat">{{ old('address') }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" 
                            onclick="window.location='{{ route('suppliers.index') }}'" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
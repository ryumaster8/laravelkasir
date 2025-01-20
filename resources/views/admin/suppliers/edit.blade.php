@extends('layouts.layout')

@section('title', 'Edit Supplier')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <!-- Card Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600">
                <h3 class="text-xl font-semibold text-white">Edit Supplier</h3>
            </div>

            <form action="{{ route('suppliers.update', $supplier->supplier_id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-flash-message />

                <!-- Card Body -->
                <div class="p-6 space-y-6">
                    <!-- Outlet -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Outlet</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50" value="{{ $outletName ?? '' }}" readonly>
                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                    </div>

                    <!-- Operator -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Operator</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50" value="{{ $username ?? '' }}" readonly>
                        <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                    </div>

                    <!-- Supplier Name -->
                    <div class="space-y-1">
                        <label for="supplier_name" class="text-sm font-medium text-gray-700">Nama Supplier</label>
                        <input type="text" id="supplier_name" name="supplier_name" value="{{ old('supplier_name', $supplier->supplier_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('supplier_name') border-red-500 @enderror" placeholder="Masukkan nama supplier">
                        @error('supplier_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-1">
                        <label for="contact_info" class="text-sm font-medium text-gray-700">Kontak</label>
                        <input type="text" id="contact_info" name="contact_info" value="{{ old('contact_info', $supplier->contact_info) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Masukkan informasi kontak">
                    </div>

                    <!-- Address -->
                    <div class="space-y-1">
                        <label for="address" class="text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="address" name="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Masukkan alamat lengkap">{{ old('address', $supplier->address) }}</textarea>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gray-50 flex items-center space-x-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Update Supplier
                    </button>
                    
                    <a href="{{ route('suppliers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
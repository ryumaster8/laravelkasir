@extends('layouts.layout')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Tambah Cabang Baru</h1>
        <p class="mt-1 text-sm text-gray-600">Lengkapi informasi untuk menambahkan cabang baru.</p>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form action="{{ route('branches.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <!-- Parent Outlet -->
            <div>
                <label for="parent_outlet_id" class="block text-sm font-medium text-gray-700">Induk Cabang</label>
                <div class="mt-1">
                    <input type="text" 
                           class="block w-full p-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500"
                           id="parent_outlet_id" 
                           value="{{ Auth()->user()->outlet->outlet_name }}" 
                           readonly>
                </div>
                <p class="mt-1 text-xs text-gray-500">Outlet induk tempat cabang ini akan terdaftar</p>
            </div>

            <!-- Branch Name -->
            <div>
                <label for="outlet_name" class="block text-sm font-medium text-gray-700">Nama Cabang</label>
                <div class="mt-1">
                    <input type="text" 
                           class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           id="outlet_name" 
                           name="outlet_name" 
                           placeholder="Masukkan nama cabang"
                           required>
                </div>
                @error('outlet_name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <div class="mt-1">
                    <textarea class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                              id="address" 
                              name="address" 
                              rows="3"
                              placeholder="Masukkan alamat lengkap cabang"
                              required></textarea>
                </div>
                @error('address')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact -->
            <div>
                <label for="contact_info" class="block text-sm font-medium text-gray-700">Kontak</label>
                <div class="mt-1">
                    <input type="text" 
                           class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           id="contact_info" 
                           name="contact_info" 
                           placeholder="Masukkan nomor telepon atau kontak"
                           required>
                </div>
                @error('contact_info')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('branches.index') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kembali
                </a>
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Cabang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
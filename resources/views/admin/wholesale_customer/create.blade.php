@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Input Data Pelanggan Grosir</h3>
        </div>

        <div class="p-6">
            <x-flash-message/>
            
            <form action="/wholesale-customer" method="POST">
                @csrf
                
                <!-- Operator -->
                <div class="mb-6">
                    <label for="operator_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Operator
                    </label>
                    <input type="text" 
                           class="block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           id="operator_id" 
                           value="{{ Auth::user()->username }}" 
                           readonly 
                           placeholder="Operator otomatis terisi">
                    <input type="hidden" name="operator_id" value="{{ Auth::user()->user_id }}">
                </div>

                <!-- Outlet -->
                <div class="mb-6">
                    <label for="customer_outlet_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Outlet
                    </label>
                    <input type="text" 
                           class="block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           id="customer_outlet_id" 
                           value="{{ Auth::user()->outlet->outlet_name }}" 
                           readonly 
                           placeholder="Outlet otomatis terisi">
                    <input type="hidden" name="customer_outlet_id" value="{{ Auth::user()->outlet->outlet_id }}">
                </div>

                <!-- Nama Pelanggan -->
                <div class="mb-6">
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Pelanggan
                    </label>
                    <input type="text" 
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           id="customer_name" 
                           name="customer_name" 
                           placeholder="Masukkan nama pelanggan">
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input type="email" 
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror" 
                           id="email" 
                           name="email" 
                           required 
                           placeholder="Masukkan email pelanggan">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-6">
                    <label for="contact_info" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor Telepon
                    </label>
                    <input type="text" 
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           id="contact_info" 
                           name="contact_info" 
                           placeholder="Masukkan nomor telepon pelanggan">
                </div>

                <!-- Alamat -->
                <div class="mb-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat
                    </label>
                    <textarea class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                              id="address" 
                              name="address" 
                              rows="3" 
                              placeholder="Masukkan alamat pelanggan"></textarea>
                </div>
            
                <!-- Buttons -->
                <div class="flex justify-start space-x-4 border-t border-gray-200 pt-6">
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan
                    </button>
                    <a href="/dashboard/wholesale-customer" 
                       class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
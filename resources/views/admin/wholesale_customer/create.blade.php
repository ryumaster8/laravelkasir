@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Input Data Pelanggan Grosir</h3>
        </div>

        <div class="p-6">
            @if(session('error'))
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('wholesale-customer.store') }}" method="POST">
                @csrf
                
                <!-- Operator & Outlet Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Operator</label>
                        <input type="text" 
                               class="block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md"
                               value="{{ Auth::user()->username }}" 
                               readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Outlet</label>
                        <input type="text" 
                               class="block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md"
                               value="{{ session('outlet_name') }}" 
                               readonly>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="space-y-6">
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Pelanggan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="customer_name"
                               name="customer_name"
                               value="{{ old('customer_name') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('customer_name') border-red-500 @enderror"
                               required>
                        @error('customer_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_info" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="contact_info"
                               name="contact_info"
                               value="{{ old('contact_info') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('contact_info') border-red-500 @enderror"
                               required>
                        @error('contact_info')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea id="address"
                                 name="address"
                                 rows="3"
                                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror"
                                 required>{{ old('address') }}</textarea>
                        @error('address')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 mt-6 pt-6 border-t">
                    <button type="submit" 
                            class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan
                    </button>
                    <a href="{{ route('wholesale-customer.index') }}" 
                       class="px-6 py-2.5 bg-gray-500 text-white font-medium rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
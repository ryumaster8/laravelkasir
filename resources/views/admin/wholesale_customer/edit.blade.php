@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-indigo-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Edit Data Pelanggan Grosir</h3>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                
                <form action="{{ route('wholesale-customer.update', $customer->wholesale_customer_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Operator Field -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="operator_id">
                            Operator
                        </label>
                        <input type="text" 
                               class="bg-gray-100 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                               value="{{ $customer->operator->username }}" 
                               readonly>
                        <input type="hidden" name="operator_id" value="{{ $customer->operator->user_id }}">
                    </div>

                    <!-- Outlet Field -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_outlet_id">
                            Outlet
                        </label>
                        <input type="text" 
                               class="bg-gray-100 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                               value="{{ $customer->outlet->outlet_name }}" 
                               readonly>
                        <input type="hidden" name="customer_outlet_id" value="{{ $customer->outlet->outlet_id }}">
                    </div>

                    <!-- Customer Name Field -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_name">
                            Nama Pelanggan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('customer_name') border-red-500 @enderror"
                               id="customer_name" 
                               name="customer_name"
                               value="{{ old('customer_name', $customer->customer_name) }}" 
                               required>
                        @error('customer_name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                               id="email" 
                               name="email"
                               value="{{ old('email', $customer->email) }}" 
                               required>
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Info Field -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="contact_info">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('contact_info') border-red-500 @enderror"
                               id="contact_info" 
                               name="contact_info"
                               value="{{ old('contact_info', $customer->contact_info) }}" 
                               required>
                        @error('contact_info')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address Field -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror"
                                  id="address" 
                                  name="address" 
                                  rows="3" 
                                  required>{{ old('address', $customer->address) }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('wholesale-customer.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.layout')

@section('title', 'Edit Produk')

@section('content')
@if(Auth::user()->role != 'Admin' && Auth::user()->role != 'Superadmin')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Akses Ditolak!</strong>
        <span class="block sm:inline">Halaman ini hanya dapat diakses oleh Admin dan Superadmin.</span>
    </div>
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
@else
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
        <p class="font-bold">Informasi Akses</p>
        <p>Halaman ini hanya dapat diakses oleh pengguna dengan role Admin dan Superadmin.</p>
    </div>

    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl md:max-w-2xl lg:max-w-4xl mx-auto">
            <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center space-x-5">
                        <div class="h-14 w-14 bg-blue-500 rounded-full flex flex-shrink-0 justify-center items-center text-white text-2xl font-mono">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </div>
                        <div class="block pl-2 font-semibold text-xl text-gray-700">
                            <h2 class="leading-relaxed">Edit Produk</h2>
                            <p class="text-sm text-gray-500 font-normal leading-relaxed">Silakan edit detail produk di bawah ini</p>
                        </div>
                    </div>

                    <form action="{{ route('self-products.update', $product->product_id) }}" method="POST" class="divide-y divide-gray-200">
                        @csrf
                        @method('PUT')

                        <div class="py-8 text-base leading-6 space-y-6 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="flex flex-col">
                                <label for="operator" class="text-sm font-bold text-gray-600 mb-1">Operator</label>
                                <input type="text" id="operator" name="operator" value="{{ $user->username }}" readonly
                                    class="px-3 py-2 bg-gray-100 border shadow-sm border-gray-300 rounded-md text-sm focus:outline-none">
                            </div>

                            <div class="flex flex-col">
                                <label for="outlet" class="text-sm font-bold text-gray-600 mb-1">Outlet</label>
                                <input type="text" id="outlet" name="outlet" value="{{ $user->outlet ? $user->outlet->outlet_name : '' }}" readonly
                                    class="px-3 py-2 bg-gray-100 border shadow-sm border-gray-300 rounded-md text-sm focus:outline-none">
                            </div>

                            <div class="flex flex-col">
                                <label for="product_name" class="text-sm font-bold text-gray-600 mb-1">Nama Produk</label>
                                <input type="text" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}"
                                    class="px-3 py-2 border shadow-sm border-gray-300 rounded-md text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('product_name') border-red-500 @enderror">
                                @error('product_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="brand" class="text-sm font-bold text-gray-600 mb-1">Merek</label>
                                <input type="text" id="brand" name="brand" value="{{ old('brand', $product->brand) }}"
                                    class="px-3 py-2 border shadow-sm border-gray-300 rounded-md text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('brand') border-red-500 @enderror">
                                @error('brand')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="category_id" class="text-sm font-bold text-gray-600 mb-1">Kategori</label>
                                <select id="category_id" name="category_id"
                                    class="px-3 py-2 border shadow-sm border-gray-300 rounded-md text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}" {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="supplier_id" class="text-sm font-bold text-gray-600 mb-1">Supplier</label>
                                <select id="supplier_id" name="supplier_id"
                                    class="px-3 py-2 border shadow-sm border-gray-300 rounded-md text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('supplier_id') border-red-500 @enderror">
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->supplier_id ? 'selected' : '' }}>
                                            {{ $supplier->supplier_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="pt-4 flex items-center space-x-4">
                            <button type="submit" class="flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none hover:bg-blue-600 bg-blue-500 transition duration-300">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Update
                            </button>
                            <a href="{{ route('self-products') }}" class="flex justify-center items-center w-full text-gray-700 px-4 py-3 rounded-md focus:outline-none hover:bg-gray-200 bg-gray-100 transition duration-300">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
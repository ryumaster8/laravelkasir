@extends('layouts.layout')

@section('title', 'Tambah Product')

@section('content')
<div class="flex justify-center mt-8 px-4">
    <div class="w-full max-w-4xl">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Tambah Product</h3>
            </div>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <x-flash-message />
                <div class="p-6 space-y-6">
                    <div>
                        <label for="outlet_id" class="block text-sm font-medium text-gray-700">Outlet</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ $outletName ?? '' }}" readonly>
                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                    </div>

                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Operator</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ $username ?? '' }}" readonly>
                        <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" id="category_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}"
                                    {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id" id="supplier_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('supplier_id') border-red-500 @enderror">
                            <option value="" selected disabled>-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->supplier_id }}"
                                    {{ old('supplier_id') == $supplier->supplier_id ? 'selected' : '' }}>
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="product_name" class="block text-sm font-medium text-gray-700">Nama Product</label>
                        <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('product_name') border-red-500 @enderror"
                               placeholder="Masukan nama product">
                        @error('product_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label for="product_code" class="block text-sm font-medium text-gray-700">Kode Product</label>
                        <input type="text" id="product_code" name="product_code" value="{{ old('product_code') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('product_code') border-red-500 @enderror"
                               placeholder="Masukan kode product">
                        @error('product_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700">Merk</label>
                        <input type="text" id="brand" name="brand" value="{{ old('brand') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('brand') border-red-500 @enderror"
                               placeholder="Masukan merk">
                        @error('brand')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="description" id="description" placeholder="Masukan deskripsi product">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="price_modal" class="block text-sm font-medium text-gray-700">Harga Modal</label>
                        <input type="number" id="price_modal" name="price_modal" value="{{ old('price_modal') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('price_modal') border-red-500 @enderror"
                               placeholder="Masukan harga modal">
                        @error('price_modal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price_grosir" class="block text-sm font-medium text-gray-700">Harga Grosir</label>
                        <input type="number" id="price_grosir" name="price_grosir" value="{{ old('price_grosir') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('price_grosir') border-red-500 @enderror"
                               placeholder="Masukan harga grosir">
                        @error('price_grosir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga Ecer</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                               placeholder="Masukan harga ecer">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('stock') border-red-500 @enderror"
                               placeholder="Masukan stok">
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700">Satuan</label>
                        <select name="unit" id="unit" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('unit') border-red-500 @enderror">
                            <option value="pcs" {{ old('unit') === 'pcs' ? 'selected' : '' }}>pcs</option>
                            <option value="dus" {{ old('unit') === 'dus' ? 'selected' : '' }}>dus</option>
                            <option value="kg" {{ old('unit') === 'kg' ? 'selected' : '' }}>kg</option>
                            <option value="bungkus" {{ old('unit') === 'bungkus' ? 'selected' : '' }}>bungkus</option>
                        </select>
                        @error('unit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="has_serial_number" class="block text-sm font-medium text-gray-700">Produk memiliki serial number?</label>
                        <select name="has_serial_number" id="has_serial_number" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="0" {{ old('has_serial_number') === '0' ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('has_serial_number') === '1' ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>

                    <div id="serial_number" class="hidden">
                        <label for="serial" class="block text-sm font-medium text-gray-700">Serial Number</label>
                        <div id="serial-inputs">
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex justify-start space-x-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Submit
                    </button>
                    <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#has_serial_number').change(function() {
            if ($(this).val() == '1') {
                $('#serial_number').removeClass('hidden');
            } else {
                $('#serial_number').addClass('hidden');
            }
        });

        $('#serial-inputs').on('keypress', 'input', function (e) {
            if (e.which == 13) {
                e.preventDefault();
                if($(this).val().trim()!=""){
                    $(this).parent().after('<div class="d-flex mt-2"><input type="text" class="form-control mr-2" name="serial[]" placeholder="Masukan Serial Number" /></div>');
                    $(this).parent().next().find('input').focus();
                }
                return false;
            }
        });
    });
</script>
@endpush
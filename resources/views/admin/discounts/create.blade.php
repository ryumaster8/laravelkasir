@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark text-left">Tambah Diskon</h3>
        </div>
        <div class="card-body">
            <x-flash-message />
            <form action="{{ route('discounts.store') }}" method="POST">
                @csrf

                <!-- Nama Diskon -->
                <div class="mb-3">
                    <label for="discount_name" class="form-label">Nama Diskon</label>
                    <input type="text" name="discount_name" id="discount_name" 
                           class="form-control" 
                           placeholder="Masukkan nama diskon" 
                           value="{{ old('discount_name') }}" 
                           required>
                </div>

                <!-- Tipe Diskon -->
                <div class="mb-3">
                    <label for="type" class="form-label">Tipe Diskon</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Persentase</option>
                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Nominal Tetap</option>
                    </select>
                </div>

                <!-- Nilai Diskon -->
                <div class="mb-3">
                    <label for="value" class="form-label">Nilai Diskon</label>
                    <input type="number" name="value" id="value" 
                           class="form-control" 
                           placeholder="Masukkan nilai diskon" 
                           value="{{ old('value') }}" 
                           required>
                </div>

                <!-- Berlaku Untuk -->
                <div class="mb-3">
                    <label for="applies_to" class="form-label">Berlaku Untuk</label>
                    <select name="applies_to" id="applies_to" class="form-control" required>
                        <option value="" {{ old('applies_to') == '' ? 'selected' : '' }}>-- Pilih --</option>
                        <option value="product" {{ old('applies_to') == 'product' ? 'selected' : '' }}>Produk Tertentu</option>
                        <option value="category" {{ old('applies_to') == 'category' ? 'selected' : '' }}>Kategori Produk</option>
                    </select>
                </div>

                <!-- Pilih Produk -->
                <div class="mb-3 {{ old('applies_to') == 'product' ? '' : 'd-none' }}" id="product_select">
                    <label for="product_id" class="form-label">Pilih Produk</label>
                    <select name="product_id" id="product_id" class="form-control select2">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->product_id }}" {{ old('product_id') == $product->product_id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Kategori -->
                <div class="mb-3 {{ old('applies_to') == 'category' ? '' : 'd-none' }}" id="category_select">
                    <label for="category_id" class="form-label">Pilih Kategori</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Mulai -->
                <div class="mb-3">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" 
                           class="form-control" 
                           value="{{ old('start_date') }}" 
                           required>
                </div>

                <!-- Tanggal Berakhir -->
                <div class="mb-3">
                    <label for="end_date" class="form-label">Tanggal Berakhir</label>
                    <input type="date" name="end_date" id="end_date" 
                           class="form-control" 
                           value="{{ old('end_date') }}" 
                           required>
                </div>

                <!-- Footer -->
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const appliesToSelect = document.getElementById('applies_to');
        const productSelect = document.getElementById('product_select');
        const categorySelect = document.getElementById('category_select');
        const productInput = document.getElementById('product_id');
        const categoryInput = document.getElementById('category_id');

        appliesToSelect.addEventListener('change', function () {
            const value = this.value;

            if (value === 'product') {
                productSelect.classList.remove('d-none');
                categorySelect.classList.add('d-none');
                categoryInput.value = 0; // Set kategori ke 0 jika tidak relevan
            } else if (value === 'category') {
                productSelect.classList.add('d-none');
                categorySelect.classList.remove('d-none');
                productInput.value = 0; // Set produk ke 0 jika tidak relevan
            }
        });

        // Inisialisasi awal berdasarkan nilai applies_to
        appliesToSelect.dispatchEvent(new Event('change'));
    });
</script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
@endsection

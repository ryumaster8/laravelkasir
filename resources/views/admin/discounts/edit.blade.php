@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h3 class="text-dark mb-4"><i class="fas fa-edit"></i> Edit Diskon</h3>

    <!-- Form Edit Diskon -->
    <form action="{{ route('discounts.update', $discount->discount_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Diskon -->
        <div class="mb-3">
            <label for="discount_name" class="form-label">Nama Diskon</label>
            <input type="text" class="form-control @error('discount_name') is-invalid @enderror" id="discount_name" name="discount_name" value="{{ old('discount_name', $discount->discount_name) }}" placeholder="Masukkan nama diskon">
            @error('discount_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tipe Diskon -->
        <div class="mb-3">
            <label for="type" class="form-label">Tipe Diskon</label>
            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                <option value="percentage" {{ old('type', $discount->type) === 'percentage' ? 'selected' : '' }}>Persentase</option>
                <option value="fixed" {{ old('type', $discount->type) === 'fixed' ? 'selected' : '' }}>Nominal Tetap</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nilai Diskon -->
        <div class="mb-3">
            <label for="value" class="form-label">Nilai Diskon</label>
            <input type="number" step="0.01" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $discount->value) }}" placeholder="Masukkan nilai diskon">
            @error('value')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Berlaku Untuk -->
        <div class="mb-3">
            <label for="applies_to" class="form-label">Berlaku Untuk</label>
            <select class="form-control @error('applies_to') is-invalid @enderror" id="applies_to" name="applies_to">
                <option value="product" {{ old('applies_to', $discount->applies_to) === 'product' ? 'selected' : '' }}>Produk Tertentu</option>
                <option value="category" {{ old('applies_to', $discount->applies_to) === 'category' ? 'selected' : '' }}>Kategori Produk</option>
            </select>
            @error('applies_to')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilih Produk -->
        <div class="mb-3 applies-to-product {{ old('applies_to', $discount->applies_to) === 'product' ? '' : 'd-none' }}">
            <label for="product_id" class="form-label">Pilih Produk</label>
            <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id">
                <option value="">Pilih Produk</option>
                @foreach ($products as $product)
                    <option value="{{ $product->product_id }}" {{ old('product_id', $discount->product_id) == $product->product_id ? 'selected' : '' }}>
                        {{ $product->product_name }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilih Kategori -->
        <div class="mb-3 applies-to-category {{ old('applies_to', $discount->applies_to) === 'category' ? '' : 'd-none' }}">
            <label for="category_id" class="form-label">Pilih Kategori</label>
            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}" {{ old('category_id', $discount->category_id) == $category->category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal Mulai -->
        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $discount->start_date) }}">
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal Berakhir -->
        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Berakhir</label>
            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $discount->end_date) }}">
            @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="text-end">
            <a href="{{ route('discounts.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.layout')

@section('title', 'Pindah Stok Produk')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Pindah Stok Produk
            </div>
            <div class="card-body">
                <x-flash-message />
                <form action="{{ route('self-products.store-transfer-stock', $product->product_id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Produk ID</label>
                        <input type="text" class="form-control" id="product_id" name="product_id" value="{{ $product->product_id }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="operator" class="form-label">Operator</label>
                        <input type="text" class="form-control" id="operator" name="operator" value="{{ $user->username }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="outlet" class="form-label">Outlet Asal</label>
                        <input type="text" class="form-control" id="outlet" name="outlet" value="{{ $user->outlet ? $user->outlet->outlet_name : '' }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="to_outlet_id" class="form-label">Pindahkan Ke Outlet</label>
                       <select class="form-select @error('to_outlet_id') is-invalid @enderror" id="to_outlet_id" name="to_outlet_id">
                            <option value="">-- Pilih Outlet --</option>
                             @foreach ($outlets as $outlet)
                                   <option value="{{ $outlet->outlet_id }}" {{ old('to_outlet_id') == $outlet->outlet_id ? 'selected' : '' }}>{{ $outlet->outlet_name }}</option>
                            @endforeach
                       </select>
                        @error('to_outlet_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                   </div>

                    <div class="mb-3">
                       <label for="quantity" class="form-label">Jumlah Stok yang Dipindahkan</label>
                       <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" max="{{ $productStock->stock ?? 0 }}" step="1">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                       @enderror
                       <small>Sisa Stok : {{ $productStock->stock ?? 0 }}</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Pindah Stok</button>
                   <a href="{{ route('self-products') }}" class="btn btn-secondary">Cancel</a>
                </form>
           </div>
        </div>
    </div>
@endsection
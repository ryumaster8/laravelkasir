@extends('layouts.layout')

@section('title', 'Kurangi Stok Produk')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
             <h3 class="text-dark">{{ $product->product_name }}</h3>
        </div>
        <div class="card-body">
            <x-flash-message />
           <form action="{{ route('self-products.store-reduce-stock', $product->product_id) }}" method="POST">
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
                        <label for="outlet" class="form-label">Outlet</label>
                        <input type="text" class="form-control" id="outlet" name="outlet" value="{{ $user->outlet ? $user->outlet->outlet_name : '' }}" readonly>
                   </div>

                   <div class="mb-3">
                        <label for="product_name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" readonly>
                    </div>
                   <div class="mb-3">
                        <label for="brand" class="form-label">Merek</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="{{ $product->brand }}" readonly>
                   </div>
                    <div class="mb-3">
                        <label for="product_code" class="form-label">Barcode</label>
                       <input type="text" class="form-control" id="product_code" name="product_code" value="{{ $product->product_code }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok Saat Ini</label>
                         <input type="number" class="form-control" id="stock" name="stock" value="{{ $productStock->stock ?? 0 }}" readonly>
                    </div>

                     <div class="mb-3">
                          <label for="quantity" class="form-label">Jumlah Stok yang Dikurangi</label>
                         <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" max="{{ $productStock->stock ?? 0 }}" step="1">
                         @error('quantity')
                               <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                          <small>Sisa Stok : {{ $productStock->stock ?? 0 }}</small>
                     </div>

                    <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Kurangi Stok</button>
                    <a href="{{ route('self-products') }}" class="btn btn-secondary">Cancel</a>
               </div>
            </form>
         </div>
    </div>
</div>
@endsection
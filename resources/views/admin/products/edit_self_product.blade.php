@extends('layouts.layout')

@section('title', 'Edit Produk')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Produk
            </div>
            <div class="card-body">
                <form action="{{ route('self-products.update', $product->product_id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" >
                        @error('product_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>

                       <div class="mb-3">
                            <label for="brand" class="form-label">Merek</label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand', $product->brand) }}">
                            @error('brand')
                               <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                         <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                            <option value="">-- Pilih Kategori --</option>
                             @foreach ($categories as $category)
                                   <option value="{{ $category->category_id }}" {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                            @endforeach
                      </select>
                        @error('category_id')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                   </div>

                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select class="form-select @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id">
                            <option value="">-- Pilih Supplier --</option>
                             @foreach ($suppliers as $supplier)
                                  <option value="{{ $supplier->supplier_id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->supplier_id ? 'selected' : '' }}>{{ $supplier->supplier_name }}</option>
                          @endforeach
                       </select>
                        @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                   </div>

                </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('self-products') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
        </div>
    </div>
@endsection
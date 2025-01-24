@extends('layouts.layout')

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

    <div class="container">
         @include('components.flash-message')
        <div class="card">
            <div class="card-header">
                <h3 class="text-dark">Edit Izin Pengguna</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user-permissions.update', $userPermission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                     <div class="mb-3">
                        <label for="outlet_id" class="form-label">Outlet (Opsional)</label>
                        <select class="form-select" name="outlet_id" id="outlet_id">
                            <option value="">Pilih Outlet</option>
                            @foreach($outlets as $outlet)
                                 <option value="{{ $outlet->id }}" {{ $userPermission->outlet_id == $outlet->id ? 'selected' : '' }}>{{ $outlet->outlet_name }}</option>
                            @endforeach
                        </select>
                        @error('outlet_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                         <select class="form-select" name="role" id="role" required>
                            <option value="">Pilih Role</option>
                            <option value="User" {{ $userPermission->role == 'User' ? 'selected' : ''}}>User</option>
                            <option value="Admin"  {{ $userPermission->role == 'Admin' ? 'selected' : ''}}>Admin</option>
                            {{-- Removed Superadmin option from dropdown --}}
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-end mb-2">
                              <button type="button" class="btn btn-sm btn-success me-2" id="checkAll">BISA UNTUK SEMUA</button>
                            <button type="button" class="btn btn-sm btn-danger" id="uncheckAll">TIDAK BISA UNTUK SEMUA</button>
                         </div>
                         <label class="form-label">Izin</label>
                       <div class="row">
                            <div class="col-md-3">
                               <h6 class="fw-bold text-primary">Supplier</h6>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_add_supplier" id="can_add_supplier" value="1"  {{ $userPermission->can_add_supplier ? 'checked' : '' }}>
                                    <label for="can_add_supplier" class="form-check-label">Bisa Tambah Supplier</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_edit_supplier" id="can_edit_supplier" value="1"  {{ $userPermission->can_edit_supplier ? 'checked' : '' }}>
                                    <label for="can_edit_supplier" class="form-check-label">Bisa Edit Supplier</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_delete_supplier" id="can_delete_supplier" value="1"  {{ $userPermission->can_delete_supplier ? 'checked' : '' }}>
                                    <label for="can_delete_supplier" class="form-check-label">Bisa Hapus Supplier</label>
                                </div>

                                 <h6 class="fw-bold text-success mt-3">Kategori</h6>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_add_category" id="can_add_category" value="1"  {{ $userPermission->can_add_category ? 'checked' : '' }}>
                                    <label for="can_add_category" class="form-check-label">Bisa Tambah Kategori</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_edit_category" id="can_edit_category" value="1"  {{ $userPermission->can_edit_category ? 'checked' : '' }}>
                                    <label for="can_edit_category" class="form-check-label">Bisa Edit Kategori</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_delete_category" id="can_delete_category" value="1"  {{ $userPermission->can_delete_category ? 'checked' : '' }}>
                                    <label for="can_delete_category" class="form-check-label">Bisa Hapus Kategori</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h6 class="fw-bold text-info">Produk</h6>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_add_product" id="can_add_product" value="1"  {{ $userPermission->can_add_product ? 'checked' : '' }}>
                                    <label for="can_add_product" class="form-check-label">Bisa Tambah Produk</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_edit_product" id="can_edit_product" value="1"  {{ $userPermission->can_edit_product ? 'checked' : '' }}>
                                    <label for="can_edit_product" class="form-check-label">Bisa Edit Produk</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_delete_product" id="can_delete_product" value="1"  {{ $userPermission->can_delete_product ? 'checked' : '' }}>
                                    <label for="can_delete_product" class="form-check-label">Bisa Hapus Produk</label>
                                </div>

                                <h6 class="fw-bold text-warning mt-3">Pengguna</h6>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_add_user" id="can_add_user" value="1"  {{ $userPermission->can_add_user ? 'checked' : '' }}>
                                    <label for="can_add_user" class="form-check-label">Bisa Tambah Pengguna</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_edit_user" id="can_edit_user" value="1"  {{ $userPermission->can_edit_user ? 'checked' : '' }}>
                                    <label for="can_edit_user" class="form-check-label">Bisa Edit Pengguna</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_delete_user" id="can_delete_user" value="1"  {{ $userPermission->can_delete_user ? 'checked' : '' }}>
                                    <label for="can_delete_user" class="form-check-label">Bisa Hapus Pengguna</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                               <h6 class="fw-bold text-danger">Lokasi Produk</h6>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_add_product_location" id="can_add_product_location" value="1"  {{ $userPermission->can_add_product_location ? 'checked' : '' }}>
                                    <label for="can_add_product_location" class="form-check-label">Bisa Tambah Lokasi Produk</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_edit_product_location" id="can_edit_product_location" value="1"  {{ $userPermission->can_edit_product_location ? 'checked' : '' }}>
                                    <label for="can_edit_product_location" class="form-check-label">Bisa Edit Lokasi Produk</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_delete_product_location" id="can_delete_product_location" value="1"  {{ $userPermission->can_delete_product_location ? 'checked' : '' }}>
                                    <label for="can_delete_product_location" class="form-check-label">Bisa Hapus Lokasi Produk</label>
                                </div>

                               <h6 class="fw-bold text-secondary mt-3">Harga</h6>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_see_cost_price" id="can_see_cost_price" value="1"  {{ $userPermission->can_see_cost_price ? 'checked' : '' }}>
                                    <label for="can_see_cost_price" class="form-check-label">Bisa Lihat Harga Modal</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_see_sale_price" id="can_see_sale_price" value="1"  {{ $userPermission->can_see_sale_price ? 'checked' : '' }}>
                                    <label for="can_see_sale_price" class="form-check-label">Bisa Lihat Harga Jual</label>
                                </div>
                            </div>
                           <div class="col-md-3">
                                <h6 class="fw-bold text-dark">Lihat Data</h6>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_see_supplier" id="can_see_supplier" value="1" {{ $userPermission->can_see_supplier ? 'checked' : '' }}>
                                    <label for="can_see_supplier" class="form-check-label">Bisa Lihat Supplier</label>
                                </div>
                                 <div class="form-check">
                                      <input type="checkbox" class="form-check-input" name="can_see_category" id="can_see_category" value="1" {{ $userPermission->can_see_category ? 'checked' : '' }}>
                                    <label for="can_see_category" class="form-check-label">Bisa Lihat Kategori</label>
                                </div>
                                 <div class="form-check">
                                       <input type="checkbox" class="form-check-input" name="can_see_operator" id="can_see_operator" value="1"  {{ $userPermission->can_see_operator ? 'checked' : '' }}>
                                    <label for="can_see_operator" class="form-check-label">Bisa Lihat Operator</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_see_outlet" id="can_see_outlet" value="1"  {{ $userPermission->can_see_outlet ? 'checked' : '' }}>
                                    <label for="can_see_outlet" class="form-check-label">Bisa Lihat Outlet</label>
                                </div>
                                 <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="can_see_stock" id="can_see_stock" value="1"  {{ $userPermission->can_see_stock ? 'checked' : '' }}>
                                    <label for="can_see_stock" class="form-check-label">Bisa Lihat Stok</label>
                                </div>
                                 <div class="form-check">
                                     <input type="checkbox" class="form-check-input" name="can_see_brand" id="can_see_brand" value="1"  {{ $userPermission->can_see_brand ? 'checked' : '' }}>
                                    <label for="can_see_brand" class="form-check-label">Bisa Lihat Brand</label>
                                </div>
                                  <div class="form-check">
                                       <input type="checkbox" class="form-check-input" name="can_see_product_location" id="can_see_product_location" value="1" {{ $userPermission->can_see_product_location ? 'checked' : '' }}>
                                    <label for="can_see_product_location" class="form-check-label">Bisa Lihat Lokasi Produk</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="can_see_barcode" id="can_see_barcode" value="1"  {{ $userPermission->can_see_barcode ? 'checked' : '' }}>
                                    <label for="can_see_barcode" class="form-check-label">Bisa Lihat Barcode</label>
                                </div>
                                <div class="form-check">
                                     <input type="checkbox" class="form-check-input" name="can_see_unit_barcode" id="can_see_unit_barcode" value="1" {{ $userPermission->can_see_unit_barcode ? 'checked' : '' }}>
                                    <label for="can_see_unit_barcode" class="form-check-label">Bisa Lihat Barcode Unit</label>
                               </div>
                                <div class="form-check">
                                   <input type="checkbox" class="form-check-input" name="can_see_product_id" id="can_see_product_id" value="1" {{ $userPermission->can_see_product_id ? 'checked' : '' }}>
                                    <label for="can_see_product_id" class="form-check-label">Bisa Lihat ID Produk</label>
                               </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                   <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
@endif
@endsection
@push('scripts')
<script>
     document.getElementById('checkAll').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    });

    document.getElementById('uncheckAll').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    });
</script>
@endpush
@extends('layouts.layout')

@section('content')
<div class="container">
    @include('components.flash-message')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-dark">Daftar Izin Pengguna</h3>
        <a href="{{ route('user-permissions.create') }}" class="btn btn-primary">Tambah Izin Pengguna</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Outlet ID</th>
                    <th>Outlet Name</th>
                    <th>Role</th>
                    <th>Tambah Supplier</th>
                    <th>Edit Supplier</th>
                    <th>Hapus Supplier</th>
                    <th>Tambah Kategori</th>
                    <th>Edit Kategori</th>
                    <th>Hapus Kategori</th>
                    <th>Tambah Produk</th>
                    <th>Edit Produk</th>
                    <th>Hapus Produk</th>
                    <th>Tambah Pengguna</th>
                    <th>Edit Pengguna</th>
                    <th>Hapus Pengguna</th>
                    <th>Tambah Lokasi Produk</th>
                    <th>Edit Lokasi Produk</th>
                    <th>Hapus Lokasi Produk</th>
                    <th>Lihat Harga Modal</th>
                    <th>Lihat Harga Jual</th>
                    <th>Lihat Supplier</th>
                    <th>Lihat Kategori</th>
                    <th>Lihat Operator</th>
                    <th>Lihat Outlet</th>
                    <th>Lihat Stok</th>
                    <th>Lihat Brand</th>
                    <th>Lihat Lokasi Produk</th>
                    <th>Lihat Barcode</th>
                    <th>Lihat Barcode Unit</th>
                    <th>Lihat Product ID</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->user_permission_id }}</td>
                        <td>{{ $permission->user_id }}</td>
                        <td>{{ $permission->user->username ?? 'Tidak Ada' }}</td>
                        <td>{{ $permission->outlet_id }}</td>
                        <td>{{ $permission->outlet->outlet_name ?? 'Tidak Ada' }}</td>
                        <td>{{ $permission->role }}</td>
                        <td>{{ $permission->can_add_supplier ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_edit_supplier ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_delete_supplier ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_add_category ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_edit_category ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_delete_category ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_add_product ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_edit_product ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_delete_product ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_add_user ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_edit_user ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_delete_user ? 'Ya' : 'Tidak' }}</td>
                         <td>{{ $permission->can_add_product_location ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_edit_product_location ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_delete_product_location ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_see_cost_price ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_see_sale_price ? 'Ya' : 'Tidak' }}</td>
                         <td>{{ $permission->can_see_supplier ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_see_category ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_see_operator ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_see_outlet ? 'Ya' : 'Tidak' }}</td>
                         <td>{{ $permission->can_see_stock ? 'Ya' : 'Tidak' }}</td>
                         <td>{{ $permission->can_see_brand ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_see_product_location ? 'Ya' : 'Tidak' }}</td>
                         <td>{{ $permission->can_see_barcode ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $permission->can_see_unit_barcode ? 'Ya' : 'Tidak' }}</td>
                         <td>{{ $permission->can_see_product_id ? 'Ya' : 'Tidak' }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ url('/settings/user-permissions/' . $permission->user_permission_id . '/edit') }}" class="btn btn-sm btn-primary me-1">Edit</a>
                                <form action="{{ route('user-permissions.destroy', $permission->user_permission_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger me-1" onclick="return confirm('Apakah Anda yakin ingin menghapus izin pengguna ini?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="34" class="text-center">Tidak ada data izin pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
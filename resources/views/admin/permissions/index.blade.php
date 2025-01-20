@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Daftar Pengaturan Akses Pengguna</h1>
        <x-flash-message />
        <a href="{{ route('user-permissions.create') }}" class="btn btn-primary mb-3">Tambah Pengaturan Akses Pengguna</a>

        <table id="userPermissionsTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Operator Username</th>
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
                @foreach($userPermissions as $key => $permission)
                <tr>
                    <td>{{ $key + 1}}</td>
                     <td>{{ $permission->operator ? $permission->operator->username : '-' }}</td>
                     <td>{{ $permission->outlet ? $permission->outlet->outlet_name : '-' }}</td>
                     <td>{{ $permission->role ? $permission->role->role_name : '-' }}</td>
                    <td>{{ $permission->can_add_supplier ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_edit_supplier ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_delete_supplier ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_add_category ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_edit_category ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_delete_category ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_add_product ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_edit_product ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_delete_product ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_add_user ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_edit_user ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_delete_user ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_add_product_location ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_edit_product_location ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_delete_product_location ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_see_cost_price ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_see_sale_price ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_see_supplier ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_see_category ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_see_operator ? 'Ya' : 'Tidak'}}</td>
                     <td>{{ $permission->can_see_outlet ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_see_stock ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_see_brand ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_see_product_location ? 'Ya' : 'Tidak'}}</td>
                    <td>{{ $permission->can_see_barcode ? 'Ya' : 'Tidak'}}</td>
                     <td>{{ $permission->can_see_unit_barcode ? 'Ya' : 'Tidak'}}</td>
                     <td>{{ $permission->can_see_product_id ? 'Ya' : 'Tidak'}}</td>
                    <td>
                    <div class="btn-group" role="group">
                         <a href="{{ route('user-permissions.edit', $permission->user_permission_id) }}" class="btn btn-sm btn-info">Edit</a>
                          <form action="{{ route('user-permissions.destroy', $permission->user_permission_id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                             <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaturan akses untuk User: {{ $permission->operator ? $permission->operator->username : '-' }} dengan Role: {{ $permission->role ? $permission->role->role_name : '-' }} dan Outlet: {{ $permission->outlet ? $permission->outlet->outlet_name : '-' }}?')">Delete</button>
                        </form>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#userPermissionsTable').DataTable();
        });
    </script>
@endsection
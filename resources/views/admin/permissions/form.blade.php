@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-800">
                {{ isset($userPermission) ? 'Edit' : 'Tambah' }} Pengaturan Akses Pengguna
            </h3>
        </div>
        <div class="p-6">
            <x-flash-message />
            <form action="{{ isset($userPermission) ? route('user-permissions.update', $userPermission->user_permission_id) : route('user-permissions.store') }}" method="POST">
                @csrf
                @if(isset($userPermission))
                    @method('PUT')
                @endif

                <!-- Operator Field -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Operator</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ Auth::user()->username }}" readonly>
                </div>

                <!-- Role Selection -->
                <div class="mb-4">
                    <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select name="role_id" id="role_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                            @if($role->role_name !== 'owner' && $role->role_name !== 'superadmin')
                                <option value="{{$role->role_id}}" {{ old('role_id', isset($userPermission) ? $userPermission->role_id : '') == $role->role_id ? 'selected' : '' }}>
                                    {{$role->role_name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Outlet Selection -->
                <div class="mb-4">
                    <label for="outlet_id" class="block text-sm font-medium text-gray-700 mb-2">Outlet</label>
                    <select name="outlet_id" id="outlet_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Outlet</option>
                        @foreach($outlets as $outlet)
                            <option value="{{$outlet->outlet_id}}" {{ old('outlet_id', isset($userPermission) ? $userPermission->outlet_id : '') == $outlet->outlet_id ? 'selected' : '' }}>
                                {{$outlet->outlet_name}} ({{ $outlet->status == 'induk' ? 'induk' : 'cabang' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Permission Controls -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <!-- Quick Actions -->
                        <div class="flex space-x-4 justify-center mb-6">
                            <button type="button" class="select-all-permissions px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors text-sm">
                                BISA UNTUK SEMUA
                            </button>
                            <button type="button" class="unselect-all-permissions px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors text-sm">
                                TIDAK BISA UNTUK SEMUA
                            </button>
                        </div>

                        <!-- Permission Groups -->
                        @foreach(['supplier' => 'Supplier', 'product' => 'Produk', 'category' => 'Kategori'] as $key => $title)
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h5 class="font-medium text-gray-900 mb-4">Kelompok {{ $title }}</h5>
                                <div class="space-y-3">
                                    @foreach(['add', 'edit', 'delete'] as $action)
                                        <div class="flex items-center">
                                            <label class="flex items-center space-x-3">
                                                <span class="text-sm text-gray-700">Bisa {{ ucfirst($action) }} {{ $title }}?</span>
                                                <select name="can_{{ $action }}_{{ $key }}" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="0" {{ old("can_{$action}_{$key}", isset($userPermission) ? $userPermission->{"can_{$action}_{$key}"} : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                    <option value="1" {{ old("can_{$action}_{$key}", isset($userPermission) ? $userPermission->{"can_{$action}_{$key}"} : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                </select>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <!-- New Wholesale Customer Permission Group -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-4">Kelompok Pelanggan Grosir</h5>
                            <div class="space-y-3">
                                @foreach(['add' => 'Tambah', 'edit' => 'Edit', 'delete' => 'Hapus'] as $action => $title)
                                    <div class="flex items-center">
                                        <label class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-700">Bisa {{ $title }} Pelanggan Grosir?</span>
                                            <select name="can_{{ $action }}_wholesale_customer" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="0" {{ old("can_{$action}_wholesale_customer", isset($userPermission) ? $userPermission->{"can_{$action}_wholesale_customer"} : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old("can_{$action}_wholesale_customer", isset($userPermission) ? $userPermission->{"can_{$action}_wholesale_customer"} : '') == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <!-- Continue with other permission groups similarly -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-4">Kelompok Tabel Produk</h5>
                            <div class="space-y-3">
                                @foreach(['product_id' => 'ID Produk', 'cost_price' => 'Harga Modal', 'sale_price' => 'Harga Jual', 'brand' => 'Merek Produk', 'stock' => 'Stok Produk', 'barcode' => 'Barcode Produk', 'unit_barcode' => 'Unit Barcode', 'supplier' => 'Supplier', 'category' => 'Kategori Produk', 'product_location' => 'Lokasi Produk', 'operator' => 'Operator', 'outlet' => 'Outlet'] as $key => $title)
                                    <div class="flex items-center">
                                        <label class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-700">Bisa Lihat {{ $title }}?</span>
                                            <select name="can_see_{{ $key }}" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="0" {{ old("can_see_{$key}", isset($userPermission) ? $userPermission->{"can_see_{$key}"} : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old("can_see_{$key}", isset($userPermission) ? $userPermission->{"can_see_{$key}"} : '') == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-4">Kelompok Lokasi Produk</h5>
                            <div class="space-y-3">
                                @foreach(['add' => 'Tambah', 'edit' => 'Edit', 'delete' => 'Hapus'] as $action => $title)
                                    <div class="flex items-center">
                                        <label class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-700">Bisa {{ $title }} Lokasi Produk?</span>
                                            <select name="can_{{ $action }}_product_location" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="0" {{ old("can_{$action}_product_location", isset($userPermission) ? $userPermission->{"can_{$action}_product_location"} : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old("can_{$action}_product_location", isset($userPermission) ? $userPermission->{"can_{$action}_product_location"} : '') == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-4">Kelompok Pengguna</h5>
                            <div class="space-y-3">
                                @foreach(['add' => 'Tambah', 'edit' => 'Edit', 'delete' => 'Hapus'] as $action => $title)
                                    <div class="flex items-center">
                                        <label class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-700">Bisa {{ $title }} Pengguna?</span>
                                            <select name="can_{{ $action }}_user" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="0" {{ old("can_{$action}_user", isset($userPermission) ? $userPermission->{"can_{$action}_user"} : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old("can_{$action}_user", isset($userPermission) ? $userPermission->{"can_{$action}_user"} : '') == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-6 flex justify-between border-t border-gray-200 pt-6">
                    <a href="{{ route('user-permissions.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                        Kembali
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>

            <!-- Guide Card -->
            <div class="mt-8 bg-white rounded-lg shadow-md">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h5 class="font-medium text-gray-900">Panduan Penggunaan Fitur Pengaturan Akses Pengguna</h5>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">Fitur Pengaturan Akses Pengguna ini digunakan untuk mengatur hak akses dari setiap pengguna berdasarkan role yang diberikan. Fitur ini dapat mempermudah administrator untuk membatasi akses setiap user.</p>
                    <h6 class="font-medium text-gray-900 mb-2">Cara Menggunakan</h6>
                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                        <li>Pilih Role yang akan diatur hak aksesnya pada input <span class="font-semibold">Role</span></li>
                        <li>Pilih Outlet yang akan diatur hak aksesnya, jika tidak ada dapat dikosongkan</li>
                        <li>Pilih atau atur checkbox untuk hak akses yang dibutuhkan pada setiap kelompok</li>
                        <li>Klik tombol <span class="font-semibold">BISA UNTUK SEMUA</span> untuk memberikan semua hak akses</li>
                        <li>Klik tombol <span class="font-semibold">TIDAK BISA UNTUK SEMUA</span> untuk menghilangkan semua hak akses</li>
                        <li>Setelah selesai mengatur hak akses klik tombol <span class="font-semibold">Simpan</span></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('.select-all-permissions').click(function () {
            $('.permission-select').val('1').trigger('change');
        });
        $('.unselect-all-permissions').click(function () {
            $('.permission-select').val('0').trigger('change');
        });
    });
</script>
@endpush

@endsection
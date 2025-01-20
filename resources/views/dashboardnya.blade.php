@extends('layouts.layout')

@section('title', 'Dashboard')

@section('dashboard-header')
    <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
    <p>Selamat datang di dashboard aplikasi.</p>
@endsection

<!-- Content -->
        <main class="flex-1 transition-all duration-300">
            <div class="content-wrapper">
                <!-- Header dengan judul -->
                <div class="header-content">
                    <h2 class="text-2xl font-bold text-gray-800">Data Pengguna</h2>
                </div>

                <!-- Card content -->
                <div class="card-content bg-white">
                    <div class="p-6 border-b">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg flex items-center gap-2 text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Data
                        </button>
                    </div>
                    
                    <div class="p-6">
                        <table id="dataTable" class="w-full text-base">
                            <thead class="text-xs text-white uppercase bg-blue-600">
                                <tr>
                                    <th class="px-6 py-4">No</th>
                                    <th class="px-6 py-4">ID</th>
                                    <th class="px-6 py-4">Nama</th>
                                    <th class="px-6 py-4">Email</th>
                                    <th class="px-6 py-4">Kota</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <!-- Data akan diisi oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Form Input -->
                    <div class="p-6 bg-white border-t">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Input Data Pengguna</h3>
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama -->
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                                    <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Kota dengan Select2 -->
                                <div>
                                    <label for="kota" class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                                    <select id="kota" name="kota" class="select2 w-full">
                                        <option value="">Pilih Kota</option>
                                        <option value="Jakarta">Jakarta</option>
                                        <option value="Surabaya">Surabaya</option>
                                        <option value="Bandung">Bandung</option>
                                        <option value="Medan">Medan</option>
                                        <option value="Semarang">Semarang</option>
                                        <option value="Yogyakarta">Yogyakarta</option>
                                        <option value="Malang">Malang</option>
                                        <option value="Palembang">Palembang</option>
                                        <option value="Makassar">Makassar</option>
                                        <option value="Denpasar">Denpasar</option>
                                    </select>
                                </div>

                                <!-- Status dengan Select2 -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select id="status" name="status" class="select2 w-full">
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                    </select>
                                </div>

                                <!-- Role dengan Select2 Multiple -->
                                <div class="md:col-span-2">
                                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                    <select id="role" name="role[]" class="select2-multiple w-full" multiple="multiple">
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="staff">Staff</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="operator">Operator</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

@section('content')
  
    <script>
    
    console.log('JavaScript dari dashboard')
    </script>

    
@endsection
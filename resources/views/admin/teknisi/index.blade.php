@extends('layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <x-flash-message />
        <h3 class="text-2xl font-bold mb-6">Daftar Teknisi</h3>

        <div class="mb-6 space-x-4">
            <a href="{{ route('teknisi.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Tambah Teknisi</a>
            @if(optional(auth()->user())->role->role_name === 'superadmin')
                <a href="{{ route('teknisi.semua') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Lihat Semua Teknisi</a>
            @endif
        </div>

        <div class="overflow-x-auto shadow-md rounded-lg">
            <table id="teknisiTable" class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Teknisi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($teknisi->isEmpty())
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data teknisi.
                            </td>
                        </tr>
                    @else
                        @foreach ($teknisi as $key => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $key + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->operator->username ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->outlet->outlet_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_teknisi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->kontak }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <a href="{{ route('teknisi.edit', $item->teknisi_id) }}" 
                                       class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                                        Edit
                                    </a>
                                    <form action="{{ route('teknisi.destroy', $item->teknisi_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm rounded-md hover:bg-red-700"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data teknisi {{ $item->nama_teknisi }}?')">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('teknisi.pindahcabang', $item->teknisi_id) }}" 
                                       class="inline-flex items-center px-3 py-1 bg-cyan-600 text-white text-sm rounded-md hover:bg-cyan-700">
                                        Pindah Cabang
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-8 shadow-lg">
            <div class="flex items-center gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h4 class="text-xl font-bold text-gray-800">Panduan Penggunaan Halaman Data Teknisi</h4>
            </div>

            <div class="space-y-6">
                <!-- Informasi Umum -->
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <p class="text-gray-700">Halaman ini menampilkan daftar teknisi yang terdaftar dalam sistem.</p>
                </div>

                <!-- Panduan Kolom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <h5 class="font-semibold text-gray-800 mb-3">Informasi Kolom Tabel</h5>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                <span class="font-medium">No:</span> Nomor urut teknisi
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                <span class="font-medium">Operator:</span> Nama operator terkait
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                <span class="font-medium">Outlet:</span> Lokasi outlet teknisi
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                <span class="font-medium">Nama Teknisi:</span> Nama lengkap teknisi
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                <span class="font-medium">Kontak:</span> Informasi kontak teknisi
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                <span class="font-medium">Status:</span> Status aktif teknisi
                            </li>
                        </ul>
                    </div>

                    <!-- Panduan Aksi -->
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <h5 class="font-semibold text-gray-800 mb-3">Panduan Tombol Aksi</h5>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3">
                                <span class="px-3 py-1 bg-blue-600 text-white text-sm rounded">Edit</span>
                                <span class="text-gray-600">Mengubah data teknisi</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="px-3 py-1 bg-red-600 text-white text-sm rounded">Delete</span>
                                <span class="text-gray-600">Menghapus data teknisi</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="px-3 py-1 bg-cyan-600 text-white text-sm rounded">Pindah Cabang</span>
                                <span class="text-gray-600">Memindahkan teknisi ke cabang lain</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Panduan Tambahan -->
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <h5 class="font-semibold text-gray-800 mb-3">Fitur Tambahan</h5>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tombol "Tambah Teknisi" untuk menambah data teknisi baru
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Tombol "Lihat Semua Teknisi" (khusus Super Admin) untuk melihat data teknisi secara keseluruhan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#teknisiTable').DataTable();
        } );
    </script>
@endsection
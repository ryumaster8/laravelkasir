@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-flash-message />

        <!-- Action Button -->
        <div class="mb-6">
            @if(auth()->user()->role->role_name === 'owner' || auth()->user()->role->role_name === 'admin')
            <a href="{{ route('user.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Pengguna
            </a>
            @endif
        </div>

        <!-- Table Section -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table id="userTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Dibuat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users->where('outlet_id', auth()->user()->outlet_id) as $key => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key+1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->role ? $user->role->role_name : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->created_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                @if(auth()->user()->role->role_name === 'superadmin' || auth()->user()->role->role_name === 'admin')
                                    <a href="{{ route('user.edit', $user->user_id) }}" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Edit
                                    </a>
                                    <button type="button" 
                                            class="toggle-status inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white {{ $user->status === 'active' ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"
                                            data-user-id="{{ $user->user_id }}"
                                            data-username="{{ $user->username }}"
                                            data-status="{{ $user->status }}">
                                        {{ $user->status === 'active' ? 'Non-aktifkan' : 'Aktifkan' }}
                                    </button>
                                    <form action="{{ route('user.delete', $user->user_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-user inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                data-username="{{ $user->username }}">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- CSS untuk styling DataTables -->
<style>
    .dataTables_info {
        @apply text-sm font-medium text-gray-700 italic tracking-wide;
        font-family: 'Poppins', sans-serif;
    }
    
    .dataTables_length select,
    .dataTables_filter input {
        @apply rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500;
    }
</style>

<!-- Script untuk konfirmasi delete -->
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            language: {
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data pengguna",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data pengguna",
                infoFiltered: "(difilter dari _MAX_ total data pengguna)",
                search: "Pencarian:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan"
            }
        });

        // Updated delete confirmation
        $('.delete-user').click(function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            let username = $(this).data('username');
            
            Swal.fire({
                title: 'Peringatan Penghapusan Pengguna!',
                html: `
                    <div class="text-left">
                        <p class="mb-4 font-semibold text-red-600">Anda akan menghapus pengguna: <strong>${username}</strong></p>
                        
                        <div class="mb-4">
                            <p class="font-medium mb-2">Penghapusan ini akan berdampak pada:</p>
                            <ul class="list-disc pl-5 space-y-2 text-sm">
                                <li class="text-gray-800">Data profil dan akun pengguna</li>
                                <li class="text-gray-800">Seluruh riwayat transaksi yang dibuat pengguna</li>
                                <li class="text-gray-800">Laporan penjualan terkait pengguna</li>
                                <li class="text-gray-800">Riwayat aktivitas sistem</li>
                                <li class="text-gray-800">Data pelanggan yang dikelola pengguna</li>
                            </ul>
                        </div>

                        <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                            <p class="text-yellow-800 font-medium mb-2">⚠️ Penting untuk diperhatikan:</p>
                            <ul class="list-disc pl-5 space-y-1 text-sm text-yellow-700">
                                <li>Proses ini tidak dapat dibatalkan</li>
                                <li>Semua data terkait tidak dapat dipulihkan</li>
                                <li>Pertimbangkan untuk menonaktifkan akun sebagai alternatif</li>
                            </ul>
                        </div>

                        <div class="p-3 bg-red-50 border border-red-200 rounded-md">
                            <p class="text-red-600 font-semibold">Apakah Anda yakin ingin melanjutkan penghapusan?</p>
                        </div>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Saya Mengerti dan Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                width: '600px'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Konfirmasi Terakhir',
                        text: 'Ketik "HAPUS" untuk melanjutkan penghapusan',
                        input: 'text',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus Sekarang',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#DC2626',
                        cancelButtonColor: '#6B7280',
                        inputValidator: (value) => {
                            if (value !== 'HAPUS') {
                                return 'Silakan ketik "HAPUS" untuk konfirmasi'
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });

        // Toggle status functionality
        $('.toggle-status').click(function() {
            const userId = $(this).data('user-id');
            const username = $(this).data('username');
            const currentStatus = $(this).data('status');
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
            const actionText = currentStatus === 'active' ? 'menonaktifkan' : 'mengaktifkan';

            Swal.fire({
                title: `Konfirmasi ${actionText} pengguna`,
                html: `
                    <div class="text-left">
                        <p class="mb-4">Anda akan ${actionText} pengguna: <strong>${username}</strong></p>
                        <p class="mb-2">Konsekuensi:</p>
                        <ul class="list-disc pl-5 mb-4 text-sm">
                            <li>User ${currentStatus === 'active' ? 'tidak akan bisa login' : 'akan bisa login kembali'}</li>
                            <li>Semua akses ${currentStatus === 'active' ? 'akan dinonaktifkan' : 'akan diaktifkan kembali'}</li>
                        </ul>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: currentStatus === 'active' ? '#EAB308' : '#059669',
                cancelButtonColor: '#6B7280',
                confirmButtonText: `Ya, ${actionText}`,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/dashboard/users/${userId}/toggle-status`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: newStatus
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
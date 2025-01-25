@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        {{-- <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Daftar Pengguna</h1>
            <div class="mt-2 flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                <p class="text-sm text-gray-600">Jumlah pengguna saat ini: <span class="font-medium">{{ $totalUsers }}</span></p>
                @if (count($userLimits) > 0)
                    @foreach ($userLimits as $groupId => $limit)
                        <p class="text-sm text-gray-600">Batas jumlah pengguna pada Group ID {{ $groupId }}: <span class="font-medium">{{ $limit }}</span></p>
                    @endforeach
                @endif
            </div>
        </div> --}}

        <x-flash-message />

        <!-- Action Button -->
        <div class="mb-6">
            <a href="{{ route('user.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Pengguna
            </a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Dibuat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent Outlet ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Group ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $key => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key+1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->role ? $user->role->role_name : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->outlet ? $user->outlet->outlet_name : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->created_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->outlet ? $user->outlet->parent_outlet_id : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->outlet ? $user->outlet->outlet_id : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->outlet ? $user->outlet->outlet_group_id : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('user.edit', $user->user_id) }}" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Edit
                                </a>
                                <form action="{{ route('user.delete', $user->user_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="delete-user inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                            data-username="{{ $user->username }}">
                                        Delete
                                    </button>
                                </form>
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

        // Custom delete confirmation
        $('.delete-user').click(function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            let username = $(this).data('username');
            
            Swal.fire({
                title: 'Konfirmasi Penghapusan Pengguna',
                html: `
                    <div class="text-left">
                        <p class="mb-4">Anda akan menghapus pengguna: <strong>${username}</strong></p>
                        <p class="mb-2">Tindakan ini akan:</p>
                        <ul class="list-disc pl-5 mb-4 text-sm">
                            <li>Menghapus semua data pengguna secara permanen</li>
                            <li>Menghapus akses login pengguna</li>
                            <li>Menghapus riwayat aktivitas pengguna</li>
                        </ul>
                        <p class="text-red-600 font-semibold">Tindakan ini tidak dapat dibatalkan!</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Hapus Pengguna',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
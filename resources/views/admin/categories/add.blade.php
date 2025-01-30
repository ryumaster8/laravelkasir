@extends('layouts.layout')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700">
                <h3 class="text-xl font-semibold text-white">Tambah Kategori</h3>
            </div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <x-flash-message />
                <div class="p-6 space-y-6">
                    <div class="grid gap-6">
                        <div>
                            <label for="outlet_id" class="block text-sm font-medium text-gray-700">Outlet</label>
                            <input type="text" class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                value="{{ $outletName ?? '' }}" readonly>
                            <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                        </div>

                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Operator</label>
                            <input type="text" class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                value="{{ $username ?? '' }}" readonly>
                            <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                        </div>

                        <div>
                            <label for="category_name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                            <input type="text" 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category_name') border-red-500 @enderror"
                                id="category_name" 
                                name="category_name" 
                                value="{{ old('category_name') }}"
                                placeholder="Masukan nama kategori">
                            @error('category_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                    <a href="{{ url()->previous() }}" 
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Kategori -->
        <div class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700">
                <h3 class="text-xl font-semibold text-white">Data Kategori</h3>
            </div>
            <div class="p-6">
                <div class="relative overflow-x-auto">
                    <table id="categoryTable" class="w-full text-sm text-left">
                        <thead class="text-xs uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">ID Kategori</th>
                                <th class="px-6 py-3">Nama Kategori</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{ route('categories.data') }}",
                    type: 'GET'
                },
                columns: [
                    { 
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'category_id' },
                    { data: 'category_name' },
                    {
                        data: null,
                        render: function(data) {
                            return `
                                <div class="flex space-x-3">
                                    <a href="/dashboard/categories/${data.category_id}/edit" 
                                       class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete('${data.category_id}', '${data.category_name}')" 
                                            class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </div>
                            `;
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                },
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

        function confirmDelete(categoryId, categoryName) {
            Swal.fire({
                title: 'Konfirmasi Penghapusan',
                html: `Anda akan menghapus kategori <strong>${categoryName}</strong><br><br>
                       Pastikan kategori ini tidak digunakan pada data lainnya.<br>
                       Tindakan ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/dashboard/categories/${categoryId}/delete`;
                }
            });
        }
    </script>
    @endpush
@endsection
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
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">ID Kategori</th>
                                <th scope="col" class="px-6 py-3">Nama Kategori</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $index => $category)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $category->category_id }}</td>
                                <td class="px-6 py-4">{{ $category->category_name }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('categories.edit', $category->category_id) }}" 
                                           class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <button type="button"
                                                onclick="confirmDelete('{{ $category->category_id }}', '{{ $category->category_name }}')"
                                                class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="4" class="px-6 py-4 text-center">Tidak ada data kategori</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(categoryId, categoryName) {
            if (confirm(`Peringatan!\n\nAnda akan menghapus kategori "${categoryName}"\n\nPastikan kategori ini tidak digunakan pada data diskon atau data lainnya.\nTindakan ini tidak dapat dibatalkan.\n\nLanjutkan menghapus?`)) {
                window.location.href = "{{ route('categories.delete', '') }}/" + categoryId;
            }
        }
    </script>
@endsection
@extends('layouts.layout')

@section('title', 'Tambah Nomor Seri')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Nomer Seri Produk
                </h3>
                <p class="text-blue-100 mt-1">ID: {{ $product->product_id }} - {{ $product->product_name }}</p>
            </div>

            <div class="p-6">
                <x-flash-message />
                
                <!-- Product Info Card -->
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Produk ID</label>
                            <div class="mt-1 text-lg font-semibold text-gray-900">{{ $product->product_id }}</div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Operator</label>
                            <div class="mt-1 text-lg font-semibold text-gray-900">{{ $user->username }}</div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Outlet</label>
                            <div class="mt-1 text-lg font-semibold text-gray-900">{{ $user->outlet ? $user->outlet->outlet_name : '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Serial Number Form -->
                <form action="{{ route('self-products.store-serial', $product->product_id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="serial_number" class="block text-sm font-medium text-gray-700">Nomor Seri</label>
                        <div class="mt-1">
                            <input type="text" 
                                   id="serial_number" 
                                   name="serial_number" 
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('serial_number') border-red-500 @enderror"
                                   value="{{ old('serial_number') }}" 
                                   placeholder="Masukkan Nomer Seri">
                            @error('serial_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Nomer Seri
                        </button>
                        <a href="{{ route('self-products') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </form>

                <!-- Serial Numbers Table -->
                <div class="mt-8">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Data Nomer Seri yang Sudah Ada</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomer Seri</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($product->serials as $key => $serial)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $serial->serial_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $serial->outlet->outlet_name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $serial->status == 'available' ? 'bg-green-100 text-green-800' : 
                                               ($serial->status == 'sold' ? 'bg-red-100 text-red-800' : 
                                               'bg-yellow-100 text-yellow-800') }}">
                                            {{ $serial->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="confirmDelete({{ $serial->serial_id }}, '{{ $serial->serial_number }}')"
                                                class="text-red-600 hover:text-red-900 focus:outline-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(serialId, serialNumber) {
    if (confirm('Anda yakin ingin menghapus serial number : ' + serialNumber + '?')) {
        window.location.href = '/self-products/delete-serial/' + serialId;
    }
}
</script>
@endpush

@endsection
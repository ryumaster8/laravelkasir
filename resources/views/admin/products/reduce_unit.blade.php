@extends('layouts.layout')

@php
    use App\Models\ModelProductSerials;
@endphp

@section('title', 'Kurangi Unit Produk')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="bg-red-600 px-6 py-4">
            <h2 class="text-white text-lg font-semibold">
                Kurangi Unit untuk Produk ID: {{ $product->product_id }} - {{ $product->product_name }}
            </h2>
        </div>
        <div class="p-6">
            <x-flash-message />
    
            <div class="mb-6">
                <h5 class="text-gray-700 font-medium">
                    Daftar Unit yang Bisa Dihapus
                    <span class="text-sm text-gray-500">(Sisa Stok Serial : {{ $availableSerials }})</span>
                </h5>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Barcode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(auth()->check())
                            @foreach ($product->serials()
                                ->with('outlet')
                                ->where('status', ModelProductSerials::STATUS_TERSEDIA)
                                ->where('outlet_id', auth()->user()->outlet_id)
                                ->get() as $key => $serial)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $serial->serial_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $serial->outlet?->outlet_name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $serial->status == ModelProductSerials::STATUS_TERSEDIA ? 'bg-green-100 text-green-800' : 
                                               ($serial->status == ModelProductSerials::STATUS_TERJUAL ? 'bg-red-100 text-red-800' : 
                                               'bg-yellow-100 text-yellow-800') }}">
                                            {{ $serial->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="confirmDelete({{ $serial->serial_id }}, '{{ $serial->serial_number }}')"
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Silahkan login terlebih dahulu
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="{{ route('self-products') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(serialId, serialNumber) {
        if (confirm('Anda yakin ingin menghapus serial number : ' + serialNumber + '?')) {
            window.location.href = '/self-products/delete-serial/' + serialId;
        }
    }
</script>
@endsection
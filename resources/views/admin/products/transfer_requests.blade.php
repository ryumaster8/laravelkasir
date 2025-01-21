@extends('layouts.layout')

@section('title', 'Permintaan Pemindahan Stok')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Permintaan Pemindahan Stok</h3>
        <x-flash-message />
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table id="transitsTable" class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomer Serial</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dari Outlet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Pengirim</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($transits as $key => $transit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $transit->product->product_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $transit->serial->serial_number ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $transit->fromOutlet->outlet_name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $transit->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                    ($transit->status == 'transit' ? 'bg-blue-100 text-blue-800' : 
                                    ($transit->status == 'received' ? 'bg-green-100 text-green-800' : 
                                    'bg-red-100 text-red-800')) }}">
                                    {{ $transit->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $transit->operatorSender->username ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="{{ route('products.approve-transfer', $transit->transit_id) }}" 
                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                        Terima
                                    </a>
                                    <a href="{{ route('products.reject-transfer', $transit->transit_id) }}" 
                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                        Tolak
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('self-products') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#transitsTable').DataTable({
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
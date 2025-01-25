@extends('layouts.layout')

@section('title', 'Riwayat Permintaan Pemindahan Stok')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
         <h3 class="text-2xl font-semibold text-gray-800 mb-6">Riwayat Permintaan Pemindahan Stok</h3>
            <x-flash-message />
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
              <table id="transitsTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50/75">
                  <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomer Serial</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dari Outlet</th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ke Outlet</th>
                         <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Pengirim</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Pengiriman</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                  @foreach($transits as $key => $transit)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $transit->product->product_name }}</td>
                              <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $transit->serial->serial_number ?? '-' }}</td>
                             <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $transit->fromOutlet->outlet_name ?? '-' }}</td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $transit->toOutlet->outlet_name ?? '-' }}</td>
                             <td class="px-6 py-3 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-medium rounded-full 
                                      {{ $transit->status == 'pending' ? 'bg-yellow-50 text-yellow-700 ring-1 ring-yellow-600/20' : 
                                         ($transit->status == 'transit' ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-600/20' :
                                          ($transit->status == 'received' ? 'bg-green-50 text-green-700 ring-1 ring-green-600/20' : 'bg-red-50 text-red-700 ring-1 ring-red-600/20')) }}">
                                    {{ $transit->status }}
                                </span>
                              </td>
                               <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $transit->operatorSender->username ?? '-' }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $transit->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
           </div>
            <div class="mt-6 flex justify-end">
               <a href="{{ route('self-products') }}"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                 <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
     </div>
    </div>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
      
    <script>
        $(document).ready( function () {
           $('#transitsTable').DataTable();
       } );
   </script>
@endsection
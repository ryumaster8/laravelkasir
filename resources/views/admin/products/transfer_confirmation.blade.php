@extends('layouts.layout')

@section('title', 'Konfirmasi Pemindahan Unit')

@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
          <div class="px-6 py-4 bg-gray-50/75 border-b border-gray-100">
                <h3 class="text-xl font-semibold text-gray-800">Konfirmasi Pemindahan Unit</h3>
           </div>
          <div class="p-6 space-y-6">
                <x-flash-message />
                 <p class="text-gray-700">
                    <span class="font-medium">Produk ID:</span> {{ $product->product_id }} - <span class="font-medium">{{ $product->product_name }}</span> <br>
                    Berhasil Dipindahkan Oleh <span class="font-medium">{{ $user->username }}</span>
                  </p>

                 <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50/75">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomer Serial</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dari Outlet</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ke Outlet</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                           @foreach($transits as $key => $transit)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $transit->serial->serial_number }}</td>
                                     <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $transit->fromOutlet->outlet_name }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $transit->toOutlet->outlet_name }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-medium rounded-full 
                                              {{ $transit->status == 'pending' ? 'bg-yellow-50 text-yellow-700 ring-1 ring-yellow-600/20' : 
                                                 ($transit->status == 'transit' ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-600/20' :
                                                  ($transit->status == 'received' ? 'bg-green-50 text-green-700 ring-1 ring-green-600/20' : 'bg-red-50 text-red-700 ring-1 ring-red-600/20')) }}">
                                            {{ $transit->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                       </tbody>
                   </table>
                 </div>
               <div class="mt-6 flex justify-end">
                    <a href="{{ route('self-products') }}"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Kembali
                    </a>
               </div>
           </div>
    </div>
</div>
@endsection
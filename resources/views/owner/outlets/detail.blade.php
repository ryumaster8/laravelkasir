@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 flex justify-between items-center">
            <h4 class="text-xl font-semibold text-white tracking-wider">Detail Outlet</h4>
            <a href="{{ route('owner.outlets.index') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition duration-300">
                Kembali
            </a>
        </div>
        
        <div class="p-6 space-y-8">
            {{-- Informasi Dasar --}}
            <div class="grid grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="border-b-2 border-blue-500 pb-2">
                        <h5 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
                            Informasi Outlet
                        </h5>
                    </div>
                    <div class="grid grid-cols-2 gap-6 text-lg">
                        <p class="text-gray-600 font-medium tracking-wide">Nama Outlet</p>
                        <p class="font-semibold text-gray-800">{{ $outlet->outlet_name }}</p>
                        
                        <p class="text-gray-600 font-medium tracking-wide">Email</p>
                        <p class="font-semibold text-gray-800">{{ $outlet->email }}</p>
                        
                        <p class="text-gray-600 font-medium tracking-wide">Telepon</p>
                        <p class="font-semibold text-gray-800">{{ $outlet->outlet_phone }}</p>
                        
                        <p class="text-gray-600 font-medium tracking-wide">Alamat</p>
                        <p class="font-semibold text-gray-800">{{ $outlet->address }}</p>
                        
                        <p class="text-gray-600 font-medium tracking-wide">Group Outlet</p>
                        <p class="font-semibold text-gray-800">{{ optional($outlet->outletGroup)->outlet_group_name ?? 'N/A' }}</p>
                        
                        <p class="text-gray-600 font-medium tracking-wide">Admin</p>
                        <p class="font-semibold text-gray-800">{{ optional($outlet->adminUser)->name ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="border-b-2 border-purple-500 pb-2">
                        <h5 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-purple-400 bg-clip-text text-transparent">
                            Informasi Membership
                        </h5>
                    </div>
                    <div class="grid grid-cols-2 gap-6 text-lg">
                        <p class="text-gray-600 font-medium tracking-wide">Membership</p>
                        <p class="font-semibold text-gray-800">{{ optional($outlet->membership)->membership_name ?? 'N/A' }}</p>
                        
                        <p class="text-gray-600 font-medium tracking-wide">Status</p>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $outlet->isSubscriptionActive() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $outlet->isSubscriptionActive() ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                        
                        <p class="text-gray-600 font-medium tracking-wide">Tanggal Mulai</p>
                        <p class="font-semibold text-gray-800">{{ optional($outlet->membership_started_at)->format('d F Y') ?? 'N/A' }}</p>
                        
                        <p class="text-gray-600 font-medium tracking-wide">Tanggal Berakhir</p>
                        <p class="font-semibold text-gray-800">{{ optional($outlet->membership_expires_at)->format('d F Y') ?? 'N/A' }}</p>
                        
                        <p class="text-gray-600 font-medium tracking-wide">Sisa Waktu</p>
                        <p class="font-semibold text-gray-800">{{ $outlet->getDaysUntilExpiration() }} hari</p>
                    </div>
                </div>
            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-4 gap-6 mt-8">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <h6 class="text-blue-600 font-semibold text-lg mb-2">Total Produk</h6>
                    <p class="text-3xl font-black text-blue-700">{{ $outlet->products->count() }}</p>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <h6 class="text-green-600 font-semibold text-lg mb-2">Total Kategori</h6>
                    <p class="text-3xl font-black text-green-700">{{ $outlet->categories->count() }}</p>
                </div>
                
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <h6 class="text-purple-600 font-semibold text-lg mb-2">Jumlah Cabang</h6>
                    <p class="text-3xl font-black text-purple-700">{{ $outlet->branchOutlets->count() }}</p>
                </div>
                
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <h6 class="text-yellow-600 font-semibold text-lg mb-2">Status Outlet</h6>
                    <p class="text-3xl font-black text-yellow-700">{{ $outlet->is_active ? 'Aktif' : 'Non-Aktif' }}</p>
                </div>
            </div>

            {{-- History Membership --}}
            <div class="mt-8">
                <div class="border-b-2 border-indigo-500 pb-2 mb-6">
                    <h5 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-indigo-400 bg-clip-text text-transparent">
                        History Perubahan Membership
                    </h5>
                </div>
                
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dari</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ke</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($outlet->membershipChangeRequests as $history)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $history->requested_at->format('d F Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $history->change_type === 'upgrade' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($history->change_type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ optional($history->currentMembership)->membership_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ optional($history->requestedMembership)->membership_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($history->change_fee, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @switch($history->status)
                                                @case('pending')
                                                    bg-yellow-100 text-yellow-800
                                                    @break
                                                @case('approved')
                                                    bg-blue-100 text-blue-800
                                                    @break
                                                @case('completed')
                                                    bg-green-100 text-green-800
                                                    @break
                                                @case('rejected')
                                                    bg-red-100 text-red-800
                                                    @break
                                            @endswitch">
                                            {{ ucfirst($history->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada history perubahan membership
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Google Fonts --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');
    
    .container {
        font-family: 'Poppins', sans-serif;
    }
    
    .gradient-text {
        background: linear-gradient(to right, #2563eb, #60a5fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection

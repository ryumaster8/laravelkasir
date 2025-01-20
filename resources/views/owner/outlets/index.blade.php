@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
            <h4 class="text-xl font-semibold text-white">Daftar Outlet</h4>
        </div>
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Outlet</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Admin</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Group Outlet</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Membership</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jatuh Tempo</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sisa Waktu</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Cabang</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($outlets as $index => $outlet)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $outlet->outlet_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $outlet->address }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ optional($outlet->adminUser)->name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $outlet->email }}</td>
                                <td class="px-4 py-3 text-sm">{{ $outlet->outlet_phone }}</td>
                                <td class="px-4 py-3 text-sm">
                                    {{ optional($outlet->outletGroup)->outlet_group_name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ optional($outlet->membership)->membership_name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($outlet->membership_expires_at)
                                        <span class="{{ $outlet->isSubscriptionActive() ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $outlet->membership_expires_at->format('d F Y') }}
                                        </span>
                                    @else
                                        <span class="text-gray-500">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($outlet->membership_expires_at)
                                        @php
                                            $daysLeft = floor($outlet->getDaysUntilExpiration());
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $daysLeft > 7 ? 'bg-green-100 text-green-800' : 
                                               ($daysLeft > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            @if($daysLeft > 0)
                                                {{ $daysLeft }} hari lagi
                                            @else
                                                Sudah berakhir
                                            @endif
                                        </span>
                                    @else
                                        <span class="text-gray-500">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($outlet->branch_count > 0)
                                        <a href="{{ route('owner.outlets.branches', $outlet->outlet_id) }}" 
                                           class="text-blue-600 hover:text-blue-800 hover:underline">
                                            {{ $outlet->branch_count }}
                                        </a>
                                    @else
                                        {{ $outlet->branch_count }}
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $outlet->is_active 
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-red-100 text-red-800' 
                                        }}">
                                        {{ $outlet->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('owner.outlets.detail', $outlet->outlet_id) }}" 
                                           class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Detail
                                        </a>
                                        <a href="#" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <a href="{{ route('owner.outlets.membership-history', $outlet->outlet_id) }}" 
                                           class="px-3 py-1 bg-purple-500 text-white rounded hover:bg-purple-600">
                                            History
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada outlet yang tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

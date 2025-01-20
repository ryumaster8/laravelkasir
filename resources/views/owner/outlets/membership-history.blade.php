@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
            <div class="flex justify-between items-center">
                <h4 class="text-xl font-semibold text-white">History Membership - {{ $outlet->outlet_name }}</h4>
                <a href="{{ route('owner.outlets.index') }}" class="text-white hover:text-gray-200">
                    Kembali
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="mb-4">
                <h5 class="text-lg font-semibold">Current Membership: {{ optional($outlet->membership)->membership_name }}</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Request</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diproses Oleh</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dari Membership</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ke Membership</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya Perubahan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya Layanan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Biaya</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($membershipHistory as $history)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">
                                    {{ $history->requested_at ? date('d/m/Y H:i', strtotime($history->requested_at)) : 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $history->processed_by ? optional($history->processor)->username : 'Belum diproses' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $history->upgrade_fee > 0 ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $history->upgrade_fee > 0 ? 'Upgrade' : 'Downgrade' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ optional($history->currentMembership)->membership_name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ optional($history->requestedMembership)->membership_name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Rp {{ number_format($history->change_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Rp {{ number_format($history->service_fee ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Rp {{ number_format(($history->change_fee + ($history->service_fee ?? 0)), 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $history->status == 'approved' ? 'bg-green-100 text-green-800' : 
                                           ($history->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($history->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $history->payment_status == 'verified' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($history->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada history perubahan membership
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

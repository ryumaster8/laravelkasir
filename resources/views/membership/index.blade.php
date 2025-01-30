@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container-fluid px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Membership</h1>
        </div>

        <div class="overflow-x-auto relative">
            <div class="inline-block min-w-full">
                <table class="w-full bg-white rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase sticky left-0 bg-gray-100">Nama</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Rank</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Batas Cabang</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Biaya Pendaftaran</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Biaya Bulanan</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Biaya Upgrade</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Biaya Downgrade</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Servis</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Grosir</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Lokasi Produk</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Audit Stok</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Print Nota Servis</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Print Nota Kasir</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Diskon</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Kontak Pelanggan</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Batas Transaksi Harian</th>
                            <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase">Batas User</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($memberships as $membership)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap sticky left-0 bg-white">{{ $membership->membership_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $membership->rank }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $membership->branch_limit }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($membership->biaya_pendaftaran, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($membership->biaya_bulanan, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($membership->biaya_upgrade, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($membership->biaya_downgrade, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $membership->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $membership->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {!! $membership->service_feature ? '✓' : '×' !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {!! $membership->wholesale_feature ? '✓' : '×' !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {!! $membership->product_location_feature ? '✓' : '×' !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {!! $membership->stock_audit_feature ? '✓' : '×' !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {!! $membership->service_receipt_printing ? '✓' : '×' !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {!! $membership->cashier_receipt_printing_feature ? '✓' : '×' !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {!! $membership->discount_feature ? '✓' : '×' !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {!! $membership->customer_contact_feature ? '✓' : '×' !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $membership->daily_transaction_limit ?? 'Unlimited' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $membership->user_limit }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Add smooth scrolling */
    .overflow-x-auto {
        scroll-behavior: smooth;
    }
    
    /* Add shadow to indicate more content */
    .overflow-x-auto::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 40px;
        pointer-events: none;
        background: linear-gradient(to left, rgba(255,255,255,0.9), transparent);
    }
</style>
@endsection

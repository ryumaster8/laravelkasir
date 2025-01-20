@extends('layouts.layout')

@section('title', 'Informasi Tagihan')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Informasi Tagihan - {{ $outlet->outlet_name }}</h1>
            <p class="mt-2 text-sm text-gray-600">
                Outlet: {{ $outlet->outlet_name }}
            </p>
        </div>

        <!-- Current Membership Info -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Status Membership</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Membership Saat Ini</p>
                    <p class="text-lg font-medium">{{ $outlet->membership->membership_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="text-lg font-medium">
                        @if($outlet->isSubscriptionActive())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                Tidak Aktif
                            </span>
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Berakhir Pada</p>
                    <p class="text-lg font-medium">{{ $nextBillingDate ? $nextBillingDate->format('d M Y') : 'Tidak tersedia' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Sisa Waktu</p>
                    <p class="text-lg font-medium">{{ $daysUntilExpiration }} hari</p>
                </div>
            </div>
        </div>

        <!-- Pending Payments -->
        @if($unpaidRequests->count() > 0)
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Tagihan Pending</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Membership</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($unpaidRequests as $request)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $request->requested_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($request->change_type === 'upgrade')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Upgrade
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Downgrade
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $request->requestedMembership->membership_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($request->change_fee, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('payment.show', $request->request_id) }}" class="text-indigo-600 hover:text-indigo-900">
                                    Bayar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Monthly Fee Info -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Biaya Bulanan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Biaya Bulanan</p>
                    <p class="text-lg font-medium">Rp {{ number_format($outlet->membership->biaya_bulanan, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Auto Renewal</p>
                    <p class="text-lg font-medium">
                        @if($outlet->auto_renewal)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                Tidak Aktif
                            </span>
                        @endif
                    </p>
                    <div class="mt-4">
                        @if($outlet->auto_renewal)
                            <form action="{{ route('outlet.cancel-auto-renewal') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                    Nonaktifkan Perpanjangan Otomatis
                                </button>
                            </form>
                        @else
                            <form action="{{ route('outlet.enable-auto-renewal') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                    Aktifkan Perpanjangan Otomatis
                                </button>
                            </form>
                        @endif
                    </div>
                    
                    <!-- Keuntungan Auto Renewal -->
                    <div class="mt-6 bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-blue-800 mb-2">Keuntungan Auto Renewal:</h3>
                        <ul class="text-sm text-blue-700 space-y-2 list-disc pl-5">
                            <li>Membership tidak pernah terputus</li>
                            <li>Terhindar dari denda keterlambatan pembayaran</li>
                            <li>Notifikasi otomatis sebelum pembayaran</li>
                            <li>Prioritas layanan pelanggan</li>
                            <li>Tidak perlu repot perpanjang manual setiap bulan</li>
                            <li>Dapat dinonaktifkan kapan saja</li>
                        </ul>
                        <p class="mt-3 text-xs text-blue-600">
                            *Pembayaran akan ditagihkan otomatis 7 hari sebelum masa aktif berakhir
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

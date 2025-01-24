@extends('layouts.layout')

@section('content')

<x-flash-message />

<div class="p-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-semibold">Dashboard Admin</h2>
        <p class="text-gray-600">Selamat datang di dashboard admin!</p>
    </div>

    <!-- Kasir Cards -->
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kas Awal Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Kas Awal Hari Ini</h3>
                    <span class="text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </span>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">
                    Rp {{ number_format($kasAwal?->opening_balance ?? 0, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ $kasAwal ? 'Dibuka pada ' . \Carbon\Carbon::parse($kasAwal->created_at)->format('H:i') : 'Belum ada kas awal' }}
                </div>
            </div>

            <!-- Penambahan Kas Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Penambahan Kas Hari Ini</h3>
                    <span class="text-green-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </span>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">
                    Rp {{ number_format($totalPenambahan ?? 0, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-500">
                    Total {{ $jumlahPenambahan ?? 0 }} transaksi penambahan
                </div>
            </div>

            <!-- Penarikan Kas Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Penarikan Kas Hari Ini</h3>
                    <span class="text-red-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </span>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">
                    Rp {{ number_format($totalPenarikan ?? 0, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-500">
                    Total {{ $jumlahPenarikan ?? 0 }} transaksi penarikan
                </div>
            </div>
        </div>

        <!-- Total Kas Saat Ini -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Total Kas Saat Ini</h3>
                <span class="text-purple-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </span>
            </div>
            <div class="text-4xl font-bold text-gray-900">
                Rp {{ number_format(($kasAwal?->opening_balance ?? 0) + ($totalPenambahan ?? 0) - ($totalPenarikan ?? 0), 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Baris 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 text-white p-4">
                Ringkasan Transaksi
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Total Transaksi Hari Ini</h5>
                <p class="mb-4">Anda memiliki <strong>15</strong> transaksi baru hari ini.</p>
                <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-green-600 text-white p-4">
                Aktivitas Pengguna
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Pengguna Baru</h5>
                <p class="mb-4">Ada <strong>5</strong> pengguna baru mendaftar dalam 24 jam terakhir.</p>
                <a href="#" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-yellow-500 text-white p-4">
                Statistik Penjualan
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Total Pendapatan Bulan Ini</h5>
                <p class="mb-4"><strong>Rp 10.000.000,-</strong></p>
                <a href="#" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Lihat Detail</a>
            </div>
        </div>

        {{-- Service related cards removed --}}

        <!-- Baris 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-600 text-white p-4">
                Permintaan Pemindahan Stok
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Permintaan Persetujuan</h5>
                <p class="mb-4">Ada <strong></strong> permintaan pemindahan stok yang menunggu persetujuan.</p>
                <a href="/admin/products/transfer-requests" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 text-white p-4">
                Pengajuan Pemindahan Stok
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Pengajuan Terkini</h5>
                <p class="mb-4">Ada <strong></strong> pengajuan pemindahan stok baru yang menunggu persetujuan.</p>
                <a href="/admin/products/submission-transfer-requests" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-cyan-600 text-white p-4">
                Log Aktivitas
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Catatan Aktivitas</h5>
                <p class="mb-4">Lihat log aktivitas terbaru sistem.</p>
                <a href="/admin/activity-log" class="inline-block px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700">Lihat Log</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
// ...existing scripts...
@endpush

@endsection

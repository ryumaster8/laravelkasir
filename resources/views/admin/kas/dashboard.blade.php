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
                    Rp {{ number_format($kasAwal?->nominal ?? 0, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ $kasAwal ? 'Dibuka pada ' . \Carbon\Carbon::parse($kasAwal->created_at)->format('H:i') : 'Belum ada kas awal' }}
                </div>
                @if($kasAwal?->keterangan)
                    <div class="mt-2 text-sm text-gray-600">
                        Keterangan: {{ $kasAwal->keterangan }}
                    </div>
                @endif
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
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Total {{ $jumlahPenambahan ?? 0 }} transaksi penambahan
                    </div>
                    <a href="{{ route('penambahan') }}" 
                       class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Lihat Detail
                    </a>
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
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Total {{ $jumlahPenarikan ?? 0 }} transaksi penarikan
                    </div>
                    <a href="{{ route('penarikan') }}" 
                       class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Lihat Detail
                    </a>
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
                @php
                    $totalKas = ($kasAwal?->nominal ?? 0) + 
                               ($totalPenambahan ?? 0) + 
                               ($totalPenjualanEcer ?? 0) + 
                               ($totalPenjualanGrosir ?? 0) - 
                               ($totalPenarikan ?? 0);
                @endphp
                Rp {{ number_format($totalKas, 0, ',', '.') }}
            </div>
            <div class="mt-2 text-sm text-gray-500">
                Termasuk {{ $jumlahPenambahan }} penambahan, {{ $jumlahPenarikan }} penarikan, 
                {{ $jumlahTransaksiEcer }} transaksi ecer, dan {{ $jumlahTransaksiGrosir }} transaksi grosir hari ini
            </div>
        </div>

        <!-- Transaksi Cards -->
        
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Penjualan Ecer Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Penjualan Ecer Hari Ini</h3>
                    <span class="text-indigo-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </span>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">
                    Rp {{ number_format($totalPenjualanEcer ?? 0, 0, ',', '.') }}
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Total {{ $jumlahTransaksiEcer ?? 0 }} transaksi ecer
                    </div>
                    <a href="{{ route('transactions.index', ['type' => 'ecer']) }}" 
                       class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <!-- Penjualan Grosir Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Penjualan Grosir Hari Ini</h3>
                    <span class="text-orange-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                    </span>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">
                    Rp {{ number_format($totalPenjualanGrosir ?? 0, 0, ',', '.') }}
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Total {{ $jumlahTransaksiGrosir ?? 0 }} transaksi grosir
                    </div>
                    <a href="{{ route('transactions.index', ['type' => 'grosir']) }}" 
                       class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
// ...existing scripts...
@endpush

@endsection

@extends('layouts.layout')

@section('title', 'Akurasi Kas')

@section('content')
<div class="flex justify-center mt-8">
    <div class="w-11/12">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-red-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Akurasi Kas</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Current Status -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-lg font-medium mb-4">Status Akurasi Saat Ini</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kas Seharusnya:</span>
                                <span class="font-medium">Rp {{ number_format($akurasi['seharusnya'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kas Aktual:</span>
                                <span class="font-medium">Rp {{ number_format($akurasi['aktual'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Selisih:</span>
                                <span class="font-medium {{ $akurasi['selisih'] < 0 ? 'text-red-600' : ($akurasi['selisih'] > 0 ? 'text-green-600' : 'text-gray-900') }}">
                                    {{ $akurasi['selisih'] < 0 ? '-' : '' }}Rp {{ number_format(abs($akurasi['selisih']), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="font-medium">{{ $akurasi['status'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Components -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-lg font-medium mb-4">Komponen Kas</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kas Awal:</span>
                                <span class="font-medium">Rp {{ number_format($akurasi['komponen']['kas_awal'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Penambahan:</span>
                                <span class="font-medium">Rp {{ number_format($akurasi['komponen']['penambahan'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Penarikan:</span>
                                <span class="font-medium">Rp {{ number_format($akurasi['komponen']['penarikan'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Penjualan:</span>
                                <span class="font-medium">Rp {{ number_format($akurasi['komponen']['penjualan'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Table -->
                <div class="mt-8">
                    <h4 class="text-lg font-medium mb-4">Riwayat Akurasi</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selisih</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($historyAkurasi as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->waktu }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->creator->username }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="{{ $item->selisih < 0 ? 'text-red-600' : ($item->selisih > 0 ? 'text-green-600' : 'text-gray-900') }}">
                                            {{ $item->selisih < 0 ? '-' : '' }}Rp {{ number_format(abs($item->selisih), 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->selisih == 0 ? 'Akurat' : ($item->selisih > 0 ? 'Lebih' : 'Kurang') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->keterangan ?: '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.layout')

@section('title', 'Penyesuaian Kas')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Penyesuaian Kas</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold mb-4">Rincian Kas</h3>
                <div class="space-y-2">
                    <p>Kas Awal: Rp {{ number_format($kasAwal ?? 0, 0) }}</p>
                    <p>Total Penjualan: Rp {{ number_format($totalPenjualan ?? 0, 0) }}</p>
                    <p>Total Penambahan: Rp {{ number_format($totalPenambahan ?? 0, 0) }}</p>
                    <p>Total Penarikan: Rp {{ number_format($totalPenarikan ?? 0, 0) }}</p>
                    <div class="border-t pt-2">
                        <p class="font-bold">Total Seharusnya: Rp {{ number_format($totalSeharusnya ?? 0, 0) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold mb-4">Form Penyesuaian</h3>
                <form action="{{ route('kas.adjustments.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kas Aktual</label>
                            <input type="number" 
                                   name="kas_aktual" 
                                   class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Keterangan Selisih</label>
                            <textarea name="keterangan" 
                                    rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                    required></textarea>
                        </div>

                        <button type="submit" 
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Simpan Penyesuaian
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Riwayat Penyesuaian -->
        <div class="mt-8">
            <h3 class="font-semibold mb-4">Riwayat Penyesuaian</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Operator</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Selisih</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($adjustments as $adjustment)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $adjustment->date->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $adjustment->waktu->format('H:i:s') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $adjustment->creator->username }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 
                                {{ $adjustment->selisih > 0 ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($adjustment->selisih, 2) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $adjustment->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

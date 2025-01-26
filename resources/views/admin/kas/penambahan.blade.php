@extends('layouts.layout')

@section('title', 'Penambahan Kas')

@section('content')
<div class="flex justify-center mt-8">
    <div class="w-11/12">
        <!-- Form Penambahan -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Form Penambahan Kas</h3>
            </div>
            <div class="p-8">
                <form action="{{ route('penambahan.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="outlet" class="block text-sm font-medium text-gray-700 mb-2">Outlet</label>
                            <input type="text" 
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out" 
                                value="{{ session('outlet_name') }}" 
                                readonly>
                            <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                        </div>
                        
                        <div>
                            <label for="operator" class="block text-sm font-medium text-gray-700 mb-2">Operator</label>
                            <input type="text" 
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out" 
                                value="{{ session('username') }}" 
                                readonly>
                            <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                        </div>
                        
                        <div>
                            <label for="nominal" class="block text-sm font-medium text-gray-700 mb-2">Nominal Penambahan</label>
                            <input type="number" 
                                name="nominal" 
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out
                                @error('nominal') border-red-500 ring-red-100 @enderror" 
                                placeholder="Masukkan jumlah penambahan"
                                value="{{ old('nominal') }}" 
                                required>
                            @error('nominal')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <textarea name="keterangan" 
                                id="keterangan" 
                                rows="3" 
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out
                                @error('keterangan') border-red-500 ring-red-100 @enderror"
                                placeholder="Masukkan keterangan penambahan">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-3">
                        <button type="submit" 
                            class="px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg
                            hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                            transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                            Simpan
                        </button>
                        <a href="{{ route('penambahan') }}" 
                            class="px-6 py-2.5 bg-gray-500 text-white text-sm font-semibold rounded-lg
                            hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                            transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data Penambahan -->
        <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Data Penambahan Hari Ini</h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penambahan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($penambahan as $index => $data)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->outlet->outlet_name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->creator->username ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($data->nominal, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->waktu }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->keterangan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('penambahan.edit', $data->penambahan_kas_id) }}" 
                                        class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('penambahan.destroy', $data->penambahan_kas_id) }}" 
                                          method="POST" 
                                          class="inline-block" 
                                          onsubmit="return confirm(`Detail Penghapusan:

ID: {{ $data->penambahan_kas_id }}
Outlet: {{ $data->outlet->outlet_name }}
Operator: {{ $data->creator->username }}
Tanggal: {{ $data->date->format('d/m/Y') }}
Nominal: Rp {{ number_format($data->nominal, 0, ',', '.') }}
Keterangan: {{ $data->keterangan ?: '-' }}

Apakah Anda yakin ingin menghapus data ini?`)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data penambahan untuk hari ini.
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
@endsection

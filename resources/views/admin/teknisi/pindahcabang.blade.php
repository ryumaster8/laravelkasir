@extends('layouts.layout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center">
            <div class="w-full md:w-4/5">
                <x-flash-message/>
                <div class="bg-white rounded-lg shadow-md">
                    <div class="border-b border-gray-200 p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Pindah Cabang Teknisi</h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('teknisi.pindahcabang.proses', $teknisi->teknisi_id) }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="outlet_asal" class="block text-sm font-medium text-gray-700 mb-2">Outlet Asal</label>
                                <input type="text" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-100" 
                                    id="outlet_asal" 
                                    name="outlet_asal"
                                    value="{{ old('outlet_asal', $teknisi->outlet->outlet_name) }}" 
                                    readonly>
                            </div>
                            <div class="mb-6">
                                <label for="nama_teknisi" class="block text-sm font-medium text-gray-700 mb-2">Nama Teknisi</label>
                                <input type="text" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-100" 
                                    id="nama_teknisi" 
                                    name="nama_teknisi"
                                    value="{{ old('nama_teknisi', $teknisi->nama_teknisi) }}" 
                                    readonly>
                            </div>
                            <div class="mb-6">
                                <label for="outlet_tujuan" class="block text-sm font-medium text-gray-700 mb-2">Pilih Outlet Tujuan</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    id="outlet_tujuan" 
                                    name="outlet_tujuan" 
                                    required>
                                    <option value="" selected disabled>Pilih Outlet Tujuan</option>
                                    @foreach($outlets as $outlet)
                                        <option value="{{ $outlet->outlet_id }}" {{ old('outlet_tujuan') == $outlet->outlet_id ? 'selected' : '' }}>
                                            {{ $outlet->outlet_name }} ({{ $outlet->status }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('outlet_tujuan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="border-t border-gray-200 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Pindah
                                </button>
                                <a href="/teknisi" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 ml-3">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
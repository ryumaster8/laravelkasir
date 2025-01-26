@extends('layouts.layout')

@section('title', 'Edit Kas Akhir')

@section('content')
<div class="flex justify-center mt-8">
    <div class="w-11/12 lg:w-3/4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-red-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Edit Kas Akhir</h3>
            </div>

            <div class="p-6">
                <form action="{{ route('update.kas_akhir', $kasAkhir->kas_akhir_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="nominal" class="block text-sm font-medium text-gray-700 mb-2">
                                Nominal Kas Akhir
                            </label>
                            <input type="number" 
                                id="nominal" 
                                name="nominal" 
                                value="{{ old('nominal', $kasAkhir->nominal) }}"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out @error('nominal') border-red-500 @enderror"
                                required>
                            @error('nominal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                                Keterangan
                            </label>
                            <textarea 
                                id="keterangan" 
                                name="keterangan" 
                                rows="3"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out">{{ old('keterangan', $kasAkhir->keterangan) }}</textarea>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit"
                                class="px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('kas-akhir') }}"
                                class="px-6 py-2.5 bg-gray-500 text-white text-sm font-semibold rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

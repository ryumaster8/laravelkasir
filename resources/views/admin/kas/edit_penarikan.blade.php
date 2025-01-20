@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800">Edit Penarikan Kas</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('penarikan.update', $penarikan->cash_register_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Outlet</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50" value="{{ $outletName }}" disabled>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Operator</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50" value="{{ $operatorName }}" disabled>
                        </div>

                        <div>
                            <label for="total_paid_out" class="block text-sm font-medium text-gray-700">Jumlah Penarikan</label>
                            <input type="number" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('total_paid_out') border-red-500 @enderror" 
                                   id="total_paid_out" 
                                   name="total_paid_out" 
                                   value="{{ old('total_paid_out', $penarikan->total_paid_out) }}" 
                                   required>
                            @error('total_paid_out')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('keterangan') border-red-500 @enderror" 
                                      id="keterangan" 
                                      name="keterangan" 
                                      rows="3">{{ old('keterangan', $penarikan->description) }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex space-x-3">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Update Penarikan
                            </button>
                            <a href="{{ route('penarikan') }}" 
                               class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

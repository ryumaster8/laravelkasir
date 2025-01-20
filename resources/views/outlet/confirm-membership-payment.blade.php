@extends('layouts.layout')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Konfirmasi Pembayaran Perubahan Membership</h2>

            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="font-medium mb-2">Detail Permintaan:</h3>
                <p>Jenis: {{ $request->change_type === 'upgrade' ? 'Upgrade' : 'Downgrade' }}</p>
                <p>Paket Baru: {{ $request->requestedMembership->membership_name }}</p>
                <p>Total Biaya: Rp {{ number_format($request->change_fee, 0, ',', '.') }}</p>
            </div>

            <div class="mb-6">
                <h3 class="font-medium mb-2">Silakan Transfer ke:</h3>
                @foreach($rekeningList as $rekening)
                    <div class="p-4 {{ $rekening->is_default ? 'bg-blue-50 border-blue-200' : 'bg-gray-50' }} rounded-lg mb-3">
                        <p class="font-bold">{{ $rekening->bank_name }}</p>
                        <p class="text-lg">{{ $rekening->account_number }}</p>
                        <p>a.n {{ $rekening->account_name }}</p>
                        @if($rekening->is_default)
                            <span class="inline-block mt-2 text-sm text-blue-600">Rekening Utama</span>
                        @endif
                    </div>
                @endforeach
            </div>

            <form action="{{ route('membership.confirm-payment', $request->request_id) }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Bukti Transfer
                    </label>
                    <input type="file" 
                           name="payment_proof" 
                           accept="image/*"
                           required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <p class="mt-1 text-sm text-gray-500">
                        Upload bukti transfer dalam format gambar (JPG, PNG)
                    </p>
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

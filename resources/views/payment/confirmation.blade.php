@extends('layouts.layout')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Konfirmasi Pembayaran</h2>

            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('payment.confirm', $membershipRequest->request_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded-md">
                        <span class="text-lg font-semibold">Rp {{ number_format($membershipRequest->change_fee, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div>
                    <label for="bank_name" class="block text-sm font-medium text-gray-700">Bank Pengirim</label>
                    <input type="text" name="bank_name" id="bank_name" required 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('bank_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="method_transfer" class="block text-sm font-medium text-gray-700">Metode Transfer</label>
                    <select name="method_transfer" id="method_transfer" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="internet_banking">Internet Banking</option>
                        <option value="mobile_banking">Mobile Banking</option>
                        <option value="atm">ATM</option>
                        <option value="counter">Counter Bank</option>
                    </select>
                    @error('method_transfer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="account_name" class="block text-sm font-medium text-gray-700">Nama Pemilik Rekening</label>
                    <input type="text" name="account_name" id="account_name" required 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('account_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="account_number" class="block text-sm font-medium text-gray-700">Nomor Rekening</label>
                    <input type="text" name="account_number" id="account_number" required 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('account_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bukti_transfer" class="block text-sm font-medium text-gray-700">Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" id="bukti_transfer" required accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, atau PDF. Maksimal 2MB</p>
                    @error('bukti_transfer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Kirim Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

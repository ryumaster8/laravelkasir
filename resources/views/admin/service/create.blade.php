@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Data Service</h1>

        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Faktur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Faktur</label>
                    <input type="text" name="faktur" value="{{ $faktur }}" readonly 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100">
                </div>

                <!-- Tanggal Masuk -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="{{ date('Y-m-d') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Teknisi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teknisi</label>
                    <select name="teknisi" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Teknisi</option>
                        @foreach($teknisi as $t)
                            <option value="{{ $t->teknisi_id }}">{{ $t->nama_teknisi }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Pelanggan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Nama Perangkat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Perangkat</label>
                    <input type="text" name="nama_perangkat" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Tipe Perangkat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Perangkat</label>
                    <select name="tipe_perangkat" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Tipe</option>
                        <option value="Handphone">Handphone</option>
                        <option value="Laptop">Laptop</option>
                        <option value="PC">PC</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Serial Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Serial Number</label>
                    <input type="text" name="serial_number" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Keluhan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keluhan</label>
                    <textarea name="keluhan" required rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <!-- Kelengkapan Perangkat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelengkapan Perangkat</label>
                    <textarea name="kelengkapan_perangkat" required rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <!-- Kerusakan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kerusakan</label>
                    <textarea name="kerusakan" rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <!-- Estimasi Penyelesaian -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Penyelesaian</label>
                    <input type="date" name="estimasi_penyelesaian"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Biaya -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Biaya</label>
                    <input type="number" name="biaya" required min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Status Pembayaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
                    <select name="pembayaran" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="Belum Lunas">Belum Lunas</option>
                        <option value="Uang Muka">Uang Muka</option>
                        <option value="Lunas">Lunas</option>
                    </select>
                </div>

                <!-- Uang Muka -->
                <div id="uangMukaContainer" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Uang Muka</label>
                    <input type="number" name="uang_muka" id="uangMuka" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Sisa Pembayaran -->
                <div id="sisaPembayaranContainer" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sisa Pembayaran</label>
                    <input type="number" id="sisaPembayaran" readonly
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100">
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex items-center justify-end space-x-3">
                <a href="{{ route('services.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusPembayaran = document.querySelector('select[name="pembayaran"]');
    const uangMukaContainer = document.getElementById('uangMukaContainer');
    const sisaPembayaranContainer = document.getElementById('sisaPembayaranContainer');
    const biayaInput = document.querySelector('input[name="biaya"]');
    const uangMukaInput = document.getElementById('uangMuka');
    const sisaPembayaranInput = document.getElementById('sisaPembayaran');

    function updatePaymentFields() {
        const selectedStatus = statusPembayaran.value;
        
        // Reset fields
        uangMukaContainer.classList.add('hidden');
        sisaPembayaranContainer.classList.add('hidden');
        uangMukaInput.value = '';
        sisaPembayaranInput.value = '';

        // Show/hide fields based on payment status
        if (selectedStatus === 'Uang Muka') {
            uangMukaContainer.classList.remove('hidden');
            sisaPembayaranContainer.classList.remove('hidden');
        }
    }

    function calculateSisaPembayaran() {
        const biaya = parseFloat(biayaInput.value) || 0;
        const uangMuka = parseFloat(uangMukaInput.value) || 0;
        
        if (statusPembayaran.value === 'Uang Muka') {
            const sisa = biaya - uangMuka;
            sisaPembayaranInput.value = sisa >= 0 ? sisa : 0;
        }
    }

    // Event listeners
    statusPembayaran.addEventListener('change', updatePaymentFields);
    biayaInput.addEventListener('input', calculateSisaPembayaran);
    uangMukaInput.addEventListener('input', calculateSisaPembayaran);

    // Initial setup
    updatePaymentFields();
});
</script>

@if ($errors->any())
<div class="fixed bottom-0 right-0 m-6">
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
        <p class="font-bold">Validation Error</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

@endsection

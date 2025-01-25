@extends('layouts.layout')

@section('title', 'Pindah Unit Produk')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gray-50/75 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Ajukan Pemindahan Unit</h3>
            <div class="text-gray-500">
                <span class="font-medium">Produk:</span> {{ $product->product_id }} - <span class="font-medium">{{ $product->product_name }}</span>
            </div>
        </div>
        <div class="p-6 space-y-6">
            <x-flash-message />
            <form action="{{ route('self-products.store-transfer-unit', $product->product_id) }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="p-4 bg-gray-50 rounded-md border border-gray-200">
                        <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Produk ID</label>
                        <input type="text" class="w-full h-10 bg-gray-100 rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-gray-600 text-base px-3" id="product_id" name="product_id" value="{{ $product->product_id }}" readonly>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-md border border-gray-200">
                        <label for="operator" class="block text-sm font-medium text-gray-700 mb-1">Operator</label>
                        <input type="text" class="w-full h-10 bg-gray-100 rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-gray-600 text-base px-3" id="operator" name="operator" value="{{ $user->username }}" readonly>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-md border border-gray-200">
                        <label for="outlet" class="block text-sm font-medium text-gray-700 mb-1">Outlet</label>
                        <input type="text" class="w-full h-10 bg-gray-100 rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-gray-600 text-base px-3" id="outlet" name="outlet" value="{{ $user->outlet ? $user->outlet->outlet_name : 'Tidak ada outlet' }}" readonly>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-md border border-gray-200">
                        <label for="to_outlet_id" class="block text-sm font-medium text-gray-700 mb-1">Outlet Tujuan</label>
                        <div class="relative">
                            <select class="w-full h-10 bg-white rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 text-base appearance-none px-3 pr-8" id="to_outlet_id" name="to_outlet_id">
                                <option value="" disabled selected>-- Pilih Outlet --</option>
                                @foreach ($outlets as $outlet)
                                    <option value="{{ $outlet->outlet_id }}" {{ old('to_outlet_id') == $outlet->outlet_id ? 'selected' : '' }}>{{ $outlet->outlet_name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        @error('to_outlet_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50/75">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="select-all" class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2">Pilih Semua</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Nomer Serial</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($serials as $serial)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <input type="checkbox" name="selected_serials[]" value="{{ $serial->serial_id }}" class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">{{ $serial->serial_number }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-medium rounded-full 
                                            {{ $serial->status == 'available' ? 'bg-green-50 text-green-700 ring-1 ring-green-600/20' : 
                                               ($serial->status == 'sold' ? 'bg-red-50 text-red-700 ring-1 ring-red-600/20' : 
                                               'bg-yellow-50 text-yellow-700 ring-1 ring-yellow-600/20') }}">
                                            {{ $serial->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada serial number tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('self-products') }}" 
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" id="submit-transfer" disabled 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                        Ajukan Pemindahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('select-all');
        const serialCheckboxes = document.querySelectorAll('input[name="selected_serials[]"]');
        const submitButton = document.getElementById('submit-transfer');

        // Event listener untuk checkbox pilih semua
        selectAllCheckbox.addEventListener('change', function () {
            serialCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateSubmitButtonState();
        });

        // Event listener untuk setiap checkbox serial
        serialCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectAllCheckbox();
                updateSubmitButtonState();
            });
        });

        // Fungsi untuk update checkbox pilih semua
        function updateSelectAllCheckbox() {
            const allChecked = Array.from(serialCheckboxes).every(checkbox => checkbox.checked);
            selectAllCheckbox.checked = allChecked;
        }

        // Fungsi untuk update tombol submit
        function updateSubmitButtonState() {
            const anyChecked = Array.from(serialCheckboxes).some(checkbox => checkbox.checked);
            submitButton.disabled = !anyChecked;
        }
         // Inisialisasi tombol submit saat halaman dimuat
        updateSubmitButtonState();
    });
</script>
@endsection
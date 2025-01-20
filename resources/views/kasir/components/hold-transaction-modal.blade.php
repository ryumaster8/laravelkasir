<div id="hold-transaction-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900">Tahan Transaksi</h3>
            <div class="mt-4">
                <label for="hold-note" class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea id="hold-note" rows="3" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Tambahkan catatan untuk transaksi ini..."></textarea>
            </div>
            <div class="mt-5 flex justify-end space-x-2">
                <button onclick="closeHoldTransactionModal()" 
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                    Batal
                </button>
                <button onclick="cart.holdTransaction()" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<div id="payment-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Pembayaran Grosir
                    </h3>
                    <div class="mt-4 space-y-4">
                        <!-- Customer Info -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-900">Info Pelanggan</h4>
                            <p class="text-sm text-gray-600" id="customer-name">{{ isset($customer) ? $customer->customer_name : '-' }}</p>
                        </div>

                        <!-- Payment Method Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                            <select id="payment-method" class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                                <option value="cash">Tunai</option>
                                <option value="qris">QRIS</option>
                                <option value="credit">Kredit</option>
                            </select>
                        </div>

                        <!-- Total Payment -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                            <div id="payment-total" class="mt-1 text-3xl font-bold text-gray-900">Rp 0</div>
                        </div>

                        <!-- Cash Section -->
                        <div id="cash-section">
                            <div>
                                <label for="payment-amount" class="block text-sm font-medium text-gray-700">Jumlah Bayar</label>
                                <input type="text" 
                                       id="payment-amount" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                       oninput="handlePaymentInput(this.value)"
                                       placeholder="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kembalian</label>
                                <div id="payment-change" class="mt-1 text-2xl font-bold text-green-600">Rp 0</div>
                            </div>
                        </div>

                        <!-- Credit Section -->
                        <div id="credit-section" class="hidden">
                            <div>
                                <label for="due-date" class="block text-sm font-medium text-gray-700">Jatuh Tempo</label>
                                <input type="date" 
                                       id="due-date" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                            <div>
                                <label for="down-payment" class="block text-sm font-medium text-gray-700">Uang Muka</label>
                                <input type="text" 
                                       id="down-payment" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                                       placeholder="0">
                            </div>
                        </div>

                        <!-- QRIS Section -->
                        <div id="qris-section" class="hidden">
                            <div>
                                <label for="qris-reference" class="block text-sm font-medium text-gray-700">Nomor Referensi QRIS</label>
                                <input type="text" 
                                       id="qris-reference" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                                       placeholder="Masukkan nomor referensi">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" 
                        onclick="processPayment()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Proses Pembayaran
                </button>
                <button type="button" 
                        onclick="closePaymentModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Gunakan fungsi yang sama dengan modal ecer
function handlePaymentInput(value) {
    // Hapus karakter non-numerik dan konversi ke number
    const paymentAmount = parseFloat(value.replace(/[^\d]/g, '')) || 0;
    
    // Ambil total dari display total
    const totalStr = document.getElementById('payment-total').textContent;
    const total = parseFloat(totalStr.replace(/[^\d]/g, '')) || 0;
    
    // Hitung kembalian
    const change = paymentAmount - total;
    
    // Update display kembalian
    document.getElementById('payment-change').textContent = formatRupiah(Math.max(0, change));
    
    // Update status tombol pembayaran
    const payButton = document.querySelector('button[onclick="processPayment()"]');
    if (payButton) {
        payButton.disabled = paymentAmount < total;
        payButton.classList.toggle('opacity-50', paymentAmount < total);
    }

    // Untuk modal grosir, jika metode pembayaran kredit
    const paymentMethod = document.getElementById('payment-method').value;
    if (paymentMethod === 'credit') {
        const downPayment = document.getElementById('down-payment');
        if (downPayment) {
            downPayment.value = formatRupiah(paymentAmount);
        }
    }
}

// Tambahkan event listener untuk perubahan metode pembayaran
document.addEventListener('DOMContentLoaded', function() {
    // ... existing event listeners ...
    const paymentMethodSelect = document.getElementById('payment-method');
    if (paymentMethodSelect) {
        paymentMethodSelect.addEventListener('change', function(e) {
            const cashSection = document.getElementById('cash-section');
            const creditSection = document.getElementById('credit-section');
            const qrisSection = document.getElementById('qris-section');
            
            // Sembunyikan semua section dulu
            [cashSection, creditSection, qrisSection].forEach(section => {
                if (section) section.classList.add('hidden');
            });
            
            // Tampilkan section yang sesuai
            switch(e.target.value) {
                case 'cash':
                    if (cashSection) cashSection.classList.remove('hidden');
                    break;
                case 'credit':
                    if (creditSection) creditSection.classList.remove('hidden');
                    break;
                case 'qris':
                    if (qrisSection) qrisSection.classList.remove('hidden');
                    break;
            }
        });
    }
});
</script>

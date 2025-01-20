<div id="payment-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Pembayaran
                    </h3>
                    <div class="mt-4 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                            <div id="payment-total" class="mt-1 text-3xl font-bold text-gray-900">Rp 0</div>
                        </div>
                        <div>
                            <label for="payment-amount" class="block text-sm font-medium text-gray-700">Jumlah Bayar</label>
                            <input type="text" 
                                   id="payment-amount" 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   oninput="calculateChange(this.value)"
                                   placeholder="0">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kembalian</label>
                            <div id="payment-change" class="mt-1 text-2xl font-bold text-green-600">Rp 0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" 
                        onclick="processPayment()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Proses Pembayaran
                </button>
                <button type="button" 
                        onclick="closePaymentModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize the modal functions
document.addEventListener('DOMContentLoaded', function() {
    const paymentAmount = document.getElementById('payment-amount');
    if(paymentAmount) {
        paymentAmount.addEventListener('input', function(e) {
            calculateChange(this.value);
        });
    }
});

function calculateChange(value) {
    // Convert input string to number, remove non-numeric characters
    const amount = parseFloat(value.replace(/[^\d]/g, '')) || 0;
    
    // Get total from cart
    const subtotal = cart.items.reduce((sum, item) => sum + item.subtotal, 0);
    const ppn = subtotal * ({{$pajak}} / 100);
    const total = subtotal + ppn;
    
    // Calculate change
    const change = amount - total;
    
    // Update change display
    const changeElement = document.getElementById('payment-change');
    if(changeElement) {
        changeElement.textContent = formatRupiah(Math.max(0, change));
    }
    
    // Enable/disable payment button based on sufficient payment
    const paymentButton = document.querySelector('button[onclick="processPayment()"]');
    if(paymentButton) {
        paymentButton.disabled = amount < total;
        paymentButton.classList.toggle('opacity-50', amount < total);
    }
}

function showPaymentModal() {
    const modal = document.getElementById('payment-modal');
    const totalElement = document.getElementById('payment-total');
    const amountInput = document.getElementById('payment-amount');
    const changeElement = document.getElementById('payment-change');
    
    if (!modal || !totalElement || !amountInput || !changeElement) {
        console.error('Payment modal elements not found');
        return;
    }
    
    const subtotal = cart.items.reduce((sum, item) => sum + item.subtotal, 0);
    const ppn = subtotal * ({{$pajak}} / 100);
    const total = subtotal + ppn;

    totalElement.textContent = formatRupiah(total);
    amountInput.value = '';
    changeElement.textContent = 'Rp 0';
    
    modal.classList.remove('hidden');
    setTimeout(() => amountInput.focus(), 100);
}

function closePaymentModal() {
    const modal = document.getElementById('payment-modal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

document.getElementById('payment-method').addEventListener('change', function(e) {
    const cashSection = document.getElementById('cash-section');
    const qrisSection = document.getElementById('qris-section');
    
    if (e.target.value === 'cash') {
        cashSection.classList.remove('hidden');
        qrisSection.classList.add('hidden');
    } else {
        cashSection.classList.add('hidden');
        qrisSection.classList.remove('hidden');
    }
});

async function processPayment() {
    try {
        const paymentMethod = document.getElementById('payment-method').value;
        const total = cart.getTotal();
        
        let paymentData = {
            payment_method: paymentMethod,
            total_amount: total,
            items: cart.items
        };

        if (paymentMethod === 'cash') {
            const cashAmount = parseFloat(document.getElementById('payment-amount').value);
            if (cashAmount < total) {
                alert('Jumlah pembayaran kurang dari total!');
                return;
            }
            paymentData.payment_amount = cashAmount;
        } else if (paymentMethod === 'qris') {
            const reference = document.getElementById('qris-reference').value;
            if (!reference) {
                alert('Masukkan nomor referensi QRIS!');
                return;
            }
            paymentData.reference_number = reference;
            paymentData.payment_amount = total;
        }

        const response = await fetch('/kasir/process-payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(paymentData)
        });

        const result = await response.json();

        if (result.success) {
            cart.clearCart();
            closePaymentModal();
            window.open(result.receipt_url, '_blank');
            alert('Pembayaran berhasil!');
        } else {
            throw new Error(result.message || 'Pembayaran gagal');
        }
    } catch (error) {
        console.error('Payment Error:', error);
        alert(error.message || 'Terjadi kesalahan saat memproses pembayaran');
    }
}
</script>

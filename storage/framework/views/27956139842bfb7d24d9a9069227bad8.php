<div id="guide-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-4/5 max-w-4xl shadow-lg rounded-md bg-white min-h-[80vh]">
        <!-- Header -->
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-2xl font-bold text-gray-900">Panduan Penggunaan Kasir</h3>
            <button onclick="closeGuideModal()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Search Bar -->
        <div class="my-4">
            <div class="relative">
                <input type="text" 
                       id="guide-search" 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Cari panduan...">
                <svg class="w-5 h-5 text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Content -->
        <div class="mt-4 h-[calc(80vh-12rem)] overflow-y-auto">
            <div class="space-y-6 guide-content">
                <!-- Pengenalan -->
                <section class="guide-section" data-keywords="pengenalan,kasir,fitur">
                    <h4 class="text-xl font-semibold text-gray-800 mb-3">Pengenalan</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem kasir ini dirancang untuk memudahkan proses transaksi penjualan baik secara ecer maupun grosir.
                    </p>
                </section>

                <!-- Shortcut -->
                <section class="guide-section" data-keywords="shortcut,keyboard,hotkey">
                    <h4 class="text-xl font-semibold text-gray-800 mb-3">Shortcut Keyboard</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <span class="font-medium">Alt + H</span>
                            <p class="text-sm text-gray-600">Kembali ke Home</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <span class="font-medium">Alt + F</span>
                            <p class="text-sm text-gray-600">Fokus ke Pencarian</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <span class="font-medium">Alt + B</span>
                            <p class="text-sm text-gray-600">Proses Pembayaran</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <span class="font-medium">Alt + T</span>
                            <p class="text-sm text-gray-600">Tahan Transaksi</p>
                        </div>
                    </div>
                </section>

                <!-- Scan Barcode -->
                <section class="guide-section" data-keywords="barcode,scan,produk">
                    <h4 class="text-xl font-semibold text-gray-800 mb-3">Scan Barcode</h4>
                    <p class="text-gray-600 leading-relaxed">
                        1. Fokuskan kursor pada input barcode<br>
                        2. Scan barcode produk menggunakan scanner<br>
                        3. Produk akan otomatis ditambahkan ke keranjang<br>
                        4. Untuk produk dengan serial number, sistem akan memvalidasi ketersediaan
                    </p>
                </section>

                <!-- Pencarian Produk -->
                <section class="guide-section" data-keywords="cari,search,produk">
                    <h4 class="text-xl font-semibold text-gray-800 mb-3">Pencarian Produk</h4>
                    <p class="text-gray-600 leading-relaxed">
                        1. Klik kolom pencarian atau tekan Alt + F<br>
                        2. Ketik nama atau kode produk<br>
                        3. Pilih produk dari hasil pencarian<br>
                        4. Produk akan ditambahkan ke keranjang
                    </p>
                </section>

                <!-- Pembayaran -->
                <section class="guide-section" data-keywords="bayar,payment,transaksi">
                    <h4 class="text-xl font-semibold text-gray-800 mb-3">Proses Pembayaran</h4>
                    <p class="text-gray-600 leading-relaxed">
                        1. Pastikan semua item sudah benar<br>
                        2. Tekan tombol "Proses Pembayaran" atau Alt + B<br>
                        3. Pilih metode pembayaran<br>
                        4. Masukkan jumlah yang dibayarkan<br>
                        5. Selesaikan transaksi
                    </p>
                </section>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-6 pt-3 border-t">
            <p class="text-sm text-gray-500">
                Untuk bantuan lebih lanjut, silakan hubungi supervisor Anda.
            </p>
        </div>
    </div>
</div>

<script>
function showGuideModal() {
    document.getElementById('guide-modal').classList.remove('hidden');
}

function closeGuideModal() {
    document.getElementById('guide-modal').classList.add('hidden');
}

// Search functionality
document.getElementById('guide-search').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const sections = document.querySelectorAll('.guide-section');
    
    sections.forEach(section => {
        const keywords = section.dataset.keywords.toLowerCase();
        const content = section.textContent.toLowerCase();
        
        if (keywords.includes(searchTerm) || content.includes(searchTerm)) {
            section.style.display = 'block';
            // Highlight matching text
            if (searchTerm.length > 0) {
                const regex = new RegExp(searchTerm, 'gi');
                section.innerHTML = section.innerHTML.replace(regex, match => `<mark class="bg-yellow-200">${match}</mark>`);
            }
        } else {
            section.style.display = 'none';
        }
    });
});

// Reset highlights when closing search
document.getElementById('guide-search').addEventListener('blur', function() {
    if (this.value.length === 0) {
        const sections = document.querySelectorAll('.guide-section');
        sections.forEach(section => {
            section.style.display = 'block';
            section.innerHTML = section.innerHTML.replace(/<mark class="bg-yellow-200">(.*?)<\/mark>/g, '$1');
        });
    }
});
</script>
<?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/kasir/components/guide-modal.blade.php ENDPATH**/ ?>
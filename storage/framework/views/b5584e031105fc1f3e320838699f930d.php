<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Kasir <?php echo e(session('type') === 'grosir' ? 'Grosir' : 'Ecer'); ?></title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <!-- Additional Styles -->
    <style>
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Search results container width */
        .search-results-container {
            width: 600px;
            max-width: 100%;
            position: relative;
        }

        @media (max-width: 640px) {
            .search-results-container {
                width: 100%;
            }
        }

        /* Big Number Display */
        .big-number {
            font-size: 3.0rem;
            font-weight: 700;
            letter-spacing: -0.05em;
            line-height: 1.2;
            text-align: right;
        }

        /* Animation classes */
        .transition-all {
            transition-property: all;
        }

        .duration-300 {
            transition-duration: 300ms;
        }

        .ease-out {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        .opacity-0 {
            opacity: 0;
        }

        .transform {
            transform-origin: center;
        }

        .translate-y-2 {
            transform: translateY(0.5rem);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header Section -->
    <header class="<?php echo e(session('type') === 'grosir' ? 'bg-green-600' : 'bg-blue-600'); ?>">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold text-white">
                        Kasir <?php echo e(session('type') === 'grosir' ? 'Grosir' : 'Ecer'); ?>

                    </h1>
                    <?php if(session('type') === 'grosir' && isset($customer)): ?>
                    <span class="px-3 py-1 bg-white text-green-800 rounded-full text-sm font-medium">
                        <?php echo e($customer->customer_name); ?>

                    </span>
                    <?php endif; ?>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right">
                        <p class="text-sm text-white/80">Kasir:</p>
                        <p class="font-medium text-white"><?php echo e(session('username')); ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-white/80">Waktu:</p>
                        <p class="font-medium text-white" id="current-time"></p>
                    </div>
                    <a href="/dashboard" class="bg-white text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-300">
                        Kembali
                    </a>
                    <!-- Add Guide Button -->
                    <button onclick="showGuideModal()" class="flex items-center space-x-2 bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Panduan</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="min-h-screen">
        <div class="p-6">
            <!-- Shortcuts Bar -->
            <div class="mb-6 bg-white rounded-lg shadow-md p-4">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex gap-4">
                        <div class="flex items-center bg-gray-100 px-4 py-2 rounded-lg">
                            <span class="text-gray-600 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </span>
                            <span class="text-sm">Home <kbd class="ml-1 px-2 py-1 text-xs bg-gray-200 rounded">Alt+Home</kbd></span>
                        </div>
                        <div class="flex items-center bg-gray-100 px-4 py-2 rounded-lg">
                            <span class="text-gray-600 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </span>
                            <span class="text-sm">Cari <kbd class="ml-1 px-2 py-1 text-xs bg-gray-200 rounded">Alt+F</kbd></span>
                        </div>
                        <div class="flex items-center bg-gray-100 px-4 py-2 rounded-lg">
                            <span class="text-gray-600 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </span>
                            <span class="text-sm">Bayar <kbd class="ml-1 px-2 py-1 text-xs bg-gray-200 rounded">Alt+B</kbd></span>
                        </div>
                        <div class="flex items-center bg-gray-100 px-4 py-2 rounded-lg">
                            <span class="text-gray-600 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </span>
                            <span class="text-sm">Hold <kbd class="ml-1 px-2 py-1 text-xs bg-gray-200 rounded">Alt+T</kbd></span>
                        </div>
                        <div class="flex items-center bg-gray-100 px-4 py-2 rounded-lg">
                            <span class="text-gray-600 mr-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                            </span>
                            <span class="text-sm">Held Trans <kbd class="ml-1 px-2 py-1 text-xs bg-gray-200 rounded">Alt+L</kbd></span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Shift: <?php echo e(session('shift') ?? 'Default'); ?></span>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Kas: Rp <?php echo e(number_format(session('kas') ?? 0, 0, ',', '.')); ?></span>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column - Main Operations Area -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
                        <!-- Barcode Scanner -->
                        <div>
                            <label for="barcode" class="block text-sm font-medium text-gray-700 mb-1">Scan Barcode</label>
                            <div class="relative">
                                <input type="text" 
                                       id="barcode" 
                                       name="barcode" 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                       placeholder="Scan atau ketik barcode produk..."
                                       autofocus>
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v-4m6 0h-2m2 0v4m-6-4h2m2 0h-2m-4 6h2m0-4h-2m2 0v4m6-4v4m-6 0v-4m6 4h-2m2 0v-4m-6 4h-2m2 0v-4"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Product Search - Moved here -->
                        <div>
                            <label for="product-search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                            <div class="search-results-container"> <!-- Tambahkan container baru -->
                                <div class="relative">
                                    <input type="text" 
                                           id="product-search" 
                                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                           placeholder="Cari nama/kode produk...">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <!-- Livesearch Results -->
                                <div id="search-results" class="absolute z-50 w-full mt-1 bg-white rounded-md shadow-lg hidden">
                                    <ul class="max-h-64 overflow-y-auto rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 custom-scrollbar">
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Cart Section -->
                        <div class="border-t pt-4">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="font-medium text-gray-900">Keranjang Belanja</h3>
                                <span class="text-sm text-gray-500"><?php echo e(session('type') === 'grosir' ? 'Grosir' : 'Ecer'); ?></span>
                            </div>
                            <div class="h-[calc(100vh-400px)] overflow-y-auto mb-4 border rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barcode</th>
                                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Disc</th>
                                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Total</th>
                                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart-items" class="bg-white divide-y divide-gray-200">
                                        <!-- Cart items will be dynamically added here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Payment -->
                <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
                    <!-- Big Total Display -->
                    <div class="border-b pb-4">
                        <div class="text-gray-600 text-sm mb-1">Total Pembayaran</div>
                        <div id="big-total" class="big-number text-blue-600">Rp 0</div>
                    </div>
                    
                    <!-- Payment Details -->
                    <div class="pt-4">
                        <h3 class="font-medium text-gray-900 mb-4">Detail Pembayaran</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Subtotal</span>
                                <span id="subtotal" class="font-medium text-lg">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">PPN (<?php echo e($pajak); ?>%)</span>
                                <span id="ppn" class="font-medium text-lg">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t">
                                <span class="text-gray-900 font-bold text-lg">Total</span>
                                <span id="total" class="font-bold text-xl text-blue-600">Rp 0</span>
                            </div>
                            
                            <button id="checkout-button" class="w-full bg-blue-600 text-white py-4 rounded-lg mt-6 hover:bg-blue-700 transition duration-300 text-lg font-medium">
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Components -->
    <?php if(session('type') === 'grosir'): ?>
        <?php echo $__env->make('kasir.components.payment-modal-grosir', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('kasir.components.payment-modal-ecer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('kasir.components.hold-transaction-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('kasir.components.held-transactions-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('kasir.components.guide-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Inisialisasi semua DOM elements di awal script
        const barcodeInput = document.getElementById('barcode');
        const productSearch = document.getElementById('product-search');
        const searchResults = document.getElementById('search-results');

        // Update time function
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
        }

        // Update time every second
        updateTime();
        setInterval(updateTime, 1000);

        // Single event handler initialization function to avoid duplicates
        function initializeEventHandlers() {
            const barcodeInput = document.getElementById('barcode');
            const productSearch = document.getElementById('product-search');
            const searchResults = document.getElementById('search-results');

            // Remove any existing event listeners first
            barcodeInput.removeEventListener('keypress', handleBarcodeKeypress);
            productSearch.removeEventListener('input', handleProductSearch);
            productSearch.removeEventListener('focus', handleProductSearchFocus);
            document.removeEventListener('click', handleOutsideClick);
            document.removeEventListener('keydown', handleKeyboardShortcuts);

            // Add event listeners
            barcodeInput.addEventListener('keypress', handleBarcodeKeypress);
            productSearch.addEventListener('input', (e) => debounce(handleProductSearch(e.target.value), 300));
            productSearch.addEventListener('focus', handleProductSearchFocus);
            document.addEventListener('click', handleOutsideClick);
            document.addEventListener('keydown', handleKeyboardShortcuts);

            // Auto focus barcode input
            barcodeInput.focus();
        }

        // Call initialization on page load
        document.addEventListener('DOMContentLoaded', initializeEventHandlers);

        // Define handlers separately to avoid duplicate declarations
        async function handleBarcodeKeypress(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const barcode = this.value.trim();
                // ... existing barcode processing code ...
                if (!barcode) return;
                
                console.group('🔍 Barcode Scan Process');
                console.log('📝 Scanned barcode:', barcode);
                
                try {
                    const url = `/kasir/get-product-by-barcode/${encodeURIComponent(barcode)}`;
                    console.log('🌐 Fetching URL:', url);
                    
                    const response = await fetch(url);
                    console.log('📡 Response status:', response.status);
                    
                    const data = await response.json();
                    console.log('📦 Response data:', data);
                    
                    if (response.ok && !data.error) {
                        console.log('✅ Product found:', {
                            id: data.product_id,
                            name: data.product_name,
                            hasSerial: data.has_serial,
                            price: data.price,
                            stock: data.stock
                        });
                        
                        if (data.has_serial) {
                            console.log('🔢 Checking serial number...');
                            if (data.serials && data.serials.includes(barcode)) {
                                console.log('✅ Adding serial product to cart');
                                cart.addSerialItem({
                                    ...data,
                                    selected_serial: barcode
                                });
                            } else {
                                console.warn('❌ Invalid serial number');
                                alert('Serial number tidak ditemukan atau sudah digunakan!');
                            }
                        } else {
                            console.log('📦 Adding regular product to cart');
                            cart.addItem(data);
                        }
                    } else {
                        console.error('❌ Error:', data.error || 'Product not found');
                        alert(data.error || 'Produk tidak ditemukan!');
                    }
                } catch (error) {
                    console.error('💥 Error:', error);
                    alert('Terjadi kesalahan saat memproses barcode');
                }
                
                console.groupEnd();
                this.value = '';
                this.focus();
            }
        }

        async function handleProductSearch(value) {
            if (value.length < 2) {
                document.getElementById('search-results').classList.add('hidden');
                return;
            }
            // ... existing search code ...
            try {
                console.log('Searching for:', value);
                
                const response = await fetch(`/kasir/search-products?term=${value}`);
                console.log('Search Response Status:', response.status);
                
                const data = await response.json();
                console.log('Search Response Data:', data);

                if (!response.ok) {
                    throw new Error(data.error || 'Unknown error occurred');
                }
                
                if (Array.isArray(data) && data.length > 0) {
                    console.log(`Found ${data.length} products`);
                    const html = data.map(product => {
                        console.log('Processing product:', product);
                        
                        // Jika produk memiliki serial, tampilkan setiap serial dalam baris terpisah
                        if (product.has_serial && product.serials.length > 0) {
                            return product.serials.map(serial => `
                                <li class="hover:bg-gray-100 cursor-pointer px-4 py-2" 
                                    onclick="selectProduct(${JSON.stringify({
                                        ...product,
                                        selected_serial: serial
                                    }).replace(/"/g, '&quot;')})">
                                    <div class="flex justify-between items-center">
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">${product.product_name}</p>
                                            <p class="text-sm text-gray-500">Kode: ${product.product_code}</p>
                                            <p class="text-xs text-blue-600">Serial: ${serial}</p>
                                        </div>
                                        <div class="text-right ml-4">
                                            <p class="text-sm font-medium text-gray-900">${formatRupiah(product.price)}</p>
                                            <p class="text-xs text-gray-500">Stok: 1 ${product.unit}</p>
                                        </div>
                                    </div>
                                </li>
                            `).join('');
                        } else {
                            // Tampilan untuk produk non-serial tetap sama
                            return `
                                <li class="hover:bg-gray-100 cursor-pointer px-4 py-2" 
                                    onclick="selectProduct(${JSON.stringify(product).replace(/"/g, '&quot;')})">
                                    <div class="flex justify-between items-center">
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">${product.product_name}</p>
                                            <p class="text-sm text-gray-500">Kode: ${product.product_code}</p>
                                        </div>
                                        <div class="text-right ml-4">
                                            <p class="text-sm font-medium text-gray-900">${formatRupiah(product.price)}</p>
                                            <p class="text-xs text-gray-500">Stok: ${product.stock} ${product.unit}</p>
                                        </div>
                                    </div>
                                </li>
                            `;
                        }
                    }).join('');
                    
                    searchResults.querySelector('ul').innerHTML = html;
                    searchResults.classList.remove('hidden');
                } else {
                    console.log('No products found');
                    searchResults.querySelector('ul').innerHTML = '<li class="px-4 py-2 text-sm text-gray-500">Tidak ada produk ditemukan</li>';
                    searchResults.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Search Error:', error);
                console.error('Error Stack:', error.stack);
                searchResults.querySelector('ul').innerHTML = `
                    <li class="px-4 py-2">
                        <p class="text-sm text-red-500">Terjadi kesalahan saat mencari produk</p>
                        <p class="text-xs text-gray-500">${error.message}</p>
                    </li>
                `;
                searchResults.classList.remove('hidden');
            }
        }

        function handleProductSearchFocus() {
            const searchInput = document.getElementById('product-search');
            if (searchInput.value.length >= 2) {
                document.getElementById('search-results').classList.remove('hidden');
            }
        }

        function handleOutsideClick(e) {
            const searchResults = document.getElementById('search-results');
            const productSearch = document.getElementById('product-search');
            if (!productSearch.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.classList.add('hidden');
            }
        }

        // Modifikasi fungsi formatRupiah
        function formatRupiah(angka) {
            // Memastikan angka adalah number dan bukan string
            const number = Number(angka);
            
            // Format angka dengan pemisah ribuan dan tanpa desimal
            const formatted = new Intl.NumberFormat('id-ID', {
                style: 'decimal',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number);
            
            // Tambahkan 'Rp ' di depan
            return 'Rp ' + formatted;
        }

        // Gunakan fungsi yang sama untuk total besar
        function formatRupiahTotal(angka) {
            return formatRupiah(angka);
        }

        const debounce = (func, wait) => {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        };

        // Cart management
        const cart = {
            items: [], // Ensure items is initialized as empty array
            
            addItem(product, quantity = 1) {
                console.group('🛒 Cart.addItem');
                console.log('Adding product:', product);
                console.log('Current quantity:', quantity);
                console.log('Current cart items:', this.items);
                
                const existingItem = this.items.find(item => item.product_id === product.product_id);
                
                if (existingItem) {
                    console.log('Found existing item:', existingItem);
                    if (existingItem.quantity + quantity <= product.stock) {
                        existingItem.quantity += quantity;
                        existingItem.subtotal = existingItem.quantity * existingItem.price;
                        console.log('Updated existing item:', existingItem);
                    } else {
                        console.warn('Insufficient stock');
                        alert('Stok tidak mencukupi!');
                        console.groupEnd();
                        return false;
                    }
                } else {
                    console.log('Adding new item');
                    if (quantity <= product.stock) {
                        const newItem = {
                            product_id: product.product_id,
                            product_name: product.product_name,
                            product_code: product.product_code,
                            price: product.price,
                            quantity: quantity,
                            subtotal: product.price * quantity,
                            has_serial: product.has_serial,
                            selected_serials: [],
                            stock: product.stock
                        };
                        console.log('New item to be added:', newItem);
                        this.items.push(newItem);
                    } else {
                        console.warn('Insufficient stock for new item');
                        alert('Stok tidak mencukupi!');
                        console.groupEnd();
                        return false;
                    }
                }
                
                console.log('Updating cart...');
                this.updateCart();
                console.log('Final cart items:', this.items);
                console.groupEnd();
                return true;
            },
            
            addSerialItem(product) {
                console.group('🛒 Cart.addSerialItem');
                console.log('Adding serial product:', product);
                
                // Check if serial already exists in cart
                const serialExists = this.items.some(item => 
                    item.has_serial && item.selected_serial === product.selected_serial
                );
                
                if (serialExists) {
                    console.warn('Serial already in cart');
                    alert('Serial number ini sudah ada di keranjang!');
                    console.groupEnd();
                    return false;
                }
                
                // Add new serial item
                const newItem = {
                    product_id: product.product_id,
                    product_name: product.product_name,
                    product_code: product.product_code,
                    price: product.price,
                    quantity: 1, // Serial products always have quantity 1
                    subtotal: product.price,
                    has_serial: true,
                    selected_serial: product.selected_serial,
                    stock: 1 // Serial products always have stock 1
                };
                
                console.log('New serial item to be added:', newItem);
                this.items.push(newItem);
                this.updateCart();
                
                console.groupEnd();
                return true;
            },
            
            removeItem(productId) {
                const index = this.items.findIndex(item => item.product_id === productId);
                if (index > -1) {
                    this.items.splice(index, 1);
                    this.updateCart();
                }
            },
            
            updateQuantity(productId, newQuantity) {
                const item = this.items.find(item => item.product_id === productId);
                if (item) {
                    // Verify stock availability first
                    fetch(`/kasir/get-product/${productId}`)
                        .then(response => response.json())
                        .then(product => {
                            if (newQuantity <= product.stock) {
                                item.quantity = newQuantity;
                                item.subtotal = item.quantity * item.price;
                                this.updateCart();
                            } else {
                                alert('Stok tidak mencukupi!');
                            }
                        });
                }
            },
            
            updateCart() {
                if (!Array.isArray(this.items)) {
                    this.items = [];
                }
                
                // First render cart items
                this.renderCart();
                
                // Calculate totals after all discounts are fetched
                Promise.all(this.items.map(item => 
                    fetch(`/kasir/get-discount/${item.product_id}`)
                        .then(response => response.json())
                        .then(discountInfo => {
                            const discount = discountInfo.discount_type === 'percentage' 
                                ? (item.price * (discountInfo.value / 100)) 
                                : discountInfo.discount;
                            return (item.price - discount) * item.quantity;
                        })
                )).then(subtotals => {
                    const subtotal = subtotals.reduce((sum, val) => sum + val, 0);
                    const ppn = subtotal * (<?php echo e($pajak); ?> / 100);
                    const total = subtotal + ppn;
                    
                    // Update totals with animation
                    animateNumber('subtotal', subtotal);
                    animateNumber('ppn', ppn);
                    animateNumber('total', total);
                    animateNumber('big-total', total);
                });
            },
            
            renderCart() {
                const tbody = document.querySelector('#cart-items');
                let promises = this.items.map(item => {
                    return new Promise((resolve) => {
                        let tr = tbody.querySelector(`[data-product-id="${item.product_id}"]`);
                        let isNewRow = false;
                        
                        if (!tr) {
                            tr = document.createElement('tr');
                            tr.setAttribute('data-product-id', item.product_id);
                            isNewRow = true;
                        }

                        fetch(`/kasir/get-discount/${item.product_id}`)
                            .then(response => response.json())
                            .then(discountInfo => {
                                const discount = discountInfo.discount_type === 'percentage' 
                                    ? (item.price * (discountInfo.value / 100))
                                    : discountInfo.discount;
                                    
                                const discountDisplay = discountInfo.discount_type === 'percentage' 
                                    ? `${discountInfo.value}%` 
                                    : (discountInfo.discount > 0 ? formatRupiah(discountInfo.discount) : '-');
                                
                                const priceAfterDiscount = item.price - discount;
                                const subtotal = priceAfterDiscount * item.quantity;
                                
                                // Update item subtotal
                                item.subtotal = subtotal;

                                // Update row content
                                tr.innerHTML = `
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-medium text-gray-900">${item.product_name}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-gray-500">${item.has_serial ? item.selected_serial : item.product_code}</div>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="text-sm text-gray-900">${formatRupiah(item.price)}</div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="text-sm text-gray-600">${item.has_serial ? '1' : item.stock}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-center items-center space-x-2">
                                            <button onclick="cart.updateQuantity(${item.product_id}, ${item.quantity - 1})" 
                                                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center"
                                                    ${item.quantity <= 1 ? 'disabled' : ''}>-</button>
                                            <input type="number" class="w-16 text-center border rounded-lg" 
                                                   value="${item.quantity}" min="1"
                                                   onchange="cart.updateQuantity(${item.product_id}, parseInt(this.value))">
                                            <button onclick="cart.updateQuantity(${item.product_id}, ${item.quantity + 1})"
                                                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center">+</button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="text-sm text-green-600">${discountDisplay}</div>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="text-sm font-medium text-gray-900">${formatRupiah(subtotal)}</div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button onclick="cart.removeItem(${item.product_id})" class="text-red-500 hover:text-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </td>
                                `;

                                if (isNewRow) {
                                    tr.classList.add('opacity-0', 'transform', 'translate-y-2');
                                    tbody.appendChild(tr);
                                    setTimeout(() => {
                                        tr.classList.remove('opacity-0', 'translate-y-2');
                                        tr.classList.add('transition-all', 'duration-300', 'ease-out');
                                    }, 50);
                                }
                                
                                resolve();
                            });
                    });
                });

                // Clean up removed items
                const currentIds = this.items.map(item => item.product_id);
                tbody.querySelectorAll('tr[data-product-id]').forEach(tr => {
                    const id = tr.getAttribute('data-product-id');
                    if (!currentIds.includes(parseInt(id))) {
                        tr.classList.add('transition-all', 'duration-300', 'ease-out');
                        tr.classList.add('opacity-0', 'transform', 'translate-y-2');
                        setTimeout(() => tr.remove(), 300);
                    }
                });
            },
            
            updateTotals() {
                const subtotal = this.items.reduce((sum, item) => sum + Number(item.subtotal || 0), 0);
                const ppn = subtotal * (<?php echo e($pajak); ?> / 100);
                const total = subtotal + ppn;

                // Animate total updates
                animateNumber('subtotal', subtotal);
                animateNumber('ppn', ppn);
                animateNumber('total', total);
                animateNumber('big-total', total);
            }
        };

        // Add this helper function for number animation
        function animateNumber(elementId, targetValue) {
            const element = document.getElementById(elementId);
            const startValue = parseFloat(element.textContent.replace(/[^0-9.-]+/g, '')) || 0;
            const duration = 300;
            const startTime = performance.now();
            
            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // Easing function for smooth animation
                const easeOutQuad = progress * (2 - progress);
                const currentValue = startValue + (targetValue - startValue) * easeOutQuad;
                
                element.textContent = formatRupiah(currentValue);
                
                if (progress < 1) {
                    requestAnimationFrame(update);
                }
            }
            
            requestAnimationFrame(update);
        }

        // Update product selection handler
        function selectProduct(product) {
            console.log('Selecting product:', product);
            if (product.has_serial && product.selected_serial) {
                cart.addSerialItem(product);
            } else {
                cart.addItem(product);
            }
            searchResults.classList.add('hidden');
            productSearch.value = '';
            barcodeInput.focus();
        }

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.altKey) {
                switch(e.key.toLowerCase()) {
                    case 't': // Changed from 'h' to 't' for Hold Transaction
                        e.preventDefault();
                        if (cart.items.length > 0) {
                            modalControls.showHoldTransactionModal();
                        } else {
                            alert('Tidak dapat menahan transaksi karena keranjang masih kosong!');
                        }
                        break;
                    case 'home': // Changed from 'h' to 'home' for Home
                        e.preventDefault();
                        window.location.href = '/dashboard';
                        break;
                    case 'l':
                        e.preventDefault();
                        showHeldTransactionsModal();
                        break;
                    case 'f':
                        e.preventDefault();
                        document.getElementById('product-search').focus();
                        break;
                    case 'b':
                        e.preventDefault();
                        // Trigger payment process
                        if (cart.items.length > 0) {
                            document.querySelector('button.bg-blue-600').click();
                        }
                        break;
                }
            }
        });

        // Add status badges update
        function updateStatusBadges() {
            // Here you can add code to update status badges periodically
            // For example, updating kas amount or shift information
        }

        // Update badges every minute
        setInterval(updateStatusBadges, 60000);

        // Add modal control functions
        function showHoldTransactionModal() {
            if (cart.items.length === 0) {
                alert('Tidak dapat menahan transaksi karena keranjang masih kosong!');
                return;
            }
            document.getElementById('hold-transaction-modal').classList.remove('hidden');
        }

        function closeHoldTransactionModal() {
            document.getElementById('hold-transaction-modal').classList.add('hidden');
        }

        document.querySelector('button.bg-blue-600').addEventListener('click', function() {
            if (cart.items.length === 0) {
                alert('Keranjang masih kosong!');
                return;
            }
            showPaymentModal();
        });

        // Add modal control functions for held transactions
        function showHeldTransactionsModal() {
            const tbody = document.querySelector('#held-transactions-list');
            const modal = document.getElementById('held-transactions-modal');
            
            modal.classList.remove('hidden');
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        <div class="flex items-center justify-center">
                            <svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading transactions...
                        </div>
                    </td>
                </tr>
            `;
            
            // Load held transactions
            fetch('/kasir/held-transactions', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json', 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'same-origin' 
            })
            .then(response => response.json())
            .then(response => {
                console.log('Held transactions response:', response); // Debug log

                if (!response.success) {
                    throw new Error(response.message || 'Failed to load transactions');
                }
                
                const transactions = response.data;
                
                if (!transactions || transactions.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada transaksi tertahan
                            </td>
                        </tr>
                    `;
                    return;
                }

                tbody.innerHTML = transactions.map(transaction => `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${transaction.id}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${new Date(transaction.created_at).toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${formatRupiah(transaction.total_amount)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${transaction.note || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <button onclick="cart.retrieveHeldTransaction(${transaction.id})" 
                                    class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Retrieve
                            </button>
                            <button onclick="deleteHeldTransaction(${transaction.id})" 
                                    class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                `).join('');
            })
            .catch(error => {
                console.error('Error loading held transactions:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-red-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Error loading transactions: ${error.message}<br>
                                <span class="text-xs mt-1">Please try again</span>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        function closeHeldTransactionsModal() {
            document.getElementById('held-transactions-modal').classList.add('hidden');
        }

        // Move modal control functions to the top level before they are used
        const modalControls = {
            showHoldTransactionModal() {
                if (cart.items.length === 0) {
                    alert('Tidak dapat menahan transaksi karena keranjang masih kosong!');
                    return;
                }
                document.getElementById('hold-transaction-modal').classList.remove('hidden');
            },
            
            closeHoldTransactionModal() {
                document.getElementById('hold-transaction-modal').classList.add('hidden');
            },
            
            showHeldTransactionsModal() {
                const tbody = document.querySelector('#held-transactions-list');
                const modal = document.getElementById('held-transactions-modal');
                
                modal.classList.remove('hidden');
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            <div class="flex items-center justify-center">
                                <svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading transactions...
                        </div>
                    </td>
                </tr>
            `;
                
                // Load held transactions
                fetch('/kasir/held-transactions', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    // ... existing held transactions handling code ...
                })
                .catch(error => {
                    console.error('Error loading held transactions:', error);
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-red-500">
                                Error loading transactions: ${error.message}
                            </td>
                        </tr>
                    `;
                });
            },
            
            closeHeldTransactionsModal() {
                document.getElementById('held-transactions-modal').classList.add('hidden');
            }
        };

        // Update keyboard shortcut handler
        function handleKeyboardShortcuts(e) {
            if (e.altKey) {
                switch(e.key.toLowerCase()) {
                    case 't': // Hold Transaction
                        e.preventDefault();
                        if (cart.items.length > 0) {
                            modalControls.showHoldTransactionModal();
                        } else {
                            alert('Tidak dapat menahan transaksi karena keranjang masih kosong!');
                        }
                        break;
                    case 'home': // Changed from 'h' to 'home' for Home
                        e.preventDefault();
                        window.location.href = '/dashboard';
                        break;
                    case 'l':
                        e.preventDefault();
                        modalControls.showHeldTransactionsModal();
                        break;
                    case 'f':
                        e.preventDefault();
                        document.getElementById('product-search').focus();
                        break;
                    case 'b':
                        e.preventDefault();
                        // Ubah cara pemanggilan showPaymentModal
                        if (cart.items.length > 0) {
                            showPaymentModal();
                        } else {
                            alert('Keranjang masih kosong!');
                        }
                        break;
                }
            }
        }

        // Update event listeners to use modalControls
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('keydown', handleKeyboardShortcuts);
            
            // Update button click handlers to use modalControls
            document.querySelectorAll('[onclick*="showHoldTransactionModal"]').forEach(el => {
                el.onclick = () => {
                    if (cart.items.length > 0) {
                        modalControls.showHoldTransactionModal();
                    } else {
                        alert('Tidak dapat menahan transaksi karena keranjang masih kosong!');
                    }
                };
            });
            
            document.querySelectorAll('[onclick*="closeHoldTransactionModal"]').forEach(el => {
                el.onclick = () => modalControls.closeHoldTransactionModal();
            });
            
            document.querySelectorAll('[onclick*="showHeldTransactionsModal"]').forEach(el => {
                el.onclick = () => modalControls.showHeldTransactionsModal();
            });
            
            document.querySelectorAll('[onclick*="closeHeldTransactionsModal"]').forEach(el => {
                el.onclick = () => modalControls.closeHeldTransactionsModal();
            });
        });

        // Tambahkan fungsi deleteHeldTransaction 
        function deleteHeldTransaction(id) {
            if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                fetch(`/kasir/held-transaction/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showHeldTransactionsModal(); // Refresh the list
                    } else {
                        alert(data.message || 'Gagal menghapus transaksi');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus transaksi');
                });
            }
        }

        // Add function to show payment modal
        function showPaymentModal() {
            const total = cart.items.reduce((sum, item) => sum + item.subtotal, 0);
            const ppn = total * (<?php echo e($pajak); ?> / 100);
            const grandTotal = total + ppn;

            // Update payment modal values
            document.getElementById('payment-total').textContent = formatRupiah(grandTotal);
            document.getElementById('payment-amount').value = '';
            document.getElementById('payment-change').textContent = 'Rp 0';
            
            // Show modal
            document.getElementById('payment-modal').classList.remove('hidden');
            
            // Focus on payment input
            setTimeout(() => {
                document.getElementById('payment-amount').focus();
            }, 100);
        }

        // Update event listener for checkout button
        document.querySelector('button[onclick="showPaymentModal()"]').addEventListener('click', function(e) {
            e.preventDefault();
            if (cart.items.length === 0) {
                alert('Keranjang masih kosong!');
                return;
            }
            showPaymentModal();
        });

        // Add payment input handler
        document.getElementById('payment-amount').addEventListener('input', function(e) {
            const paymentAmount = parseFloat(this.value.replace(/[^0-9]/g, '')) || 0;
            const total = cart.items.reduce((sum, item) => sum + item.subtotal, 0);
            const ppn = total * (<?php echo e($pajak); ?> / 100);
            const grandTotal = total + ppn;
            const change = paymentAmount - grandTotal;
            
            document.getElementById('payment-change').textContent = formatRupiah(Math.max(0, change));
        });

        // Add function to close payment modal
        function closePaymentModal() {
            document.getElementById('payment-modal').classList.add('hidden');
        }

        // Update the initialization code
        document.addEventListener('DOMContentLoaded', function() {
            // ...existing initialization code...
            
            // Add checkout button handler
            const checkoutButton = document.getElementById('checkout-button');
            if (checkoutButton) {
                checkoutButton.addEventListener('click', function() {
                    if (cart.items.length === 0) {
                        alert('Keranjang masih kosong!');
                        return;
                    }
                    showPaymentModal();
                });
            }

            // Add payment amount input handler
            const paymentInput = document.getElementById('payment-amount');
            if (paymentInput) {
                paymentInput.addEventListener('input', function(e) {
                    const paymentAmount = parseFloat(this.value.replace(/[^0-9]/g, '')) || 0;
                    const total = cart.items.reduce((sum, item) => sum + item.subtotal, 0);
                    const ppn = total * (<?php echo e($pajak); ?> / 100);
                    const grandTotal = total + ppn;
                    const change = paymentAmount - grandTotal;
                    
                    const changeElement = document.getElementById('payment-change');
                    if (changeElement) {
                        changeElement.textContent = formatRupiah(Math.max(0, change));
                    }
                });
            }
        });

        // Update the showPaymentModal function
        function showPaymentModal() {
            const modal = document.getElementById('payment-modal');
            const totalElement = document.getElementById('payment-total');
            const amountInput = document.getElementById('payment-amount');
            const changeElement = document.getElementById('payment-change');
            
            if (!modal || !totalElement || !amountInput || !changeElement) {
                console.error('Payment modal elements not found');
                return;
            }
            
            const total = cart.items.reduce((sum, item) => sum + item.subtotal, 0);
            const ppn = total * (<?php echo e($pajak); ?> / 100);
            const grandTotal = total + ppn;

            totalElement.textContent = formatRupiah(grandTotal);
            amountInput.value = '';
            changeElement.textContent = 'Rp 0';
            
            modal.classList.remove('hidden');
            setTimeout(() => amountInput.focus(), 100);
        }

        // Add close modal function if not exists
        function closePaymentModal() {
            const modal = document.getElementById('payment-modal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        // Add process payment function
        async function processPayment() {
            try {
                // Get payment details
                const paymentMethod = document.getElementById('payment-method').value;
                const paymentAmount = parseFloat(document.getElementById('payment-amount').value.replace(/[^\d]/g, '')) || 0;
                const totalStr = document.getElementById('payment-total').textContent;
                const totalAmount = parseFloat(totalStr.replace(/[^\d]/g, '')) || 0;
                
                // Validate payment
                if (paymentAmount < totalAmount) {
                    alert('Jumlah pembayaran kurang dari total belanja');
                    return;
                }

                // Prepare items data
                const items = cart.items.map(item => ({
                    product_id: item.product_id,
                    quantity: item.quantity,
                    price: item.price,
                    selected_serial: item.selected_serial || null
                }));

                // Prepare request data
                const requestData = {
                    payment_method: paymentMethod,
                    payment_amount: paymentAmount,
                    total_amount: totalAmount,
                    items: items
                };

                // Add QRIS reference if needed
                if (paymentMethod === 'qris') {
                    const qrisRef = document.getElementById('qris-reference').value;
                    if (!qrisRef) {
                        alert('Nomor referensi QRIS harus diisi');
                        return;
                    }
                    requestData.qris_reference = qrisRef;
                }

                // Add credit details if applicable (for wholesale)
                if (paymentMethod === 'credit') {
                    const dueDate = document.getElementById('due-date')?.value;
                    const downPayment = parseFloat(document.getElementById('down-payment')?.value.replace(/[^\d]/g, '')) || 0;
                    
                    if (!dueDate) {
                        alert('Tanggal jatuh tempo harus diisi');
                        return;
                    }
                    
                    requestData.due_date = dueDate;
                    requestData.down_payment = downPayment;
                }

                // Send payment request
                const response = await fetch('/kasir/process-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(requestData)
                });

                const result = await response.json();

                if (result.success) {
                    // Close payment modal
                    closePaymentModal();
                    
                    // Clear cart
                    cart.items = [];
                    cart.updateCart();
                    
                    // Show success message
                    alert('Pembayaran berhasil!');
                    
                    // Open receipt in new window
                    if (result.receipt_url) {
                        window.open(result.receipt_url, '_blank');
                    }
                } else {
                    throw new Error(result.message || 'Terjadi kesalahan dalam pemrosesan pembayaran');
                }

            } catch (error) {
                console.error('Payment Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        }

    </script>
</body>
</html>


<?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/kasir/index.blade.php ENDPATH**/ ?>
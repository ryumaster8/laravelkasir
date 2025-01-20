<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Ecer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="flex justify-between items-center px-6 py-4">
            <div class="flex items-center space-x-4">
                <a href="/dashboard" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-semibold text-gray-800">Kasir Ecer</h1>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Kasir: {{ auth()->user()->username }}</span>
                <span class="text-sm text-gray-600">Outlet: {{ auth()->user()->outlet->outlet_name }}</span>
            </div>
        </div>
    </header>

    <div class="flex h-[calc(100vh-4rem)]">
        <!-- Left Side - Product List -->
        <div class="w-2/3 p-6 overflow-auto">
            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <input type="text" 
                           id="searchProduct" 
                           class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none focus:ring" 
                           placeholder="Cari produk...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Product Cards will be dynamically populated here -->
            </div>
        </div>

        <!-- Right Side - Cart -->
        <div class="w-1/3 bg-white border-l border-gray-200 flex flex-col">
            <!-- Cart Header -->
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Keranjang Belanja</h2>
            </div>

            <!-- Cart Items -->
            <div class="flex-1 overflow-auto p-4">
                <div id="cartItems" class="space-y-4">
                    <!-- Cart items will be dynamically populated here -->
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="border-t border-gray-200 p-4 space-y-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-medium" id="subtotal">Rp 0</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">PPN (11%)</span>
                    <span class="font-medium" id="tax">Rp 0</span>
                </div>
                <div class="flex justify-between text-lg font-semibold">
                    <span>Total</span>
                    <span id="total">Rp 0</span>
                </div>

                <!-- Payment Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <button class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Tunai
                    </button>
                    <button class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Non-Tunai
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Load products
            loadProducts();

            // Search functionality
            $('#searchProduct').on('input', function() {
                loadProducts($(this).val());
            });

            function loadProducts(search = '') {
                $.ajax({
                    url: '/api/products/retail',
                    method: 'GET',
                    data: { search: search },
                    success: function(products) {
                        const productGrid = $('.grid');
                        productGrid.empty();

                        products.forEach(product => {
                            const card = `
                                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-4 cursor-pointer product-card" 
                                     data-product-id="${product.id}" 
                                     data-product-name="${product.name}"
                                     data-product-price="${product.price}">
                                    <div class="aspect-w-1 aspect-h-1 mb-4">
                                        <img src="${product.image_url || '/images/default-product.png'}" 
                                             alt="${product.name}"
                                             class="object-cover rounded-lg">
                                    </div>
                                    <h3 class="text-sm font-medium text-gray-900 truncate">${product.name}</h3>
                                    <p class="text-sm text-gray-500">Stok: ${product.stock}</p>
                                    <p class="text-sm font-semibold text-blue-600">Rp ${formatNumber(product.price)}</p>
                                </div>
                            `;
                            productGrid.append(card);
                        });
                    }
                });
            }

            // Format number to currency
            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
            }

            // Add to cart functionality
            $(document).on('click', '.product-card', function() {
                const productId = $(this).data('product-id');
                const productName = $(this).data('product-name');
                const productPrice = $(this).data('product-price');
                
                addToCart(productId, productName, productPrice);
                updateCartTotals();
            });

            function addToCart(productId, productName, price) {
                const cartItem = `
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">${productName}</h4>
                            <p class="text-sm text-gray-600">Rp ${formatNumber(price)}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="decrease-qty px-2 py-1 text-gray-600 hover:bg-gray-200 rounded">-</button>
                            <input type="number" class="w-16 px-2 py-1 text-center border rounded" value="1" min="1">
                            <button class="increase-qty px-2 py-1 text-gray-600 hover:bg-gray-200 rounded">+</button>
                            <button class="remove-item text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
                $('#cartItems').append(cartItem);
            }

            function updateCartTotals() {
                // Implement cart totals calculation
            }
        });
    </script>
</body>
</html> 
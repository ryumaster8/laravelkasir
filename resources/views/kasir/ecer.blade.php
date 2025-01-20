<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir Ecer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <nav class="bg-blue-600 fixed w-full z-10 top-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-white text-xl font-semibold">
                            <i class="fas fa-cash-register mr-2"></i>Kasir Ecer
                        </span>
                    </div>
                    <a href="/dashboard" class="group relative inline-flex items-center gap-1.5 px-4 py-2 bg-white/10 text-sm text-white font-semibold rounded-lg hover:bg-white/20 transition-all duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white/50">
                        <i class="fas fa-home text-white group-hover:scale-110 transition-transform duration-200"></i>
                        <span class="relative">Dashboard</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Product List -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                <h2 class="text-lg font-semibold text-gray-900">
                                    <i class="fas fa-box mr-2"></i>Daftar Produk
                                </h2>
                                <div class="relative flex-1 max-w-md">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" id="searchProduct" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Cari Produk...">
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="productList">
                                @foreach($products as $product)
                                <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                    <div class="p-4">
                                        <h3 class="text-sm font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                                        <p class="text-blue-600 font-bold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500 mb-3">Stok: {{ $product->stock }}</p>
                                        <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})" 
                                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="fas fa-plus mr-2"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow sticky top-20">
                        <div class="p-4 border-b">
                            <h2 class="text-lg font-semibold text-gray-900">
                                <i class="fas fa-shopping-cart mr-2"></i>Keranjang Belanja
                            </h2>
                        </div>
                        <div class="p-4">
                            <div id="cartItems" class="space-y-3 mb-4">
                                <!-- Cart items will be displayed here -->
                            </div>
                            <div class="border-t pt-4 space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-700">Subtotal:</span>
                                    <span id="subtotal" class="font-medium">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-lg font-semibold">
                                    <span class="text-gray-900">Total:</span>
                                    <span id="total" class="text-blue-600">Rp 0</span>
                                </div>
                                <button onclick="processPayment()" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <i class="fas fa-money-bill-wave mr-2"></i>Proses Pembayaran
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let cart = [];
        
        $('#searchProduct').on('keyup', function() {
            const query = $(this).val();
            if (query.length >= 2) {
                $.ajax({
                    url: '/kasir/search/ecer',
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        updateProductList(data);
                    }
                });
            }
        });

        function updateProductList(products) {
            const productList = $('#productList');
            productList.empty();
            
            products.forEach(product => {
                productList.append(`
                    <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">${product.name}</h3>
                            <p class="text-blue-600 font-bold mb-2">Rp ${formatNumber(product.price)}</p>
                            <p class="text-sm text-gray-500 mb-3">Stok: ${product.stock}</p>
                            <button onclick="addToCart(${product.id}, '${product.name}', ${product.price})" 
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-plus mr-2"></i>Tambah
                            </button>
                        </div>
                    </div>
                `);
            });
        }

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);
            
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1
                });
            }
            
            updateCart();
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            updateCart();
        }

        function updateQuantity(id, delta) {
            const item = cart.find(item => item.id === id);
            if (item) {
                item.quantity = Math.max(1, item.quantity + delta);
                updateCart();
            }
        }

        function updateCart() {
            const cartItems = $('#cartItems');
            cartItems.empty();
            
            let subtotal = 0;
            
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;
                
                cartItems.append(`
                    <div class="bg-gray-50 rounded-lg p-3">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">${item.name}</h3>
                                <p class="text-sm text-gray-500">Rp ${formatNumber(item.price)} x ${item.quantity}</p>
                            </div>
                            <div class="text-right">
                                <div class="inline-flex items-center rounded-md shadow-sm mb-2" role="group">
                                    <button class="px-2 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500" 
                                            onclick="updateQuantity(${item.id}, -1)">-</button>
                                    <span class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border-t border-b border-gray-300">${item.quantity}</span>
                                    <button class="px-2 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500" 
                                            onclick="updateQuantity(${item.id}, 1)">+</button>
                                </div>
                                <div class="flex items-center justify-end gap-2">
                                    <span class="text-sm font-medium text-blue-600">Rp ${formatNumber(itemTotal)}</span>
                                    <button onclick="removeFromCart(${item.id})" 
                                            class="inline-flex items-center p-1 border border-transparent rounded-md text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });
            
            $('#subtotal').text(`Rp ${formatNumber(subtotal)}`);
            $('#total').text(`Rp ${formatNumber(subtotal)}`);
        }

        function processPayment() {
            if (cart.length === 0) {
                alert('Keranjang belanja masih kosong!');
                return;
            }
            
            // Process payment logic here
        }

        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }
    </script>
</body>
</html>

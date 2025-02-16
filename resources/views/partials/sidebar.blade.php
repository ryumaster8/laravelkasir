<!-- Sidebar -->
<aside class="w-64 bg-gray-800 transition-transform duration-300">
    <div class="sidebar-header p-4 border-b border-gray-700">
        <a href="/dashboard" class="text-white text-2xl font-semibold">Dashboard</a>
        
        <!-- Outlet Status, Membership & Info -->
        <div class="mt-4 space-y-2">
            <!-- Outlet Status -->
            <div class="flex items-center text-sm">
            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            <span class="text-gray-300">Status: 
            <span class="font-medium {{ session('is_parent') ? 'text-green-400' : 'text-blue-400' }}">
            {{ session('is_parent') ? 'Outlet Induk' : 'Outlet Cabang' }}
            </span>
            </span>
            </div>

            <!-- Membership Info -->
            @php
            $outlet = \App\Models\ModelOutlet::with('membership')
            ->where('outlet_id', session('outlet_id'))
            ->first();
            $membershipName = $outlet->membership->membership_name ?? 'Free';
            @endphp
            <div class="flex items-center text-sm">
            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
            </svg>
            <span class="text-gray-300">Membership: <span class="font-medium text-blue-400">{{ $membershipName }}</span></span>
            </div>

            <!-- Existing Outlet Info -->
            <div class="flex items-center text-sm">
            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <span class="text-gray-300">Outlet: {{ session('outlet_name') }} ({{ session('outlet_id') }})</span>
            </div>
            <div class="flex items-center text-sm">
            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span class="text-gray-300">Operator: {{ session('username') }} ({{ session('user_id') }})</span>
            </div>
            <!-- Role Info -->
            <div class="flex items-center text-sm">
            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
            <span class="text-gray-300">Role: {{ session('role') }}</span>
            </div>
        </div>

        <!-- Search Box -->
        <div class="mt-4 relative">
            <input type="text" 
                   id="searchMenu" 
                   class="w-full bg-gray-700 text-gray-200 rounded-lg pl-10 pr-8 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   placeholder="Cari menu...">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <button id="clearSearch" 
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-white hidden">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="sidebar-content">
        <nav class="mt-4">
            <ul class="space-y-1">
                <!-- Kasir -->
                <li class="menu-item">
                    <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            Kasir
                        </span>
                        <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                        <!-- Kasir Ecer -->
                        <li>
                            <a href="/kasir/ecer" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    Kasir Ecer
                                </span>
                            </a>
                        </li>
                        <!-- Kasir Grosir -->
                        <li>
                            <a href="/kasir/select-wholesale-customer" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Kasir Grosir
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Manajemen Uang Kas -->
                <li class="menu-item">
                    <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Manajemen Uang Kas
                        </span>
                        <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                        <li>
                            <a href="/dashboard/cashier" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Kas</a>
                        </li>
                        <li>
                            <a href="/dashboard/kas-awal" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Kas Awal</a>
                        </li>
                        <li>
                            <a href="/dashboard/penambahan" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Penambahan Uang Kas</a>
                        </li>
                        <li>
                            <a href="/dashboard/penarikan" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Penarikan Uang Kas</a>
                        </li>
                        <li>
                            <a href="/dashboard/kas-akhir" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Kas Akhir</a>
                        </li>
                        @if(session('role') == 'superadmin' || session('role') == 'admin')
                        <li>
                            <a href="{{ route('kas.akurasi') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    Tampilkan Akurasi Kas
                                </span>
                            </a>
                        </li>
                        @endif
                        {{-- <li>
                            <a href="/dashboard/serviceFunds" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Uang Servis</a>
                        </li> --}}
                    </ul>
                </li>

                <!-- Manajemen Pengguna -->
                <li class="menu-item">
                    <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Manajemen Pengguna
                        </span>
                        <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                        <li>
                            <a href="{{ route('user.create') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tambah Pengguna</a>
                        </li>
                        <li>
                            <a href="{{ route('user.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampilkan Pengguna</a>
                        </li>
                    </ul>
                </li>

                <!-- Manajemen Produk -->
                <li class="menu-item">
                    <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Manajemen Produk
                        </span>
                        <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                        <li>
                            <a href="{{ route('products.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tambah Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('self-products') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampil Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('products-all-outlets') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampil Produk All Outlet</a>
                        </li>
                        <li>
                            <a href="{{ route('products.transfer-requests-submission') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Pengajuan Pemindahan Stok</a>
                        </li>
                        <li>
                            <a href="{{ route('products.transfer-requests') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Permintaan Pemindahan Stok</a>
                        </li>
                        <li>
                            <a href="{{ route('products.history-transfer-requests') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Riwayat Pemindahan Stok</a>
                        </li>
                        @if(Auth::user()->outlet->membership->low_stock_reminder_feature)
                        <li>
                            <a href="{{ route('products.low-stock') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Pengingat Stok Menipis
                                </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                <!-- Manajemen Diskon -->
                <li class="menu-item">
                    <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                            </svg>
                            Manajemen Diskon
                        </span>
                        <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                        <li>
                            <a href="{{ route('discounts.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Daftar Diskon</a>
                        </li>
                        <li>
                            <a href="{{ route('discounts.create') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tambah Diskon</a>
                        </li>
                        <li>
                            <a href="{{ route('discounts.applyProduct') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Diskon per Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('discounts.applyCategory') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Diskon per Kategori</a>
                        </li>
                    </ul>
                </li>

                <!-- Tambahkan menu Manajemen Cabang setelah Manajemen Diskon -->
                <li class="menu-item">
                    <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Manajemen Cabang
                        </span>
                        <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                        <li>
                            <a href="{{ route('branches.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampil Cabang</a>
                        </li>
                        <li>
                            <a href="{{ route('branches.create') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tambah Cabang</a>
                        </li>
                    </ul>
                </li>

                <!-- Manajemen Pelanggan -->
                {{-- <li class="menu-item">
                    <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Manajemen Pelanggan
                </span>
                <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampil Pelanggan</a>
                </li>
            </ul>
        </li> --}}

                <!-- Manajemen Grosir -->
                <li class="menu-item">
                    <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Manajemen Grosir
                        </span>
                        <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                        
                        <!-- Pelanggan Grosir -->
                        <li>
                            <a href="{{ route('wholesale-customer.create') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    Tambah Pelanggan Grosir
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('wholesale-customer.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Tampil Pelanggan Grosir
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Manajemen Transaksi -->
            <li class="menu-item">
                <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Manajemen Transaksi
                    </span>
                    <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                    <li>
                        <a href="{{ route('transactions.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampil Semua Transaksi</a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.data') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Riwayat Transaksi Per Produk</a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.group') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Transaksi Group</a>
                    </li>
                </ul>
            </li>

            <!-- Manajemen Garansi -->
            {{-- 
            <li class="menu-item">
                <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Manajemen Garansi
                </span>
                <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                <li><a href="/admin/warranties" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampil Garansi</a></li>
                <li><a href="/admin/warranties/add" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tambah Garansi</a></li>
                <li><a href="/admin/warranties/claims" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Klaim Garansi</a></li>
                <li><a href="/admin/warranties/status" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Status Garansi</a></li>
                <li><a href="/admin/warranties/register" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Registrasi Garansi</a></li>
                <li><a href="/admin/warranties/status" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Cek Status Garansi</a></li>
                <li><a href="/admin/warranties/history" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Riwayat Garansi</a></li>
                <li><a href="/admin/warranties/extend" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Perpanjangan Garansi</a></li>
            </ul>
        </li>
         --}}

            <!-- Servis HP dan Laptop -->
            {{-- 
                                            <li class="menu-item">
                                                <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                                                    <span class="flex items-center">
                                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                        Servis HP dan Laptop
                                                    </span>
                                                    <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                    </svg>
                                                </button>
                                                <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                                                    <li>
                                                        <a href="{{ route('services.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                                            Tampil Servis
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('services.create') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                                            Tambah Servis
                                                        </a>
                                                    </li>
                                                    {{-- <li>
                                                        <a href="{{ route('services.history') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                                            Riwayat Servis
                                                        </a>
                                                    </li> --}}
                                                    {{-- <li>
                                                        <a href="/dashboard/service/pengambilan" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                                            Ambil Servis
                                                        </a>
                                                    </li>
                                                    <!-- Teknisi submenu -->
                                                    <li class="menu-item">
                                                        <button class="w-full flex items-center justify-between px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                                            <span class="flex items-center">
                                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                                </svg>
                                                                Teknisi
                                                            </span>
                                                            <svg class="w-3 h-3 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                            </svg>
                                                        </button>
                                                        <ul class="submenu ml-4 mt-1 space-y-1 hidden">
                                                            <li>
                                                                <a href="{{ route('teknisi.create') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                                                    Tambah Teknisi
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('teknisi.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                                                    Tampil Teknisi
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li> --}}

            <!-- Manajemen Kategori -->
            <li class="menu-item">
                <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Manajemen Kategori
                    </span>
                    <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                    <li>
                        <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                            Tampilkan Kategori
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('categories.set-default') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                            Set Default Kategori
                        </a>
                    </li> --}}
                </ul>
            </li>

            <!-- Manajemen Supplier -->
            <li class="menu-item">
                <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Manajemen Supplier
                    </span>
                    <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                    <li>
                        <a href="/dashboard/suppliers/add" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                            Tambah Supplier
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/suppliers" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                            Tampilkan Supplier
                        </a>
                    </li>
                    {{-- <li>
                        <a href="/admin/suppliers/set_default" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                            Set Default Supplier
                        </a>
                    </li> --}}
                </ul>
            </li>

            <!-- Pengaturan -->
            @if(session('role') == 'superadmin' || session('role') == 'admin')
            <li class="menu-item">
                <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Pengaturan
                    </span>
                    <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                    {{-- <li><a href="{{ route('settings.theme') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tema & Tampilan</a></li>
                    <li><a href="{{ route('settings.privacy') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Privasi</a></li>
                    <li><a href="{{ route('settings.dashboard-customization') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Dashboard Kustomisasi</a></li>
                    <li><a href="{{ route('settings.access-control') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Pengaturan Hak Akses</a></li>
                    <li><a href="{{ route('settings.security') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Keamanan</a></li> --}}
                    <li><a href="{{ route('user-permissions.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Pengaturan User Permissions</a></li>
                </ul>
            </li>
            @endif

            <!-- Log Aktivitas -->
            @if(session('role') == 'superadmin' || session('role') == 'admin')
            <li class="menu-item">
                <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Log Aktivitas
                    </span>
                    <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                    <li><a href="{{ route('activity-logs.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampilkan Log Aktivitas</a></li>
                </ul>
            </li>
            @endif

            <!-- Manajemen Penjualan -->
            <li class="menu-item">
                <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Manajemen Penjualan
                    </span>
                    <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                    <li><a href="/dashboard/sales-report" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Laporan Penjualan</a></li>
                </ul>
            </li>

            <!-- Outlet -->
            @if(session('role') == 'superadmin' || session('role') == 'admin')
            <li class="menu-item">
                <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Outlet
                    </span>
                    <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                    <li><a href="/dashboard/outlet/profile/edit" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Edit Profil Outlet</a></li>
                    <li><a href="/dashboard/outlet/change-membership" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Ubah Membership</a></li>
                    <li><a href="/dashboard/outlet/billing" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tagihan</a></li>
                    <li><a href="/dashboard/outlet/outlet/payment-history" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Riwayat Pembayaran</a></li>
                    <li><a href="/dashboard/outlet/billing/info-outlet" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Info Outlet</a></li>
                </ul>
            </li>
            @endif
        </li>

        <!-- Tampilkan Semua Session -->
        <li>
            <a href="{{ route('tampilkan-semua-session') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Tampilkan Semua Session
            </a>
        </li>

        <!-- Saran -->
        @if(session('role') == 'superadmin' || session('role') == 'admin')
        <li class="menu-item">
            <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
            <span class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2v-12z"/>
                </svg>
                Saran
            </span>
            <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
            </button>
            <ul class="submenu ml-6 mt-1 space-y-1 hidden">
            <li><a href="/dashboard/saran/create" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Kirim Saran</a></li>
            </ul>
        </li>
        @endif

        <!-- Logout -->
        <li>
            <a href="/auth/logout" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h10a3 3 0 013 3v1"/>
                </svg>
                Logout
            </a>
        </li>
    </ul>
</nav>
</div>
</aside>
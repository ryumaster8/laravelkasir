<!-- Sidebar -->
        <aside class="w-64 bg-gray-800 transition-transform duration-300">
            <div class="sidebar-header">
                <h1 class="text-white text-2xl font-semibold">Dashboard Owner</h1>
                <!-- Tambahkan form pencarian -->
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
                                    <a href="/admin/wholesalecashier/select-customer" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
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
                                    <a href="/admin/cashier" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Kas</a>
                                </li>
                                <li>
                                    <a href="/bukakasir" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Kas Awal</a>
                                </li>
                                <li>
                                    <a href="/penambahan" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Penambahan Uang Kas</a>
                                </li>
                                <li>
                                    <a href="/penarikan" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Penarikan Uang Kas</a>
                                </li>
                                <li>
                                    <a href="/showKasAkhir" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Kas Akhir</a>
                                </li>
                                <li>
                                    <a href="/serviceFunds" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Uang Servis</a>
                                </li>
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

                        <!-- Outlet -->
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
                            <li>
                                <a href="/owner/outlet/create" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                    Tambah Outlet
                                </a>
                            </li>
                            <li>
                                <a href="/owner/outlet" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                    Lihat Outlet
                                </a>
                            </li>
                            <li>
                                <a href="/owner/outlet/edit" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                    Edit Outlet
                                </a>
                            </li>
                            <li>
                                <a href="/owner/membership/upgrade-requests" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                    Upgrade/Downgrade Membership
                                </a>
                            </li>
                            <li>
                                <a href="/owner/outlet/register" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                    Pendaftaran Outlet Baru
                                </a>
                            </li>
                        </ul>
                    </li>

                        <!-- Add Membership Management menu after Outlet menu -->
                        <li class="menu-item">
                            <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Manajemen Members
                                </span>
                                <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                                <li>
                                    <a href="{{ route('membership.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                        Tampil Membership
                                    </a>
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
                                    <a href="/products/add" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tambah Produk</a>
                                </li>
                                <li>
                                    <a href="/products-all-outlets" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampil Produk</a>
                                </li>
                                <li>
                                    <a href="/admin/products/submission-transfer-requests" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Pengajuan Pemindahan Stok</a>
                                </li>
                                <li>
                                    <a href="/admin/products/transfer-requests" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Permintaan Pemindahan Stok</a>
                                </li>
                                <li>
                                    <a href="/admin/products/history-transfer-requests" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Riwayat Pemindahan Stok</a>
                                </li>
                                <li>
                                    <a href="/admin/products/kosong" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Produk Kosong</a>
                                </li>
                                <!-- Lokasi Produk sebagai submenu -->
                                <li class="menu-item">
                                    <button class="w-full flex items-center justify-between px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Lokasi Produk
                                        </span>
                                        <svg class="w-3 h-3 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <ul class="submenu ml-4 mt-1 space-y-1 hidden">
                                        <li>
                                            <a href="/admin/product-locations/set-default" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Set Default Lokasi Produk</a>
                                        </li>
                                        <li>
                                            <a href="/admin/product-locations" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampilkan Lokasi Produk</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Tipe Produk sebagai submenu -->
                                <li class="menu-item">
                                    <button class="w-full flex items-center justify-between px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                            Tipe Produk
                                        </span>
                                        <svg class="w-3 h-3 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <ul class="submenu ml-4 mt-1 space-y-1 hidden">
                                        <li>
                                            <a href="/admin/product-type" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Tampilkan Tipe Produk</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- Database Management -->
                        <li class="menu-item">
                            <button class="w-full flex items-center justify-between px-4 py-2 text-gray-300 hover:bg-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                                    </svg>
                                    Database
                                </span>
                                <svg class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <ul class="submenu ml-6 mt-1 space-y-1 hidden">
                                <li>
                                    <a href="/owner/database/show-create_table" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Show Create Table</a>
                                </li>
                                <li>
                                    <a href="{{ route('database.export') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Export Database</a>
                                </li>
                                <li>
                                    <a href="/owner/database/restore" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg">Restore Database</a>
                                </li>
                                <li>
                                    <a href="{{ route('database.models') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg flex items-center justify-between">
                                        <span>Tampil Model</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('database.controllers') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg flex items-center justify-between">
                                        <span>Tampil Controller</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </li>

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
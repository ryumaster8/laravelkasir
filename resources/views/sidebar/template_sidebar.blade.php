<div class="p-4 h-screen overflow-y-auto">
    <h2 class="text-2xl font-bold mb-4">Menu Admin</h2>
    <input type="text" id="menuSearch" class="w-full mb-4 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari Menu...">
    <div id="menuList">
        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item">
            <span class="menu-text">Main Menu</span>
        </h3>
        <ul class="sub-menu hidden">
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Main Menu</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Multi Kasir</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Kasir</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Kasir Grosir</a></li>
        </ul>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Uang Kas</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <ul class="sub-menu hidden">
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Kas</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Kas Awal</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Penambahan Uang Kas</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Penarikan Uang Kas</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Kas Akhir</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Uang Servis</a></li>
        </ul>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Pengguna</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <ul class="sub-menu hidden">
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Pengguna</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampilkan Pengguna</a></li>
        </ul>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Produk</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Produk</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampil Produk</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Pengajuan Pemindahan Stok</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Permintaan Pemindahan Stok</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Riwayat Pemindahan Stok</a></li>
                <li class="mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
                    <a href="#" class="my-custom-button block w-full text-left">Produk Kosong</a>
                    <div class="hidden sub-menu">
                        <ul>
                            <li class="ml-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
                                <a href="#" class="my-custom-button block w-full text-left">Lokasi Produk</a>
                                <div class="hidden sub-menu">
                                    <ul>
                                        <li class="ml-8 mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Lokasi Produk</a></li>
                                        <li class="ml-8 mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampilkan Lokasi Produk</a></li>
                                        <li class="ml-8 mb-2"><a href="#" class="my-custom-button block w-full text-left">Set Default Lokasi Produk</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="ml-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
                                <a href="#" class="my-custom-button block w-full text-left">Tipe Produk</a>
                                <div class="hidden sub-menu">
                                    <ul>
                                        <li class="ml-8 mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampilkan Tipe Produk</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Diskon</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Daftar Diskon</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Diskon</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Diskon per Produk</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Diskon per Kategori</a></li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item">
            <span class="menu-text">Manajemen Cabang</span>
        </h3>
        <ul class="sub-menu hidden">
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampil Cabang</a></li>
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Cabang</a></li>
        </ul>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item">
            <span class="menu-text">Manajemen Pelanggan</span>
        </h3>
        <ul class="sub-menu hidden">
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampil Pelanggan</a></li>
        </ul>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Grosir</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
                    <a href="#" class="my-custom-button block w-full text-left">Kasir Grosir</a>
                    <div class="hidden sub-menu">
                        <ul>
                            <li class="ml-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
                                <a href="#" class="my-custom-button block w-full text-left">Pelanggan Grosir</a>
                                <div class="hidden sub-menu">
                                    <ul>
                                        <li class="ml-8 mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Pelanggan Grosir</a></li>
                                        <li class="ml-8 mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampil Pelanggan Grosir</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Transaksi</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul class="sub-menu">
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampil Semua Transaksi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Riwayat Transaksi Per Produk</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Transaksi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Diskon & Promo</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Pembayaran Cicilan</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Cek Status Pembayaran</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Transaksi Belum Selesai</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampil Transaksi Hari Ini</a></li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Garansi</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampil Garansi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Garansi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Klaim Garansi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Status Garansi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Registrasi Garansi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Cek Status Garansi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Klaim Garansi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Riwayat Garansi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Perpanjangan Garansi</a></li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Servis HP dan Laptop</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampil Servis</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Servis</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Riwayat Servis</a></li>
                <li class="mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
                    <a href="#" class="my-custom-button block w-full text-left">Ambil Servis</a>
                    <div class="hidden sub-menu">
                        <ul>
                            <li class="ml-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
                                <a href="#" class="my-custom-button block w-full text-left">Teknisi</a>
                                <div class="hidden sub-menu">
                                    <ul>
                                        <li class="ml-8 mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Teknisi</a></li>
                                        <li class="ml-8 mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampil Teknisi</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Kategori</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Kategori</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampilkan Kategori</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Set Default Kategori</a></li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Supplier</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tambah Supplier</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampilkan Supplier</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Set Default Supplier</a></li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Pengaturan</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tema & Tampilan</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Privasi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Dashboard Kustomisasi</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Pengaturan Hak Akses</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Keamanan</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Pengaturan User Permissions</a></li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item">
            <span class="menu-text">Log Aktivitas</span>
        </h3>
        <ul class="sub-menu hidden">
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampilkan Log Aktivitas</a></li>
        </ul>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Manajemen Penjualan</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Laporan Penjualan</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Lihat Penjualan</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Detail Membership</a></li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item has-sub-menu">
            <span class="menu-text">Outlet</span>
            <span class="transition-transform duration-300 ease arrow-icon">▼</span>
        </h3>
        <div class="hidden sub-menu">
            <ul>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Edit Profil Outlet</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Upgrade Membership</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tagihan</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Riwayat Pembayaran</a></li>
                <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Info Outlet</a></li>
            </ul>
        </div>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item">
            <span class="menu-text">Tampilkan Semua Session</span>
        </h3>
        <ul class="sub-menu hidden">
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Tampilkan Semua Session</a></li>
        </ul>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item">
            <span class="menu-text">Saran</span>
        </h3>
        <ul class="sub-menu hidden">
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Kirim Saran</a></li>
        </ul>

        <h3 class="font-semibold mt-4 mb-2 flex justify-between items-center cursor-pointer menu-item">
            <span class="menu-text">Logout</span>
        </h3>
        <ul class="sub-menu hidden">
            <li class="mb-2"><a href="#" class="my-custom-button block w-full text-left">Logout</a></li>
        </ul>
    </div>
</div>
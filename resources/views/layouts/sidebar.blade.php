<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">DigisoftStudio</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Main Menu -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Multi Kasir
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Kasir
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-store-alt"></i>
                        <p>
                            Kasir Grosir
                        </p>
                    </a>
                </li>
                <!-- Manajemen Uang Kas -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                       <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Manajemen Uang Kas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Awal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penambahan Uang Kas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penarikan Uang Kas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Akhir</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Uang Servis</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Manajemen Pengguna  -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Manajemen Pengguna
                             <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Pengguna</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tampilkan Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>
                 <!-- Manajemen Produk -->
                <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Manajemen Produk
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Produk</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tampilkan Produk</p>
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tampilkan Produk Semua Outlet</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan Pemindahan Stok</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permintaan Pemindahan Stok</p>
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Pemindahan Stok</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Produk Kosong</p>
                            </a>
                        </li>
                        <!-- Lokasi Produk -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Lokasi Produk
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Tambah Lokasi Produk</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                         <p>Tampilkan Lokasi Produk</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Set Default Lokasi Produk</p>
                                    </a>
                                </li>
                            </ul>
                         </li>
                           <!-- Tipe Produk -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Tipe Produk
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Tampilkan Tipe Produk</p>
                                    </a>
                                </li>
                            </ul>
                         </li>
                     </ul>
                </li>
                 <!-- Manajemen Diskon -->
                <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Manajemen Diskon
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Diskon</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Diskon</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Diskon per Produk</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Diskon per Kategori</p>
                            </a>
                        </li>
                     </ul>
                </li>
                 <!-- Manajemen Cabang (hanya untuk outlet induk) -->
                <li class="nav-item">
                      <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-code-branch"></i>
                        <p>
                            Manajemen Cabang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tampil Cabang</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Cabang</p>
                            </a>
                        </li>
                     </ul>
                </li>
                 <!-- Manajemen Pelanggan -->
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Manajemen Pelanggan
                        </p>
                    </a>
                 </li>
                 <!-- Manajemen Grosir -->
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                           Manajemen Grosir
                             <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kasir Grosir</p>
                            </a>
                        </li>
                          <!-- Pelanggan Grosir -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                <p>
                                   Pelanggan Grosir
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Tambah Pelanggan Grosir</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="/wholesale-customer" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Tampilkan Pelanggan Grosir</p>
                                    </a>
                                </li>
                            </ul>
                         </li>
                     </ul>
                 </li>
                <!-- Manajemen Transaksi -->
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Manajemen Transaksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tampil Semua Transaksi</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                 <p>Riwayat Transaksi Per Produk</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Transaksi</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Diskon & Promo</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Pembayaran Cicilan</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cek Status Pembayaran</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Transaksi Belum Selesai</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Tampil Transaksi Hari Ini</p>
                            </a>
                        </li>
                     </ul>
                </li>
                 <!-- Manajemen Garansi -->
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                           Manajemen Garansi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tampil Garansi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Garansi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Klaim Garansi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Status Garansi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Registrasi Garansi</p>
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cek Status Garansi</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Klaim Garansi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Garansi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perpanjangan Garansi</p>
                            </a>
                        </li>
                     </ul>
                 </li>
                  <!-- Servis HP dan Laptop -->
                <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                           Servis HP dan Laptop
                             <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tampil Servis</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Servis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Servis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ambil Servis</p>
                            </a>
                        </li>
                         <!-- Teknisi -->
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Teknisi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Tampil Teknisi</p>
                                    </a>
                                </li>
                            </ul>
                         </li>
                    </ul>
                </li>
                 <!-- Manajemen Kategori (hanya untuk outlet induk) -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                       <i class="nav-icon fas fa-list"></i>
                        <p>
                           Manajemen Kategori
                           <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tampilkan Kategori</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Set Default Kategori</p>
                            </a>
                        </li>
                    </ul>
                 </li>
                 <!-- Manajemen Supplier (hanya untuk outlet induk) -->
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                           Manajemen Supplier
                           <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Supplier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tampilkan Supplier</p>
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Set Default Supplier</p>
                            </a>
                        </li>
                    </ul>
                 </li>
                 <!-- Pengaturan -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Pengaturan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tema & Tampilan</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Privasi</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard Kustomisasi</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengaturan Hak Akses</p>
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Keamanan</p>
                            </a>
                        </li>
                           <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Permissions</p>
                            </a>
                        </li>
                    </ul>
                 </li>
                 <!-- Log Aktivitas -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                       <i class="nav-icon fas fa-history"></i>
                        <p>
                            Log Aktivitas
                        </p>
                    </a>
                 </li>
                <!-- Manajemen Penjualan -->
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Manajemen Penjualan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Penjualan</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Penjualan</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Detail Membership</p>
                            </a>
                        </li>
                     </ul>
                </li>
                <!-- Outlet -->
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-store"></i>
                        <p>
                            Outlet
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit Profil Outlet</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Upgrade Membership</p>
                            </a>
                        </li>
                        <li class="nav-item">
                             <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                 <p>Tagihan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Info Outlet</p>
                            </a>
                        </li>
                    </ul>
                 </li>
                <!-- Saran -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-comment-dots"></i>
                        <p>
                            Saran
                        </p>
                    </a>
                 </li>
                  <!-- Tampilkan Semua Session -->
                <li class="nav-item">
        <a href="{{ route('tampilkan-semua-session') }}" class="nav-link">
            <i class="nav-icon fas fa-user-clock"></i>
            <p>
               Tampilkan Semua Session
            </p>
        </a>
     </li>
                   <!-- Logout -->
                 <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                       <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                 </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
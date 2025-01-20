<?php
$session = \Config\Services::session();

$theme = $session->get('theme') ?? 'light';  // Default ke tema terang
$primaryColor = $session->get('primary_color') ?? '#000000';  // Default ke warna hitam
$font = $session->get('font') ?? 'Arial';  // Default ke font Arial
$textSize = $session->get('text_size') ?? '14px';  // Default ke ukuran teks 14px

$role = $session->get('role'); // Mengambil role dari session
$membershipTypeName = strtolower($session->get('membership_type_name')); // Mengambil jenis membership dari session
$outletId = $session->get('outlet_id'); // Mendapatkan outlet_id dari session
$branchCount = 0;
$membershipTypeId = $session->get('membership_type_id'); // Mendapatkan membership_type_id dari session
$username = $session->get('username'); // Mendapatkan username dari session

// Load the necessary models
$outletsModel = new \App\Models\OutletsModel();
$membershipTypesModel = new \App\Models\MembershipTypesModel(); // Assuming this model exists

// Check if the outlet ID exists in the session
if ($outletId) {
    // Count the number of branches
    $branchCount = $outletsModel->where('parent_outlet_id', $outletId)->countAllResults();

    // Get the membership type name based on the membership_type_id from the session
    $membershipType = $membershipTypesModel->find($membershipTypeId);
    $membershipTypeName = isset($membershipType['name']) ? $membershipType['name'] : 'Tidak Ada'; // Safely access 'name'
}
?>

<div>
    <h4 class="text-center">Menu Admin</h4>

    <!-- Menampilkan nama operator (username) yang sedang login -->
    <h5 class="text-center">Operator: <?= esc($username) ? esc($username) : 'Nama Operator Tidak Ditemukan' ?></h5>

    <h5 class="text-center">Outlet: <?= $session->get('outlet_name') ? $session->get('outlet_name') : 'Nama Outlet Tidak Ditemukan' ?></h5>
    <h5 class="text-center">Status Outlet: <?= $session->get('outlet_status') ? $session->get('outlet_status') : 'Status Tidak Ditemukan' ?></h5>

    <h5 class="text-center">Jenis Membership: <?= isset($membership_type_name) ? $membership_type_name : 'Tidak Ada' ?></h5> <!-- Menampilkan jenis membership -->
    <!-- Menampilkan jumlah cabang hanya jika outlet memiliki cabang dan membership-nya platinum -->
    <?php if ($branchCount > 0 && strtolower($membershipTypeName) === 'platinum'): ?>
        <h5 class="text-center">Jumlah Cabang: <?= $branchCount ?></h5> <!-- Menampilkan jumlah cabang -->
    <?php endif; ?>

    <!-- Menampilkan Logo Outlet -->
    <?php if (isset($outlet['logo']) && !empty($outlet['logo'])): ?>
        <div class="logo-container">
            <img src="<?= base_url('uploads/logos/' . $outlet['logo']) ?>" alt="Logo Outlet" class="img-fluid logo">
        </div>
    <?php endif; ?>


    <div class="search-box">
        <input type="text" id="menuSearch" class="form-control" placeholder="Cari menu...">
        <span class="clear-search" id="clearSearch">&times;</span>
    </div>
    <button class="btn btn-secondary btn-block mb-2" id="collapseAll">Collapse All</button>
    <ul class="nav flex-column" id="menuList">
        <li class="nav-item">
            <a class="nav-link active" href="/kasir">Kasir</a>
        </li>
        <!-- Menu Manajemen Pengguna, hanya ditampilkan jika role = admin -->
        <?php if ($role === 'admin'): ?>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="#" id="toggleUsers">Manajemen Pengguna</a>
                <ul class="nav flex-column submenu" id="userSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users/add">Tambah Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">Tampilkan Pengguna</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <!-- Menu Manajemen Produk -->
        <li class="nav-item has-submenu">
            <a class="nav-link" href="#" id="toggleProducts">Manajemen Produk</a>
            <ul class="nav flex-column submenu" id="productSubmenu">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/products">Tampil Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/products/add">Tambah Produk Umum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/products/add-smartphone">Tambah Produk Smartphone</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/products/add-nomor-cantik">Tambah Produk Nomer Cantik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/products/add-perdana-paket">Tambah Produk Perdana Paket</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/products/no-barcode">Belum Ada Barcode</a> <!-- Submenu Baru -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/products/generate-barcode">Generate Barcode</a> <!-- Submenu Baru -->
                </li>
            </ul>
        </li>
        <!-- Menu Manajemen Cabang, hanya ditampilkan jika role = admin dan membership = platinum -->
        <?php if ($role === 'admin' && $membershipTypeName === 'platinum'): ?>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="#" id="toggleBranches">Manajemen Cabang</a>
                <ul class="nav flex-column submenu" id="branchSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/branches">Tampil Cabang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/branches/add">Tambah Cabang</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        <!-- Menu Manajemen Grosir -->
        <li class="nav-item has-submenu">
            <a href="#" id="toggleWholesale" class="nav-link">Manajemen Grosir</a>
            <ul class="nav flex-column submenu" id="wholesaleSubmenu">
                <!-- Submenu baru untuk Kasir Grosir -->
                <li class="nav-item">
                    <a class="nav-link" href="/admin/wholesalecashier/select-customer">Kasir Grosir</a> <!-- Link untuk Kasir Grosir -->
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link" href="#" id="toggleWholesaleCustomers">Pelanggan Grosir</a>
                    <ul class="nav flex-column submenu" id="wholesaleCustomersSubmenu">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/wholesalecustomers/add">Tambah Pelanggan Grosir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/wholesalecustomers">Tampil Pelanggan Grosir</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>

        <!-- Menu Manajemen Transaksi -->
        <li class="nav-item has-submenu">
            <a href="#" id="toggleTransactions" class="nav-link">Manajemen Transaksi</a>
            <ul class="nav flex-column submenu" id="transactionSubmenu">
                <li class="nav-item">
                    <a class="nav-link" href="/transactions">Tampil Semua Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/transactions/product-history">Riwayat Transaksi Per Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/transactions/add">Tambah Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/transactions/discounts-promos">Diskon & Promo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/transactions/installment-payments">Pembayaran Cicilan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/transactions/payment-status">Cek Status Pembayaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/transactions/uncompleted">Transaksi Belum Selesai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/transactions/today">Tampil Transaksi Hari Ini</a> <!-- Submenu baru -->
                </li>
            </ul>
        </li>
        <!-- Menu Garansi -->
        <li class="nav-item has-submenu">
            <a class="nav-link" href="#" id="toggleWarranty">Manajemen Garansi</a>
            <ul class="nav flex-column submenu" id="warrantySubmenu">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/warranty/add">Tambah Garansi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/warranty/claims">Klaim Garansi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/warranty/status">Status Garansi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/warranty/register">Registrasi Garansi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/warranty/status">Cek Status Garansi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/warranty/claim">Klaim Garansi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/warranty/history">Riwayat Garansi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/warranty/extend">Perpanjangan Garansi</a>
                </li>
            </ul>
        </li>

        <!-- Menu Servis HP dan Laptop -->
        <li class="nav-item has-submenu">
            <a class="nav-link" href="#" id="toggleService">Servis HP dan Laptop</a>
            <ul class="nav flex-column submenu" id="serviceSubmenu">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/service/create">Tambah Servis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/service/history">Riwayat Servis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/service/status">Status Servis</a>
                </li>
            </ul>
        </li>

        <!-- Menu Manajemen Kategori -->
        <li class="nav-item has-submenu">
            <a class="nav-link" href="#" id="toggleCategories">Manajemen Kategori</a>
            <ul class="nav flex-column submenu" id="categorySubmenu">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/categories/add">Tambah Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/categories">Tampilkan Kategori</a>
                </li>
            </ul>
        </li>

        <!-- Menu Manajemen Supplier -->
        <li class="nav-item has-submenu">
            <a class="nav-link" href="#" id="toggleSuppliers">Manajemen Supplier</a>
            <ul class="nav flex-column submenu" id="supplierSubmenu">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/suppliers/add">Tambah Supplier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/suppliers">Tampilkan Supplier</a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-submenu">
            <a class="nav-link" href="#" id="toggleSettings">Pengaturan</a>
            <ul class="nav flex-column submenu" id="settingsSubmenu">
                <li class="nav-item">
                    <a class="nav-link" href="/user/settings/theme">Tema & Tampilan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/settings/privacy">Privasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/settings/dashboard">Dashboard Kustomisasi</a>
                </li>

                <!-- Menu baru untuk pengaturan hak akses, hanya untuk admin dengan membership platinum -->
                <?php if ($role === 'admin' && strtolower($membershipTypeName) === 'platinum'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/user_permissions">Pengaturan Hak Akses</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="/user/settings/security">Keamanan</a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-submenu">
            <a class="nav-link" href="#" id="toggleActivityLogs">Log Aktivitas</a>
            <ul class="nav flex-column submenu" id="activityLogsSubmenu">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/activity-logs">Tampilkan Log Aktivitas</a>
                </li>
            </ul>
        </li>



        <li class="nav-item">
            <a class="nav-link" href="#">Laporan Penjualan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/profile/edit">Edit Profil Outlet</a>
        </li>
        <!-- Menu Baru: Menampilkan Semua Daftar Session -->
        <li class="nav-item">
            <a class="nav-link" href="/admin/session-info">Tampilkan Semua Session</a>
        </li>

        <li class="nav-item logout">
            <a class="nav-link" href="/auth/logout">Logout</a>
        </li>
    </ul>
</div>
<!-- Tambahkan JavaScript di sini -->
<script>
    // Menangkap event ketika tombol F9 ditekan
    document.addEventListener('keydown', function(event) {
        if (event.key === 'F9') {
            event.preventDefault(); // Mencegah tindakan default
            window.location.href = '/admin/wholesalecashier/select-customer'; // Arahkan ke Kasir Grosir
        }
    });
</script>


<style>
    .sidebar {
        background-color: #343a40;

        color: white;
    }

    .nav-link {
        padding: 10px 15px;
        transition: background-color 0.3s;
    }

    .nav-link:hover {
        background-color: #495057;
        border-radius: 5px;
    }

    .logo-container {
        display: flex;
        justify-content: center;
        border-radius: 15px;
        padding: 10px;
        background-color: transparent;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 10px;
    }

    .logo {
        max-height: 100px;
        max-width: 100%;
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .submenu {
        padding-left: 20px;
        display: none;
    }

    .has-submenu>a::after {
        content: ' ▼';
        font-size: 0.8em;
        float: right;
        margin-left: 5px;
        transition: transform 0.3s;
    }

    .has-submenu.open>a::after {
        transform: rotate(180deg);
    }
</style>
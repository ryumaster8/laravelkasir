<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<style>
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table-bordered th,
    .table-bordered td {
        vertical-align: middle;
        text-align: center;
    }
</style>


<section class="py-5">
    <h2 class="text-center mb-4">Detail Membership</h2>
    <div class="table-responsive px-4">
        <table class="table table-dark table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th colspan="1" class="text-center"></th>
                    <th colspan="2" class="text-center">Biaya</th>
                    <th colspan="4" class="text-center">Limit</th>
                    <th colspan="10" class="text-center">Fitur</th>
                </tr>
                <tr>
                    <th>Nama Membership</th>
                    <th>Bulanan</th>
                    <th>Pendaftaran</th>
                    <th>Cabang</th>
                    <th>Transaksi Harian</th>
                    <th>Penambahan Produk</th>
                    <th>Pengguna</th>
                    <th>Grosir</th>
                    <!-- <th>Chat</th> -->
                    <th>Data Kontak Pelanggan</th>
                    <th>Audit Stok</th>
                    <th>Log Aktivitas</th>
                    <th>Cetak Nota Kasir</th>
                    <th>Diskon</th>
                    <!-- <th>Gambar Produk</th> -->
                    <th>Pengingat Stok</th>
                    <!-- <th>Shortcut</th> -->
                    <!-- <th>Custom Shortcut</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($memberships)): ?>
                    <?php foreach ($memberships as $index => $membership): ?>
                        <tr>
                            <!-- Biaya -->
                            <td><?= esc($membership['membership_name']); ?></td>
                            <td>Rp<?= number_format($membership['biaya_bulanan'], 0, ',', '.'); ?></td>
                            <td>Rp<?= number_format($membership['biaya_pendaftaran'], 0, ',', '.'); ?></td>
                            <!-- Limit -->
                            <td><?= esc($membership['branch_limit']); ?></td>
                            <td><?= esc($membership['daily_transaction_limit']); ?></td>
                            <td><?= esc($membership['daily_product_addition_limit']); ?></td>
                            <td><?= esc($membership['user_limit']); ?></td>
                            <!-- Fitur -->
                            <td><?= $membership['wholesale_feature'] ? 'Ya' : 'Tidak'; ?></td>

                            <td><?= $membership['customer_contact_feature'] ? 'Ya' : 'Tidak'; ?></td>
                            <td><?= $membership['stock_audit_feature'] ? 'Ya' : 'Tidak'; ?></td>
                            <td><?= $membership['log_activity_feature'] ? 'Ya' : 'Tidak'; ?></td>
                            <td><?= $membership['cashier_receipt_printing_feature'] ? 'Ya' : 'Tidak'; ?></td>
                            <td><?= $membership['discount_feature'] ? 'Ya' : 'Tidak'; ?></td>
                            <!-- <td>/*?= $membership['product_image_feature'] ? 'Ya' : 'Tidak'; ?></td> -->
                            <td><?= $membership['low_stock_reminder_feature'] ? 'Ya' : 'Tidak'; ?></td>
                            <!-- <td>/* $membership['shortcut_feature'] ? 'Ya' : 'Tidak'; ?></td>
                            <td>$membership['custom_shortcut_feature'] ? 'Ya' : 'Tidak'; *</td> -->
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="18" class="text-center">Tidak ada data membership tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>


    </div>
</section>
<section class="py-5">
    <div class="px-4">
        <h3 class="text-center mb-4">Kenapa Memilih Membership Kami?</h3>
        <p>
            Di era modern ini, teknologi memainkan peranan penting dalam mendukung bisnis yang lebih efisien dan terorganisir. Aplikasi kasir kami hadir untuk membantu Anda, pemilik usaha, dalam mengelola bisnis dengan lebih baik.
            Kami memahami bahwa setiap bisnis memiliki kebutuhan yang berbeda, itulah mengapa kami menyediakan berbagai pilihan paket membership yang dapat disesuaikan dengan skala usaha Anda.
        </p>
        <h4>1. Paket Free</h4>
        <p>
            <strong>Paket Free</strong> adalah solusi ideal untuk Anda yang baru memulai bisnis kecil-kecilan atau ingin mencoba aplikasi kami tanpa biaya. Paket ini menawarkan akses dasar yang mencakup fitur-fitur penting untuk mempermudah operasional Anda, seperti pencatatan penjualan dan manajemen produk.
            Meski gratis, Anda tetap mendapatkan dukungan teknis dasar untuk membantu memulai perjalanan bisnis Anda.
        </p>
        <h4>2. Paket Bronze</h4>
        <p>
            Dengan biaya yang sangat terjangkau, <strong>Paket Bronze</strong> menawarkan fitur lebih dibandingkan paket gratis. Paket ini dirancang untuk bisnis kecil hingga menengah yang ingin meningkatkan efisiensi operasional.
            Anda akan mendapatkan limit transaksi harian yang lebih tinggi, dukungan untuk mencetak nota servis, dan kemampuan untuk mengelola lebih banyak pengguna. Ini adalah langkah awal yang sempurna untuk mulai memperluas bisnis Anda.
        </p>
        <h4>3. Paket Silver</h4>
        <p>
            <strong>Paket Silver</strong> adalah pilihan terbaik untuk Anda yang ingin mendapatkan manfaat lebih. Dengan paket ini, Anda dapat menikmati fitur grosir yang memungkinkan Anda melayani pembelian dalam jumlah besar dengan mudah.
            Tidak hanya itu, paket ini memberikan laporan transaksi yang lebih rinci, sehingga Anda dapat memantau performa bisnis Anda dengan lebih baik. Paket ini cocok untuk toko ritel yang berkembang dan ingin lebih memahami kebutuhan pelanggan.
        </p>
        <h4>4. Paket Gold</h4>
        <p>
            Jika Anda adalah pemilik bisnis besar dengan berbagai cabang, <strong>Paket Gold</strong> adalah pilihan sempurna. Anda akan mendapatkan limit pengguna dan cabang yang jauh lebih besar, ditambah dengan fitur lokasi produk untuk membantu Anda mengelola stok di berbagai tempat.
            Paket ini juga menawarkan laporan analisis yang lebih mendalam, membantu Anda mengambil keputusan strategis yang lebih baik untuk mengoptimalkan pendapatan.
        </p>
        <h4>5. Paket Platinum</h4>
        <p>
            <strong>Paket Platinum</strong> adalah solusi eksklusif untuk Anda yang membutuhkan semua fitur canggih dalam satu paket. Dengan paket ini, Anda dapat menikmati fitur audit stok, pengingat stok habis, hingga log aktivitas pengguna untuk memastikan semua berjalan dengan baik.
            Dukungan teknis 24/7 juga tersedia untuk memastikan bisnis Anda selalu beroperasi tanpa hambatan. Paket ini dirancang untuk pemilik usaha yang ingin membawa bisnis mereka ke level berikutnya.
        </p>
        <h3 class="text-center mt-4">Pilih yang Tepat untuk Anda!</h3>
        <p>
            Dengan berbagai pilihan paket yang kami tawarkan, Anda tidak hanya mendapatkan aplikasi kasir, tetapi juga mitra teknologi untuk mendukung perjalanan bisnis Anda. Semua fitur dirancang untuk memberikan kemudahan, efisiensi, dan keuntungan yang maksimal.
            Anda dapat memulai dengan paket Free untuk mencoba, lalu meningkatkan ke paket yang lebih tinggi saat kebutuhan bisnis Anda berkembang.
        </p>
        <p>
            Jangan tunggu lagi! Bergabunglah dengan ribuan pemilik usaha lainnya yang telah merasakan manfaat dari aplikasi kami.
            Investasikan pada teknologi yang akan membawa bisnis Anda lebih maju. Kunjungi halaman membership kami untuk memilih paket yang sesuai dengan kebutuhan Anda.
        </p>
        <h4 class="text-center mt-4">Ayo, Digitalisasi Bisnis Anda Sekarang!</h4>
    </div>
</section>

<?= $this->endSection(); ?>
<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<section class="py-5 bg-dark text-white">
    <div class="text-center mb-5">
        <h1 class="display-4">Testimoni Pengguna</h1>
        <p class="lead">Apa kata pelanggan kami tentang aplikasi kasir modern yang kami tawarkan?</p>
    </div>
    <div class="row px-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-light mb-4 bg-secondary">
                <div class="card-body">
                    <p class="card-text">
                        "Aplikasi ini sangat membantu bisnis saya. Dengan fitur laporan yang lengkap, saya dapat memantau penjualan dengan mudah!"
                    </p>
                    <h5 class="card-title">Budi Santoso</h5>
                    <p class="card-subtitle text-muted">Pemilik Minimarket</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-light mb-4 bg-secondary">
                <div class="card-body">
                    <p class="card-text">
                        "Integrasi pembayaran digital benar-benar mempermudah pelanggan saya. Selain itu, manajemen stoknya sangat praktis!"
                    </p>
                    <h5 class="card-title">Maria</h5>
                    <p class="card-subtitle text-muted">Pemilik Toko Kelontong</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-light mb-4 bg-secondary">
                <div class="card-body">
                    <p class="card-text">
                        "Aplikasi kasir modern ini sangat mudah digunakan. Dukungan timnya juga luar biasa cepat dan membantu!"
                    </p>
                    <h5 class="card-title">Rizky</h5>
                    <p class="card-subtitle text-muted">Pemilik Konter HP</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-light mb-4 bg-secondary">
                <div class="card-body">
                    <p class="card-text">
                        "Fitur grosirnya luar biasa! Saya bisa mengatur harga khusus untuk pelanggan yang membeli dalam jumlah banyak."
                    </p>
                    <h5 class="card-title">Andi</h5>
                    <p class="card-subtitle text-muted">Pemilik Grosir</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-light mb-4 bg-secondary">
                <div class="card-body">
                    <p class="card-text">
                        "Manajemen stoknya sangat membantu bisnis saya. Saya tidak pernah lagi kehabisan barang yang populer."
                    </p>
                    <h5 class="card-title">Siti</h5>
                    <p class="card-subtitle text-muted">Pemilik Minimarket</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-light mb-4 bg-secondary">
                <div class="card-body">
                    <p class="card-text">
                        "Tampilan aplikasinya sangat ramah pengguna. Bahkan staf saya yang tidak paham teknologi pun bisa langsung menggunakannya."
                    </p>
                    <h5 class="card-title">Lukman</h5>
                    <p class="card-subtitle text-muted">Pemilik Supermarket</p>
                </div>
            </div>
        </div>
    </div>
    <!-- New Testimonial -->
    <div class="row px-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-light mb-4 bg-secondary">
                <div class="card-body">
                    <p class="card-text">
                        "Saya tidak perlu ribet install aplikasi pada komputer dan memanggil tim IT khusus untuk menjalankan aplikasi kasir ini, cukup buka browser dan langsung bisa transaksi online. Ini solusi sempurna untuk bisnis saya!"
                    </p>
                    <h5 class="card-title">Agus Pratama</h5>
                    <p class="card-subtitle text-muted">Pemilik Cafe & Restoran</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End of New Testimonial -->
    <div class="text-center mt-5">
        <h2 class="mb-4">Bagaimana dengan Anda?</h2>
        <p>Rasakan manfaat aplikasi kasir modern kami dan jadilah bagian dari pelanggan yang puas.</p>
        <a href="<?= base_url('/membership/details'); ?>" class="btn btn-primary btn-lg">Lihat Paket Membership</a>
    </div>
</section>

<?= $this->endSection(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/front/testimonials.blade.php ENDPATH**/ ?>
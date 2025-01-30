@extends('layouts.main')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="display-4 text-light">Solusi Kasir Modern untuk Bisnis Anda</h1>
        <p class="lead text-light">
            Selamat datang di era baru pengelolaan bisnis! Kami hadir dengan solusi kasir modern yang akan membawa efisiensi, kemudahan, dan profitabilitas ke toko Anda. Tingkatkan operasional Anda, kelola stok dengan cerdas, dan maksimalkan keuntungan dengan teknologi kasir terkini. Kami berkomitmen untuk membantu bisnis Anda berkembang pesat di era digital yang kompetitif ini.
        </p>
        <div class="mt-4">
            <a href="#features" class="btn btn-light btn-lg me-2">
                <i class="fas fa-search me-2"></i> Pelajari Lebih Lanjut
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
            </a>
        </div>
    </div>
</section>

<!-- Tentang Aplikasi -->
<section class="about">
    <div class="container">
        <h2 class="text-center mb-4 text-light">Mengapa Memilih Aplikasi Kami?</h2>
        <div class="row align-items-start">
            <div class="col-md-6">
                <p class="text-light about-description">
                    Aplikasi kasir kami bukan sekadar alat transaksi, melainkan sebuah sistem cerdas yang dirancang untuk mempermudah setiap aspek operasional toko Anda. Kami mengerti bahwa setiap bisnis unik, oleh karena itu, kami menghadirkan solusi yang fleksibel dan dapat disesuaikan untuk berbagai jenis usaha. Dari manajemen stok yang akurat hingga laporan penjualan yang detail, kami menyediakan semua yang Anda butuhkan untuk mengoptimalkan kinerja bisnis Anda. Rasakan kemudahan penggunaan, fitur-fitur canggih yang inovatif, serta biaya yang sangat hemat dan terjangkau.
                </p>
            </div>
            <div class="col-md-6">
                <ul class="list-unstyled text-light about-list">
                    <li style="padding: 5px 0;">
                        <i class="fas fa-user-check me-2"></i> Ramah Pengguna: Antarmuka yang intuitif dan mudah dipelajari, bahkan untuk pemula sekalipun.
                    </li>
                    <li style="padding: 5px 0;">
                        <i class="fas fa-clock me-2"></i> Hemat Waktu: Proses transaksi dan pengelolaan data menjadi lebih cepat dan efisien, memungkinkan Anda fokus pada pertumbuhan bisnis.
                    </li>
                    <li style="padding: 5px 0;">
                        <i class="fas fa-money-bill-wave me-2"></i> Hemat Biaya: Solusi kasir berkualitas tinggi dengan harga yang terjangkau, membantu Anda memaksimalkan keuntungan.
                    </li>
                    <li style="padding: 5px 0;">
                        <i class="fas fa-sitemap me-2"></i> Dukungan Multi-Outlet: Pantau dan kelola seluruh cabang bisnis Anda dalam satu platform terpusat, memberikan kendali penuh di tangan Anda.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Fitur Utama -->
<section id="features" class="features bg-dark text-light">
    <div class="container">
        <h2 class="text-center mb-4">Fitur Lengkap untuk Semua Kebutuhan Anda</h2>
        <p class="text-center text-light mb-5">
            Kami tidak hanya menawarkan fitur, tetapi juga solusi komprehensif yang dirancang untuk membantu Anda mengelola bisnis dengan lebih efektif dan efisien. Fitur-fitur kami didesain untuk kemudahan Anda dan untuk meningkatkan produktivitas tim. Mari kita jelajahi lebih lanjut apa saja yang dapat kami tawarkan:
        </p>
        <div class="row text-center">
            <div class="col-md-4 feature-item">
                <div style="font-size: 3rem; color: #ffdd57;">📦</div>
                <h4>Manajemen Stok</h4>
                <p>
                    Lacak stok secara real-time dengan akurat, kelola persediaan dengan mudah, dan hindari kerugian akibat kekurangan atau kelebihan stok. Sistem kami memberikan notifikasi otomatis saat stok menipis, membantu Anda selalu siap memenuhi permintaan pelanggan.
                </p>
            </div>
            <div class="col-md-4 feature-item">
                <div style="font-size: 3rem; color: #ffdd57;">📊</div>
                <h4>Laporan Penjualan</h4>
                <p>
                    Dapatkan laporan harian, mingguan, dan bulanan secara otomatis, lengkap dengan analisis data yang mendalam. Dengan laporan yang akurat, Anda dapat membuat keputusan bisnis yang lebih cerdas, mengidentifikasi tren, serta memantau performa produk.
                </p>
            </div>
            <div class="col-md-4 feature-item">
                <div style="font-size: 3rem; color: #ffdd57;">💳</div>
                <h4>Pembayaran Digital</h4>
                <p>
                    Integrasi dengan berbagai e-wallet, transfer bank, dan kartu kredit, untuk memberikan kemudahan dan kenyamanan transaksi bagi pelanggan Anda. Kami mendukung berbagai metode pembayaran populer untuk memastikan semua transaksi berjalan lancar.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Solusi untuk Berbagai Bisnis -->
<section id="business-solutions" class="business-solutions bg-dark text-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Solusi Sempurna untuk Berbagai Jenis Usaha</h2>
        <div class="row g-4">
            <!-- Retail/Minimarket -->
            <div class="col-md-4">
                <div class="business-card">
                    <div class="card bg-dark text-light p-4 h-100 solution-card">
                        <h4><i class="fas fa-store me-2"></i>Retail/Minimarket</h4>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Manajemen stok real-time</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Pencatatan transaksi otomatis</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Laporan penjualan detail</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Multi outlet support</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Toko HP & Aksesoris -->
            <div class="col-md-4">
                <div class="business-card">
                    <div class="card bg-dark text-light p-4 h-100 solution-card">
                        <h4><i class="fas fa-mobile-alt me-2"></i>Toko HP & Aksesoris</h4>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Tracking stok akurat</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Manajemen supplier</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Laporan pendapatan detail</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Sistem garansi produk</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Fashion/Pakaian -->
            <div class="col-md-4">
                <div class="business-card">
                    <div class="card bg-dark text-light p-4 h-100 solution-card">
                        <h4><i class="fas fa-tshirt me-2"></i>Fashion/Pakaian</h4>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Manajemen inventori size</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Kategori produk detail</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Laporan tren penjualan</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Multiple cabang toko</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Cafe/Restaurant -->
            <div class="col-md-4">
                <div class="business-card">
                    <div class="card bg-dark text-light p-4 h-100 solution-card">
                        <h4><i class="fas fa-utensils me-2"></i>Cafe/Restaurant</h4>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Manajemen menu digital</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Tracking bahan baku</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Laporan penjualan menu</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Sistem meja/reservasi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Toko Kosmetik -->
            <div class="col-md-4">
                <div class="business-card">
                    <div class="card bg-dark text-light p-4 h-100 solution-card">
                        <h4><i class="fas fa-pump-soap me-2"></i>Toko Kosmetik</h4>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Monitoring expired date</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Tracking batch produk</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Manajemen supplier</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Sistem membership</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Toko Buku/ATK -->
            <div class="col-md-4">
                <div class="business-card">
                    <div class="card bg-dark text-light p-4 h-100 solution-card">
                        <h4><i class="fas fa-book me-2"></i>Toko Buku/ATK</h4>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Katalog produk lengkap</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Manajemen inventori</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Laporan best seller</li>
                            <li><i class="fas fa-check-circle me-2 text-success"></i>Sistem diskon/promo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Paket Membership -->
<section id="membership" class="membership bg-dark text-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Pilih Paket yang Sesuai untuk Bisnis Anda</h2>
        <div class="row g-4 justify-content-center">
            @foreach($memberships as $membership)
            <div class="col-md-4">
                <div class="card bg-dark membership-card h-100">
                    <div class="card-header text-center border-bottom border-light border-opacity-25">
                        <h3 class="membership-title mb-0">{{ $membership->membership_name }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="price-tag text-center mb-4">
                            <h4 class="text-primary mb-2">Rp {{ number_format($membership->biaya_bulanan, 0, ',', '.') }}</h4>
                            <span class="text-muted">per bulan</span>
                        </div>
                        <ul class="feature-list list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                {{ $membership->branch_limit }} Cabang
                            </li>
                            @if($membership->service_feature)
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Fitur Layanan Service
                            </li>
                            @endif
                            @if($membership->product_image_feature)
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Gambar Produk
                            </li>
                            @endif
                            @if($membership->discount_feature)
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Fitur Diskon
                            </li>
                            @endif
                            @if($membership->stock_correction_feature)
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Koreksi Stok
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-footer text-center border-top border-light border-opacity-25">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg w-100">
                            Pilih Paket
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimoni -->
<section id="testimonials" class="testimonials bg-dark text-light">
    <div class="container">
        <h2 class="text-center mb-4">Apa Kata Pelanggan Kami?</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-dark text-light testimonial-card">
                    <div class="card-body">
                        <p class="card-text">
                            "Aplikasi ini sangat membantu toko saya. Saya bisa memantau penjualan kapan saja dan di mana saja. Sangat praktis dan efisien!"
                        </p>
                        <h5 class="card-title">Budi Santoso</h5>
                        <p class="card-subtitle text-muted">Pemilik Minimarket</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark text-light testimonial-card">
                    <div class="card-body">
                        <p class="card-text">
                            "Fitur laporan penjualannya sangat lengkap dan mudah dipahami. Saya jadi lebih mudah dalam mengambil keputusan bisnis. Terima kasih!"
                        </p>
                        <h5 class="card-title">Maria</h5>
                        <p class="card-subtitle text-muted">Pemilik Toko Kelontong</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark text-light testimonial-card">
                    <div class="card-body">
                        <p class="card-text">
                            "Integrasi pembayaran digital sangat memudahkan pelanggan saya. Transaksi menjadi lebih cepat dan saya tidak perlu repot dengan uang tunai lagi!"
                        </p>
                        <h5 class="card-title">Rizky</h5>
                        <p class="card-subtitle text-muted">Pemilik Konter HP</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    body {
        background-color: #343a40;
    }
    .feature-list {
        margin-top: 20px;
    }
    .feature-item {
        transition: transform 0.3s ease;
        cursor: pointer;
        position: relative;
        padding: 20px;
    }
    .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    .feature-item::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.05);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .feature-item:hover::before {
        opacity: 1;
    }
    .feature-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: #fff;
    }
    .feature-description {
        font-size: 1rem;
        color: #f8f9fa;
        margin-bottom: 15px;
        line-height: 1.6;
    }
    .testimonial-card {
        transition: transform 0.3s ease;
    }
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    .about-description {
        margin-bottom: 20px;
    }
    .about-list {
        padding-left: 20px;
    }
    .about .row {
        display: flex;
        flex-direction: row; /* Ensure items are in a row */
        align-items: flex-start; /* Align items to the start of the row (top) */
    }
    .solution-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .solution-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .solution-card h4 {
        color: #007bff;
        margin-bottom: 1rem;
    }

    .solution-card ul li {
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .solution-card i.fas.fa-check-circle {
        color: #28a745;
    }

    .business-solutions {
        padding: 80px 0;
        background: linear-gradient(to bottom, #1a1c1e, #2d3436);
    }

    .membership-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .membership-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .membership-title {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .price-tag h4 {
        font-size: 2rem;
        color: #4285f4;
    }

    .feature-list li {
        padding: 8px 0;
        color: rgba(255, 255, 255, 0.8);
    }

    .membership-card .btn-primary {
        background: linear-gradient(45deg, #007bff, #00264d);
        border: none;
        padding: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .membership-card .btn-primary:hover {
        background: linear-gradient(45deg, #00264d, #007bff);
        transform: translateY(-2px);
    }
</style>
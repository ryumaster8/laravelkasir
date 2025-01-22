<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kasir Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Header */
        header {
            background: linear-gradient(90deg, #0d6efd, #5a9aff);
            color: white;
            padding: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header .nav-link {
            color: white;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        header .nav-link:hover {
            color: #ffdd57;
        }

        /* Hero Section */
        .hero {
            background: url('https://via.placeholder.com/1920x600') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 100px 0;
            background-blend-mode: overlay;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .hero a {
            margin-top: 20px;
            padding: 12px 24px;
            font-size: 1.2rem;
            border-radius: 30px;
        }

        /* Section Title */
        section h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #0d6efd;
        }

        /* Membership Cards */
        .membership-card {
            border: none;
            background: #fff;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .membership-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .membership-card h3 {
            color: #0d6efd;
            font-weight: bold;
        }

        .membership-card .btn {
            margin-top: 20px;
            padding: 10px 20px;
            border-radius: 30px;
        }

        /* Testimoni Cards */
        .testimonials .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .testimonials .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background: linear-gradient(90deg, #0d6efd, #5a9aff);
            color: white;
            text-align: center;
            padding: 30px 0;
            margin-top: 40px;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }

        footer a {
            color: #ffdd57;
            font-weight: bold;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <!-- Header -->
    <header>
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">DigiSoft</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="<?= base_url('/') ?>" class="nav-link" style="color: white;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/#features') ?>" class="nav-link" style="color: white;">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/#membership') ?>" class="nav-link" style="color: white;">Paket</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/#testimonials') ?>" class="nav-link" style="color: white;">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/#contact') ?>" class="nav-link" style="color: white;">Hubungi Kami</a>
                    </li>
                </ul>

            </nav>
            <a href="#cta" class="btn btn-light">Coba Gratis</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4">Solusi Kasir Modern untuk Bisnis Anda</h1>
            <p class="lead">Tingkatkan efisiensi dan profit toko Anda dengan teknologi kasir terkini.</p>
            <a href="#features" class="btn btn-primary btn-lg me-2">Pelajari Lebih Lanjut</a>
            <a href="#cta" class="btn btn-outline-light btn-lg">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Tentang Aplikasi -->
    <section class="about">
        <div class="container">
            <h2 class="text-center mb-4">Mengapa Memilih Aplikasi Kami?</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>Aplikasi kasir kami dirancang untuk mempermudah operasional toko Anda. Didesain khusus untuk berbagai jenis usaha, aplikasi ini dilengkapi fitur lengkap, mudah digunakan, dan hemat biaya.</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li style="padding: 5px 0;">✅ Ramah Pengguna</li>
                        <li style="padding: 5px 0;">✅ Hemat Waktu</li>
                        <li style="padding: 5px 0;">✅ Hemat Biaya</li>
                        <li style="padding: 5px 0;">✅ Dukungan Multi-Outlet</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section id="features" class="features">
        <div class="container">
            <h2 class="text-center mb-4">Fitur Lengkap untuk Semua Kebutuhan Anda</h2>
            <div class="row text-center">
                <div class="col-md-4">
                    <div style="font-size: 3rem; color: #0d6efd;">📦</div>
                    <h4>Manajemen Stok</h4>
                    <p>Lacak stok secara real-time dan hindari kekurangan barang.</p>
                </div>
                <div class="col-md-4">
                    <div style="font-size: 3rem; color: #0d6efd;">📊</div>
                    <h4>Laporan Penjualan</h4>
                    <p>Dapatkan laporan harian, mingguan, dan bulanan dengan mudah.</p>
                </div>
                <div class="col-md-4">
                    <div style="font-size: 3rem; color: #0d6efd;">💳</div>
                    <h4>Pembayaran Digital</h4>
                    <p>Integrasi dengan e-wallet, transfer bank, dan kartu kredit.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="membership" class="container my-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Pilih Membership yang Tepat untuk Anda</h2>
            <p>Dari Free hingga Platinum, kami hadir untuk mendukung kesuksesan bisnis Anda. Pilih paket yang sesuai dan nikmati fitur-fitur unggulan kami.</p>
        </div>
        <div class="row justify-content-center text-center">
            <?php foreach ($memberships as $membership): ?>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="card membership-card border-primary">
                        <div class="card-body">
                            <h3 class="card-title"><?= esc($membership['membership_name']); ?></h3>
                            <p class="card-text text-muted">Rp<?= number_format($membership['biaya_bulanan'], 0, ',', '.'); ?> / bulan</p>
                            <h4 class="fw-bold">Limit Cabang: <?= esc($membership['branch_limit']); ?></h4>
                            <ul class="feature-list text-start">
                                <li>Limit Transaksi Harian: <?= esc($membership['daily_transaction_limit']); ?></li>
                                <li>Limit Penambahan Produk Harian: <?= esc($membership['daily_product_addition_limit']); ?></li>
                                <li>Limit Pengguna: <?= esc($membership['user_limit']); ?></li>
                                <li>Fitur Grosir: <?= $membership['wholesale_feature'] ? 'Ya' : 'Tidak'; ?></li>
                                <li>Fitur Chat: <?= $membership['chat_feature'] ? 'Ya' : 'Tidak'; ?></li>
                            </ul>
                            <a href="<?= base_url('home/membership/' . $membership['id']); ?>" class="btn btn-outline-primary">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>




    <!-- Testimoni -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <h2 class="text-center mb-4">Apa Kata Pelanggan Kami?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"Aplikasi ini sangat membantu toko saya. Saya bisa memantau penjualan kapan saja!"</p>
                            <h5 class="card-title">Budi Santoso</h5>
                            <p class="card-subtitle text-muted">Pemilik Minimarket</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"Fitur laporan penjualannya sangat lengkap. Saya jadi tahu produk mana yang paling laris."</p>
                            <h5 class="card-title">Maria</h5>
                            <p class="card-subtitle text-muted">Pemilik Toko Kelontong</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"Integrasi pembayaran digital sangat memudahkan pelanggan saya!"</p>
                            <h5 class="card-title">Rizky</h5>
                            <p class="card-subtitle text-muted">Pemilik Konter HP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <p>© 2024 Aplikasi Kasir Modern. All Rights Reserved.</p>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="#" class="nav-link" style="color: white;">Facebook</a></li>
                <li class="nav-item"><a href="#" class="nav-link" style="color: white;">Twitter</a></li>
                <li class="nav-item"><a href="#" class="nav-link" style="color: white;">Instagram</a></li>
            </ul>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
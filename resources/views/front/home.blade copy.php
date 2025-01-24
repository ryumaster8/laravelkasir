@extends('layouts.main')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="display-4 text-light">Solusi Kasir Modern untuk Bisnis Anda</h1>
        <p class="lead text-light">Tingkatkan efisiensi dan profit toko Anda dengan teknologi kasir terkini.</p>
        <div class="mt-4">
            <a href="#features" class="btn btn-light btn-lg me-2">Pelajari Lebih Lanjut</a>
            <a href="#cta" class="btn btn-outline-light btn-lg">Daftar Sekarang</a>
        </div>
    </div>
</section>

<!-- Tentang Aplikasi -->
<section class="about">
    <div class="container">
        <h2 class="text-center mb-4 text-light">Mengapa Memilih Aplikasi Kami?</h2>
        <div class="row">
            <div class="col-md-6">
                <p class="text-light">Aplikasi kasir kami dirancang untuk mempermudah operasional toko Anda. Didesain khusus untuk berbagai jenis usaha, aplikasi ini dilengkapi fitur lengkap, mudah digunakan, dan hemat biaya.</p>
            </div>
            <div class="col-md-6">
                <ul class="list-unstyled text-light">
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
<section id="features" class="features bg-dark text-light">
    <div class="container">
        <h2 class="text-center mb-4">Fitur Lengkap untuk Semua Kebutuhan Anda</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <div style="font-size: 3rem; color: #ffdd57;">📦</div>
                <h4>Manajemen Stok</h4>
                <p>Lacak stok secara real-time dan hindari kekurangan barang.</p>
            </div>
            <div class="col-md-4">
                <div style="font-size: 3rem; color: #ffdd57;">📊</div>
                <h4>Laporan Penjualan</h4>
                <p>Dapatkan laporan harian, mingguan, dan bulanan dengan mudah.</p>
            </div>
            <div class="col-md-4">
                <div style="font-size: 3rem; color: #ffdd57;">💳</div>
                <h4>Pembayaran Digital</h4>
                <p>Integrasi dengan e-wallet, transfer bank, dan kartu kredit.</p>
            </div>
        </div>
    </div>
</section>

<!-- Paket Membership -->
<section id="membership" class="container my-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-light">Pilih Membership yang Tepat untuk Anda</h2>
        <p class="text-light">Dari Free hingga Platinum, kami hadir untuk mendukung kesuksesan bisnis Anda. Pilih paket yang sesuai dan nikmati fitur-fitur unggulan kami.</p>
    </div>
    <div class="row justify-content-center text-center">
        @foreach ($memberships as $membership)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card membership-card border-warning bg-dark text-light" style="transform: scale(1.05);">
                    <div class="card-body">
                        <h3 class="card-title">{{ $membership->membership_name }}</h3>
                        <p class="card-text text-muted">Rp{{ number_format($membership->biaya_bulanan, 0, ',', '.') }} / bulan</p>
                        <h4 class="fw-bold">Limit Cabang: {{ $membership->branch_limit }}</h4>
                        <ul class="feature-list text-start">
                            <li>Limit Transaksi Harian: {{ $membership->daily_transaction_limit }}</li>
                            <li>Limit Penambahan Produk Harian: {{ $membership->daily_product_addition_limit }}</li>
                            <li>Limit Pengguna: {{ $membership->user_limit }}</li>
                            <li>Fitur Grosir: {{ $membership->wholesale_feature ? 'Ya' : 'Tidak' }}</li>
                            <li>Fitur Chat: {{ $membership->chat_feature ? 'Ya' : 'Tidak' }}</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-outline-warning">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Testimoni -->
<section id="testimonials" class="testimonials bg-dark text-light">
    <div class="container">
        <h2 class="text-center mb-4">Apa Kata Pelanggan Kami?</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <p class="card-text">"Aplikasi ini sangat membantu toko saya. Saya bisa memantau penjualan kapan saja!"</p>
                        <h5 class="card-title">Budi Santoso</h5>
                        <p class="card-subtitle text-muted">Pemilik Minimarket</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <p class="card-text">"Fitur laporan penjualannya sangat lengkap. Saya jadi tahu produk mana yang paling laris."</p>
                        <h5 class="card-title">Maria</h5>
                        <p class="card-subtitle text-muted">Pemilik Toko Kelontong</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark text-light">
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
@endsection
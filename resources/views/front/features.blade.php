@extends('layouts.main')

@section('content')
<section class="py-16 px-4 max-w-7xl mx-auto">
    <h1 class="text-4xl font-bold text-center my-24 text-white">Fitur Unggulan Aplikasi Kasir Modern</h1>
    <p class="text-xl text-center text-gray-300 mb-16">Temukan fitur-fitur terbaik yang dirancang untuk membantu bisnis Anda tumbuh dan sukses di era digital.</p>

    <div class="space-y-16">
        <!-- Manajemen Stok -->
        <div class="feature-block">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">1. Manajemen Stok yang Efisien</h2>
            <p class="text-gray-300">
                Jangan biarkan stok Anda menjadi masalah besar. Dengan fitur <span class="font-semibold">Manajemen Stok</span>, 
                Anda dapat melacak ketersediaan barang secara real-time, menghindari kekurangan stok, dan bahkan mendapatkan 
                pengingat untuk barang-barang yang hampir habis. Sistem kami dirancang untuk mempermudah Anda mengelola stok 
                dengan antarmuka yang sederhana dan ramah pengguna.
            </p>
        </div>

        <!-- Laporan Penjualan -->
        <div class="feature-block">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">2. Laporan Penjualan yang Detail</h2>
            <p class="text-gray-300">
                Ketahui dengan pasti bagaimana performa penjualan Anda. Fitur <span class="font-semibold">Laporan Penjualan</span> 
                memberikan Anda laporan harian, mingguan, hingga bulanan secara otomatis. Semua data ini dapat diakses dengan mudah, 
                membantu Anda membuat keputusan yang lebih cerdas dan strategis untuk bisnis Anda.
            </p>
        </div>

        <!-- Multi-Outlet -->
        <div class="feature-block">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">3. Dukungan Multi-Outlet</h2>
            <p class="text-gray-300">
                Apakah Anda memiliki lebih dari satu cabang? Tidak masalah! Aplikasi kami dirancang untuk mendukung 
                <span class="font-semibold">Multi-Outlet</span>. Anda dapat memantau penjualan, stok, dan laporan dari 
                semua cabang dalam satu platform terpusat.
            </p>
        </div>

        <!-- More features... -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
            <div class="feature-card">
                <h3 class="text-xl font-bold text-yellow-400 mb-3">Integrasi Pembayaran Digital</h3>
                <p class="text-gray-300">Terima pembayaran melalui e-wallet, transfer bank, dan kartu kredit dengan mudah.</p>
            </div>
            
            <div class="feature-card">
                <h3 class="text-xl font-bold text-yellow-400 mb-3">Pengingat Stok Habis</h3>
                <p class="text-gray-300">Dapatkan notifikasi otomatis saat stok produk hampir habis.</p>
            </div>
            
            <div class="feature-card">
                <h3 class="text-xl font-bold text-yellow-400 mb-3">Fitur Diskon</h3>
                <p class="text-gray-300">Kelola berbagai jenis diskon dan promosi dengan mudah.</p>
            </div>
            
            <div class="feature-card">
                <h3 class="text-xl font-bold text-yellow-400 mb-3">Kustomisasi Nota Kasir</h3>
                <p class="text-gray-300">Sesuaikan nota kasir dengan branding bisnis Anda.</p>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-16">
            <h2 class="text-3xl font-bold text-white mb-6">Mulai Digitalisasi Bisnis Anda Sekarang!</h2>
            <p class="text-gray-300 mb-8 max-w-2xl mx-auto">
                Jangan biarkan bisnis Anda tertinggal di era digital ini. Dengan aplikasi kasir modern kami, 
                Anda bisa mengelola bisnis dengan lebih efisien.
            </p>
            <a href="{{ route('membership.details') }}" 
               class="inline-block bg-yellow-400 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
                Lihat Paket Membership
            </a>
        </div>
    </div>
</section>

<style>
    .feature-block {
        @apply bg-gray-800 rounded-lg p-8 shadow-lg hover:bg-gray-700 transition-colors duration-300;
    }
    
    .feature-card {
        @apply bg-gray-800 rounded-lg p-6 shadow-lg hover:bg-gray-700 transition-colors duration-300;
    }
</style>
@endsection
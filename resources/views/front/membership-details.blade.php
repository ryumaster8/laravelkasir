@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mt-4 mb-4 text-center">Daftar Paket Membership</h2>

    <div class="mt-4 mb-4 text-center">
        <p>
            Di era modern ini, teknologi memainkan peranan penting dalam mendukung bisnis yang lebih efisien dan terorganisir. Aplikasi kasir kami hadir untuk membantu Anda, pemilik usaha, dalam mengelola bisnis dengan lebih baik. Kami memahami bahwa setiap bisnis memiliki kebutuhan yang berbeda, itulah mengapa kami menyediakan berbagai pilihan paket membership yang dapat disesuaikan dengan skala usaha Anda.
        </p>
    </div>

    <h3 class="mt-4 mb-3">Kenapa Memilih Membership Kami?</h3>
    <div class="mb-4">
        <p>
            Dengan berbagai pilihan paket yang kami tawarkan, Anda tidak hanya mendapatkan aplikasi kasir, tetapi juga mitra teknologi untuk mendukung perjalanan bisnis Anda. Semua fitur dirancang untuk memberikan kemudahan, efisiensi, dan keuntungan yang maksimal. Anda dapat memulai dengan paket Free untuk mencoba, lalu meningkatkan ke paket yang lebih tinggi saat kebutuhan bisnis Anda berkembang.
        </p>
        <p>
        Jangan tunggu lagi! Bergabunglah dengan ribuan pemilik usaha lainnya yang telah merasakan manfaat dari aplikasi kami. Investasikan pada teknologi yang akan membawa bisnis Anda lebih maju. Kunjungi halaman membership kami untuk memilih paket yang sesuai dengan kebutuhan Anda.
        </p>
        <p class="font-weight-bold">
            Ayo, Digitalisasi Bisnis Anda Sekarang!
        </p>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nama Paket</th>
                    <th>Batas Cabang</th>
                    <th>Transaksi Harian</th>
                    <th>Penambahan Produk Harian</th>
                    <th>Batas Pengguna</th>
                    <th>Fitur Service</th>
                    <th>Fitur Grosir</th>
                    <th>Cetak Resi Service</th>
                    <th>Fitur Lokasi Produk</th>
                    <th>Fitur Audit Stok</th>
                    <th>Fitur Cetak Resi Kasir</th>
                    <th>Fitur Diskon</th>
                    <th>Fitur Gambar Produk</th>
                    <th>Fitur Pengingat Stok Rendah</th>
                    <th>Fitur Koreksi Stok</th>
                    <th>Fitur Chat</th>
                    <th>Fitur Laporan Penjualan</th>
                    <th>Fitur Laporan Transaksi</th>
                    <th>Fitur Shortcut</th>
                    <th>Fitur Custom Shortcut</th>
                    <th>Fitur Log Aktifitas</th>
                     <th>Fitur Kontak Pelanggan</th>
                    <th>Biaya Pendaftaran</th>
                    <th>Biaya Bulanan</th>
                    <th>Biaya Upgrade</th>
                    <th>Biaya Downgrade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($memberships as $membership)
                <tr>
                    <td>{{ $membership->membership_name }}</td>
                     <td>{{ $membership->branch_limit === null ? "Tidak Terbatas" : $membership->branch_limit }}</td>
                    <td>{{ $membership->daily_transaction_limit === null ? "Tidak Terbatas" : $membership->daily_transaction_limit }}</td>
                    <td>{{ $membership->daily_product_addition_limit === null ? "Tidak Terbatas" : $membership->daily_product_addition_limit }}</td>
                    <td>{{ $membership->user_limit === null ? "Tidak Terbatas" : $membership->user_limit }}</td>
                    <td>{{ $membership->service_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->wholesale_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->service_receipt_printing ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->product_location_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->stock_audit_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->cashier_receipt_printing ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->discount_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->product_image_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->low_stock_reminder_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->stock_correction_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->chat_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->sales_report_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->transaction_report_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->shortcut_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->custom_shortcut_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->log_activity_feature ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $membership->customer_contact_feature ? 'Ya' : 'Tidak'}}</td>
                    <td>Rp. {{ number_format($membership->biaya_pendaftaran, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($membership->biaya_bulanan, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($membership->biaya_upgrade, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($membership->biaya_downgrade, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

      <h3 class="mt-4 mb-3">Pilihan Paket Membership</h3>
    <div class="mb-4">
        <p>
            <strong>1. Paket Free</strong>
        </p>
         <p>
            Paket Free adalah solusi ideal untuk Anda yang baru memulai bisnis kecil-kecilan atau ingin mencoba aplikasi kami tanpa biaya. Paket ini menawarkan akses dasar yang mencakup fitur-fitur penting untuk mempermudah operasional Anda, seperti pencatatan penjualan dan manajemen produk. Meski gratis, Anda tetap mendapatkan dukungan teknis dasar untuk membantu memulai perjalanan bisnis Anda.
        </p>
        <p>
            <strong>2. Paket Bronze</strong>
        </p>
        <p>
           Dengan biaya yang sangat terjangkau, Paket Bronze menawarkan fitur lebih dibandingkan paket gratis. Paket ini dirancang untuk bisnis kecil hingga menengah yang ingin meningkatkan efisiensi operasional. Anda akan mendapatkan limit transaksi harian yang lebih tinggi, dukungan untuk mencetak nota servis, dan kemampuan untuk mengelola lebih banyak pengguna. Ini adalah langkah awal yang sempurna untuk mulai memperluas bisnis Anda.
        </p>
        <p>
            <strong>3. Paket Silver</strong>
        </p>
         <p>
            Paket Silver adalah pilihan terbaik untuk Anda yang ingin mendapatkan manfaat lebih. Dengan paket ini, Anda dapat menikmati fitur grosir yang memungkinkan Anda melayani pembelian dalam jumlah besar dengan mudah. Tidak hanya itu, paket ini memberikan laporan transaksi yang lebih rinci, sehingga Anda dapat memantau performa bisnis Anda dengan lebih baik. Paket ini cocok untuk toko ritel yang berkembang dan ingin lebih memahami kebutuhan pelanggan.
        </p>
        <p>
           <strong>4. Paket Gold</strong>
        </p>
         <p>
           Jika Anda adalah pemilik bisnis besar dengan berbagai cabang, Paket Gold adalah pilihan sempurna. Anda akan mendapatkan limit pengguna dan cabang yang jauh lebih besar, ditambah dengan fitur lokasi produk untuk membantu Anda mengelola stok di berbagai tempat. Paket ini juga menawarkan laporan analisis yang lebih mendalam, membantu Anda mengambil keputusan strategis yang lebih baik untuk mengoptimalkan pendapatan.
        </p>
        <p>
            <strong>5. Paket Platinum</strong>
        </p>
         <p>
            Paket Platinum adalah solusi eksklusif untuk Anda yang membutuhkan semua fitur canggih dalam satu paket. Dengan paket ini, Anda dapat menikmati fitur audit stok, pengingat stok habis, hingga log aktivitas pengguna untuk memastikan semua berjalan dengan baik. Dukungan teknis 24/7 juga tersedia untuk memastikan bisnis Anda selalu beroperasi tanpa hambatan. Paket ini dirancang untuk pemilik usaha yang ingin membawa bisnis mereka ke level berikutnya.
        </p>
    </div>


</div>
@endsection
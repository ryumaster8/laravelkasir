<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<section class="py-5">
    <div class="text-center mb-5">
        <h1>Hubungi Kami</h1>
        <p class="lead">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami melalui informasi di bawah ini atau formulir kontak yang tersedia.</p>
    </div>
    <div class="row px-4">
        <!-- Kontak dan Lokasi -->
        <div class="col-lg-6 mb-4">
            <h3>Informasi Kontak</h3>
            <p>
                Jika Anda memiliki pertanyaan, butuh bantuan, atau ingin berbicara dengan tim kami, berikut informasi kontak kami:
            </p>
            <ul class="list-unstyled">
                <li><strong>Alamat:</strong> Komplek Pondok Indah
                    Jl. Metro Duta Kav. 17,
                    Pondok Indah, Kebayoran Lama,
                    Jakarta Selatan, DKI Jakarta 12310.</li>

                <li><strong>Email:</strong> <a href="mailto:info@digisoftstudio.com">info@digisoftstudio.com</a></li>
                <li><strong>Jam Operasional:</strong> Senin - Jumat, 08:00 - 17:00</li>
            </ul>
        </div>

        <!-- Form Kontak -->
        <div class="col-lg-6">
            <h3>Formulir Kontak</h3>
            <p>Isi formulir di bawah ini, dan tim kami akan segera menghubungi Anda.</p>
            <form action="<?= base_url('/contact/send'); ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Anda</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Anda</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan Anda</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tuliskan pesan Anda" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
            </form>
        </div>
    </div>

    <!-- Lokasi -->
    <div class="mt-5 px-4">
        <!-- <h3 class="text-center mb-4">Lokasi Kami</h3> -->
        <div class="d-flex justify-content-center">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.660881846736!2d107.60981001538137!3d-7.001453294929144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7d6f8b8c9a3%3A0xefa26dc708dc0ef8!2sExample%20Location!5e0!3m2!1sen!2sid!4v1697728471748!5m2!1sen!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
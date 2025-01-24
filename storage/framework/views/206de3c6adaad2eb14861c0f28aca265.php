<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mt-4 mb-4 text-center">Hubungi Kami</h2>
    <div class="mb-4 text-center">
        <p>
            Kami siap membantu Anda. Jangan ragu untuk menghubungi kami melalui informasi di bawah ini atau formulir kontak yang tersedia.
        </p>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Informasi Kontak</h3>
            <p>
                Jika Anda memiliki pertanyaan, butuh bantuan, atau ingin berbicara dengan tim kami, berikut informasi kontak kami:
            </p>
            <ul class="list-unstyled">
                <li><strong>Alamat:</strong> Komplek Elit Bukit Indah Residence, Jl. Merapi View No. 23, Bukit Indah, Kecamatan Sleman, Yogyakarta 55281, Indonesia.</li>
                <li><strong>Email:</strong> <a href="mailto:info@digisoftstudio.com">info@digisoftstudio.com</a></li>
                <li><strong>Jam Operasional:</strong> Senin - Jumat, 08:00 - 17:00</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h3>Formulir Kontak</h3>
            <p>Isi formulir di bawah ini, dan tim kami akan segera menghubungi Anda.</p>

               <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo e(route('contact.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Anda</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Anda</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan Anda</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="5" placeholder="Tuliskan pesan Anda" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/front/contact.blade.php ENDPATH**/ ?>
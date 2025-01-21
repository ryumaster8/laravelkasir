<?php $__env->startSection('content'); ?>

<?php if (isset($component)) { $__componentOriginalbb0843bd48625210e6e530f88101357e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbb0843bd48625210e6e530f88101357e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-message','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flash-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbb0843bd48625210e6e530f88101357e)): ?>
<?php $attributes = $__attributesOriginalbb0843bd48625210e6e530f88101357e; ?>
<?php unset($__attributesOriginalbb0843bd48625210e6e530f88101357e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbb0843bd48625210e6e530f88101357e)): ?>
<?php $component = $__componentOriginalbb0843bd48625210e6e530f88101357e; ?>
<?php unset($__componentOriginalbb0843bd48625210e6e530f88101357e); ?>
<?php endif; ?>

<div class="p-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-semibold">Dashboard Admin</h2>
        <p class="text-gray-600">Selamat datang di dashboard admin!</p>
    </div>

    <!-- Kasir Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-4">Kasir Ecer</h3>
            <p class="text-gray-600 mb-4">Akses sistem kasir untuk transaksi ecer</p>
            <button onclick="window.location.href='/kasir/ecer'" class="w-full bg-blue-500 text-white py-3 px-4 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Buka Kasir Ecer
            </button>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-4">Kasir Grosir</h3>
            <p class="text-gray-600 mb-4">Akses sistem kasir untuk transaksi grosir</p>
            <button onclick="window.location.href='<?php echo e(route('kasir.select-customer')); ?>'" class="w-full bg-green-500 text-white py-3 px-4 rounded-lg hover:bg-green-600 transition duration-300 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Buka Kasir Grosir
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Baris 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 text-white p-4">
                Ringkasan Transaksi
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Total Transaksi Hari Ini</h5>
                <p class="mb-4">Anda memiliki <strong>15</strong> transaksi baru hari ini.</p>
                <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-green-600 text-white p-4">
                Aktivitas Pengguna
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Pengguna Baru</h5>
                <p class="mb-4">Ada <strong>5</strong> pengguna baru mendaftar dalam 24 jam terakhir.</p>
                <a href="#" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-yellow-500 text-white p-4">
                Statistik Penjualan
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Total Pendapatan Bulan Ini</h5>
                <p class="mb-4"><strong>Rp 10.000.000,-</strong></p>
                <a href="#" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Lihat Detail</a>
            </div>
        </div>

        <!-- Baris 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-cyan-600 text-white p-4">
                Servis Dalam Proses
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Servis Saat Ini</h5>
                <p class="mb-4">Ada <strong>8</strong> servis yang sedang diproses saat ini.</p>
                <a href="/admin/services" class="inline-block px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-red-600 text-white p-4">
                Servis Selesai
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Total Servis Selesai</h5>
                <p class="mb-4">Ada <strong></strong> servis yang telah selesai.</p>
                <a href="/admin/services/completed" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-600 text-white p-4">
                Total Servis
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Servis Keseluruhan</h5>
                <p class="mb-4"><strong></strong> layanan servis telah terdaftar.</p>
                <a href="/admin/services" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Lihat Detail</a>
            </div>
        </div>

        <!-- Baris 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-600 text-white p-4">
                Permintaan Pemindahan Stok
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Permintaan Persetujuan</h5>
                <p class="mb-4">Ada <strong></strong> permintaan pemindahan stok yang menunggu persetujuan.</p>
                <a href="/admin/products/transfer-requests" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 text-white p-4">
                Pengajuan Pemindahan Stok
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Pengajuan Terkini</h5>
                <p class="mb-4">Ada <strong></strong> pengajuan pemindahan stok baru yang menunggu persetujuan.</p>
                <a href="/admin/products/submission-transfer-requests" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lihat Detail</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-cyan-600 text-white p-4">
                Log Aktivitas
            </div>
            <div class="p-4">
                <h5 class="font-medium text-lg mb-2">Catatan Aktivitas</h5>
                <p class="mb-4">Lihat log aktivitas terbaru sistem.</p>
                <a href="/admin/activity-log" class="inline-block px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700">Lihat Log</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function setTypeAndRedirect(type) {
    // Set session type via AJAX
    fetch('/set-kasir-type', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ type: type })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/kasir';
        }
    });
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/auth/dashboard.blade.php ENDPATH**/ ?>
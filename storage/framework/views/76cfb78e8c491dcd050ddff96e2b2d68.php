

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

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Pengambilan Servis</h3>

            <form id="form-pengambilan" action="<?php echo e(route('service.updatePengambilan', $service->service_id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Faktur -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Faktur</label>
                        <input type="text" id="faktur" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50" value="<?php echo e($service->faktur); ?>" readonly>
                    </div>

                    <!-- Outlet -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Outlet</label>
                        <input type="text" id="outlet" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50" value="<?php echo e($outletName); ?>" readonly>
                    </div>

                    <!-- Operator -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Operator</label>
                        <input type="text" id="operator" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50" value="<?php echo e($operatorName); ?>" readonly>
                    </div>

                    <!-- Teknisi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Teknisi</label>
                        <input type="text" id="teknisi" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50" value="<?php echo e($teknisiName); ?>" readonly>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk</label>
                        <input type="date" id="tanggal_masuk" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50" value="<?php echo e($tanggalMasuk); ?>" readonly>
                    </div>

                    <!-- Status Servis -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Servis <span class="text-red-600">*</span></label>
                        <select id="status_servis" name="status_servis" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Status Servis</option>
                            <option value="Berhasil" <?php echo e(old('status_servis', $service->progress_status) === 'Selesai' ? 'selected' : ''); ?>>Berhasil</option>
                            <option value="Gagal" <?php echo e(old('status_servis', $service->progress_status) === 'Dibatalkan' ? 'selected' : ''); ?>>Gagal</option>
                            <option value="Sedang Pengerjaan" <?php echo e(old('status_servis', $service->progress_status) === 'Sedang Proses' ? 'selected' : ''); ?>>Sedang Pengerjaan</option>
                        </select>
                    </div>

                    <!-- Biaya -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Biaya</label>
                        <input type="number" id="biaya" name="biaya" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50" value="<?php echo e($service->biaya); ?>" readonly>
                    </div>

                    <!-- Uang Muka -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Uang Muka</label>
                        <input type="number" id="uang_muka" name="uang_muka" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50" value="<?php echo e($service->uang_muka); ?>" readonly>
                    </div>

                    <!-- Sisa yang Harus Dibayar -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sisa yang Harus Dibayar</label>
                        <input type="number" id="sisa_pembayaran" name="sisa_pembayaran" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50" value="0" readonly>
                        <p id="sisa_pembayaran_info" class="mt-1 text-sm text-gray-500"></p>
                    </div>

                    <!-- Keterangan Pengambilan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Pengambilan</label>
                        <textarea id="description" name="description" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"><?php echo e(old('description', $service->description ?? '')); ?></textarea>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="<?php echo e(url()->previous()); ?>" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Kembali
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelect = document.getElementById('status_servis');
            const biayaInput = document.getElementById('biaya');
            const uangMukaInput = document.getElementById('uang_muka');
            const sisaPembayaranInput = document.getElementById('sisa_pembayaran');
            const sisaPembayaranInfo = document.getElementById('sisa_pembayaran_info');

            function updateSisaPembayaran() {
                const status = statusSelect.value;
                const biaya = parseFloat(biayaInput.value) || 0;
                const uangMuka = parseFloat(uangMukaInput.value) || 0;

                if (status === 'Gagal' || status === 'Dibatalkan') {
                    sisaPembayaranInput.value = 0;
                    sisaPembayaranInfo.textContent = uangMuka > 0
                        ? `Uang yang harus dikembalikan kepada pelanggan sebesar Rp ${uangMuka.toLocaleString()}`
                        : 'Tidak ada uang yang harus dikembalikan kepada pelanggan.';
                } else if (status === 'Berhasil') {
                    const sisa = biaya - uangMuka;
                    sisaPembayaranInput.value = sisa > 0 ? sisa : 0;
                    sisaPembayaranInfo.textContent = `Sisa yang harus dibayar adalah total biaya dikurangi uang muka.`;
                } else {
                    sisaPembayaranInput.value = 0;
                    sisaPembayaranInfo.textContent = '';
                }
            }

            statusSelect.addEventListener('change', updateSisaPembayaran);
            updateSisaPembayaran();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/service/pengambilan.blade.php ENDPATH**/ ?>
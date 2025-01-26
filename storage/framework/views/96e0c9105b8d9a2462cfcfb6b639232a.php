<?php $__env->startSection('title', 'Penambahan Kas'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-center mt-8">
    <div class="w-11/12">
        <!-- Form Penambahan -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Form Penambahan Kas</h3>
            </div>
            <div class="p-8">
                <form action="<?php echo e(route('penambahan.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="space-y-6">
                        <div>
                            <label for="outlet" class="block text-sm font-medium text-gray-700 mb-2">Outlet</label>
                            <input type="text" 
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out" 
                                value="<?php echo e(session('outlet_name')); ?>" 
                                readonly>
                            <input type="hidden" name="outlet_id" value="<?php echo e(session('outlet_id')); ?>">
                        </div>
                        
                        <div>
                            <label for="operator" class="block text-sm font-medium text-gray-700 mb-2">Operator</label>
                            <input type="text" 
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out" 
                                value="<?php echo e(session('username')); ?>" 
                                readonly>
                            <input type="hidden" name="user_id" value="<?php echo e(session('user_id')); ?>">
                        </div>
                        
                        <div>
                            <label for="nominal" class="block text-sm font-medium text-gray-700 mb-2">Nominal Penambahan</label>
                            <input type="number" 
                                name="nominal" 
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out
                                <?php $__errorArgs = ['nominal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-100 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                placeholder="Masukkan jumlah penambahan"
                                value="<?php echo e(old('nominal')); ?>" 
                                required>
                            <?php $__errorArgs = ['nominal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <textarea name="keterangan" 
                                id="keterangan" 
                                rows="3" 
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out
                                <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-100 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Masukkan keterangan penambahan"><?php echo e(old('keterangan')); ?></textarea>
                            <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-3">
                        <button type="submit" 
                            class="px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg
                            hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                            transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                            Simpan
                        </button>
                        <a href="<?php echo e(route('penambahan')); ?>" 
                            class="px-6 py-2.5 bg-gray-500 text-white text-sm font-semibold rounded-lg
                            hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                            transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data Penambahan -->
        <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Data Penambahan Hari Ini</h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penambahan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $penambahan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($index + 1); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($data->outlet->outlet_name ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($data->creator->username ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e(number_format($data->nominal, 0, ',', '.')); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($data->waktu); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($data->keterangan); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="<?php echo e(route('penambahan.edit', $data->penambahan_kas_id)); ?>" 
                                        class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('penambahan.destroy', $data->penambahan_kas_id)); ?>" 
                                          method="POST" 
                                          class="inline-block" 
                                          onsubmit="return confirm(`Detail Penghapusan:

ID: <?php echo e($data->penambahan_kas_id); ?>

Outlet: <?php echo e($data->outlet->outlet_name); ?>

Operator: <?php echo e($data->creator->username); ?>

Tanggal: <?php echo e($data->date->format('d/m/Y')); ?>

Nominal: Rp <?php echo e(number_format($data->nominal, 0, ',', '.')); ?>

Keterangan: <?php echo e($data->keterangan ?: '-'); ?>


Apakah Anda yakin ingin menghapus data ini?`)">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data penambahan untuk hari ini.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/kas/penambahan.blade.php ENDPATH**/ ?>
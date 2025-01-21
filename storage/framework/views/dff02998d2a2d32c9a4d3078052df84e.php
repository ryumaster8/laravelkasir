

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <div class="space-y-6">
        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800">Form Penarikan Kas</h3>
            </div>
            <div class="p-6">
                <?php if(session('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('penarikan.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="space-y-4">
                        <!-- Tambahkan field Outlet -->
                        <div>
                            <label for="outlet" class="block text-sm font-medium text-gray-700">Outlet</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-100" 
                                value="<?php echo e(session('outlet_name')); ?>" readonly>
                            <input type="hidden" name="outlet_id" value="<?php echo e(session('outlet_id')); ?>">
                        </div>

                        <!-- Tambahkan field Operator -->
                        <div>
                            <label for="operator" class="block text-sm font-medium text-gray-700">Operator</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-100" 
                                value="<?php echo e(session('username')); ?>" readonly>
                            <input type="hidden" name="user_id" value="<?php echo e(session('user_id')); ?>">
                        </div>

                        <div>
                            <label for="total_paid_out" class="block text-sm font-medium text-gray-700">Jumlah Penarikan</label>
                            <input type="number" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['total_paid_out'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="total_paid_out" 
                                   name="total_paid_out" 
                                   value="<?php echo e(old('total_paid_out')); ?>" 
                                   required>
                            <?php $__errorArgs = ['total_paid_out'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      id="keterangan" 
                                      name="keterangan" 
                                      rows="3"><?php echo e(old('keterangan')); ?></textarea>
                            <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Penarikan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800">Data Penarikan Hari Ini</h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Penarikan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $penarikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($index + 1); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo e($item->date); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($item->user->username ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp <?php echo e(number_format($item->total_paid_out, 0, ',', '.')); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($item->description ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                    <a href="<?php echo e(route('penarikan.edit', $item->cash_register_id)); ?>" 
                                       class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('penarikan.destroy', $item->cash_register_id)); ?>" 
                                          method="POST" 
                                          class="inline-block" 
                                          onsubmit="return confirm(`Detail Penghapusan:

ID: <?php echo e($item->cash_register_id); ?>

Outlet: <?php echo e($item->outlet->outlet_name); ?>

Operator: <?php echo e($item->user->username); ?>

Tanggal: <?php echo e($item->date); ?>

Jumlah Penarikan: Rp <?php echo e(number_format($item->total_paid_out, 0, ',', '.')); ?>

Keterangan: <?php echo e($item->description ?: '-'); ?>


Apakah Anda yakin ingin menghapus data ini?`)">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada data penarikan hari ini</td>
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/kas/penarikan.blade.php ENDPATH**/ ?>
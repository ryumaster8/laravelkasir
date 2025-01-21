

<?php $__env->startSection('content'); ?>
<div class="flex justify-center mt-8">
    <div class="w-11/12 md:w-3/4 lg:w-2/3">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Edit Penambahan</h3>
            </div>
            
            <div class="p-6">
                <form action="<?php echo e(route('penambahan.update', $penambahan->cash_register_id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <div class="space-y-4">
                        <!-- Outlet Field -->
                        <div>
                            <label for="outlet" class="block text-sm font-medium text-gray-700">Outlet</label>
                            <input type="text" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-100" 
                                   value="<?php echo e($outletName); ?>" 
                                   readonly>
                        </div>

                        <!-- Operator Field -->
                        <div>
                            <label for="operator" class="block text-sm font-medium text-gray-700">Operator</label>
                            <input type="text" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-100" 
                                   value="<?php echo e($operatorName); ?>" 
                                   readonly>
                        </div>

                        <!-- Total Penambahan Field -->
                        <div>
                            <label for="total_received" class="block text-sm font-medium text-gray-700">Total Penambahan</label>
                            <input type="number" 
                                   name="total_received" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['total_received'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('total_received', $penambahan->total_received)); ?>" 
                                   required>
                            <?php $__errorArgs = ['total_received'];
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

                        <!-- Keterangan Field -->
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea name="keterangan" 
                                    id="keterangan" 
                                    rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"><?php echo e(old('keterangan', $penambahan->description)); ?></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3 pt-4">
                            <button type="submit" 
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan Perubahan
                            </button>
                            <a href="<?php echo e(route('penambahan')); ?>" 
                               class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/kas/edit_penambahan.blade.php ENDPATH**/ ?>
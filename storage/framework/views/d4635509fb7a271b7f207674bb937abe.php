

<?php $__env->startSection('title', 'Tambah Supplier'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-blue-500 px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-white">Tambah Supplier</h3>
                <a href="<?php echo e(route('suppliers.index')); ?>" class="text-white hover:text-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>

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

            <form action="<?php echo e(route('suppliers.store')); ?>" method="POST" class="p-6">
                <?php echo csrf_field(); ?>
                <div class="space-y-6">
                    <!-- Outlet -->
                    <div class="space-y-2">
                        <label for="outlet_id" class="block text-sm font-medium text-gray-700">Outlet</label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" 
                               value="<?php echo e($outletName ?? ''); ?>" 
                               readonly>
                        <input type="hidden" name="outlet_id" value="<?php echo e(session('outlet_id')); ?>">
                    </div>

                    <!-- Operator -->
                    <div class="space-y-2">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Operator</label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" 
                               value="<?php echo e($username ?? ''); ?>" 
                               readonly>
                        <input type="hidden" name="user_id" value="<?php echo e(session('user_id')); ?>">
                    </div>

                    <!-- Nama Supplier -->
                    <div class="space-y-2">
                        <label for="supplier_name" class="block text-sm font-medium text-gray-700">Nama Supplier<span class="text-red-500">*</span></label>
                        <input type="text" 
                               class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['supplier_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="supplier_name" 
                               name="supplier_name" 
                               value="<?php echo e(old('supplier_name')); ?>" 
                               placeholder="Masukan nama supplier"
                               required>
                        <?php $__errorArgs = ['supplier_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Kontak Info -->
                    <div class="space-y-2">
                        <label for="contact_info" class="block text-sm font-medium text-gray-700">Kontak Info</label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                               id="contact_info" 
                               name="contact_info" 
                               value="<?php echo e(old('contact_info')); ?>" 
                               placeholder="Masukan kontak info">
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                            id="address" 
                            name="address" 
                            rows="3"
                            placeholder="Masukan Alamat"><?php echo e(old('address')); ?></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" 
                            onclick="window.location='<?php echo e(route('suppliers.index')); ?>'" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/suppliers/add.blade.php ENDPATH**/ ?>
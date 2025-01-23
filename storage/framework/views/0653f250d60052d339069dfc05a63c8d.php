

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Input Data Pelanggan Grosir</h3>
        </div>

        <div class="p-6">
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
            
            <form action="/wholesale-customer" method="POST">
                <?php echo csrf_field(); ?>
                
                <!-- Operator -->
                <div class="mb-6">
                    <label for="operator_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Operator
                    </label>
                    <input type="text" 
                           class="block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           id="operator_id" 
                           value="<?php echo e(Auth::user()->username); ?>" 
                           readonly 
                           placeholder="Operator otomatis terisi">
                    <input type="hidden" name="operator_id" value="<?php echo e(Auth::user()->user_id); ?>">
                </div>

                <!-- Outlet -->
                <div class="mb-6">
                    <label for="customer_outlet_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Outlet
                    </label>
                    <input type="text" 
                           class="block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           id="customer_outlet_id" 
                           value="<?php echo e(Auth::user()->outlet->outlet_name); ?>" 
                           readonly 
                           placeholder="Outlet otomatis terisi">
                    <input type="hidden" name="customer_outlet_id" value="<?php echo e(Auth::user()->outlet->outlet_id); ?>">
                </div>

                <!-- Nama Pelanggan -->
                <div class="mb-6">
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Pelanggan
                    </label>
                    <input type="text" 
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           id="customer_name" 
                           name="customer_name" 
                           placeholder="Masukkan nama pelanggan">
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input type="email" 
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="email" 
                           name="email" 
                           required 
                           placeholder="Masukkan email pelanggan">
                    <?php $__errorArgs = ['email'];
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

                <!-- Nomor Telepon -->
                <div class="mb-6">
                    <label for="contact_info" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor Telepon
                    </label>
                    <input type="text" 
                           class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           id="contact_info" 
                           name="contact_info" 
                           placeholder="Masukkan nomor telepon pelanggan">
                </div>

                <!-- Alamat -->
                <div class="mb-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat
                    </label>
                    <textarea class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                              id="address" 
                              name="address" 
                              rows="3" 
                              placeholder="Masukkan alamat pelanggan"></textarea>
                </div>
            
                <!-- Buttons -->
                <div class="flex justify-start space-x-4 border-t border-gray-200 pt-6">
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan
                    </button>
                    <a href="/dashboard/wholesale-customer" 
                       class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/wholesale_customer/create.blade.php ENDPATH**/ ?>
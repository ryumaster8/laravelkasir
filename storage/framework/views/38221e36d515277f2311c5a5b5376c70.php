

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center">
            <div class="w-full md:w-4/5">
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
                <div class="bg-white rounded-lg shadow-md">
                    <div class="border-b border-gray-200 p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Pindah Cabang Teknisi</h3>
                    </div>
                    <div class="p-6">
                        <form action="<?php echo e(route('teknisi.pindahcabang.proses', $teknisi->teknisi_id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-6">
                                <label for="outlet_asal" class="block text-sm font-medium text-gray-700 mb-2">Outlet Asal</label>
                                <input type="text" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-100" 
                                    id="outlet_asal" 
                                    name="outlet_asal"
                                    value="<?php echo e(old('outlet_asal', $teknisi->outlet->outlet_name)); ?>" 
                                    readonly>
                            </div>
                            <div class="mb-6">
                                <label for="nama_teknisi" class="block text-sm font-medium text-gray-700 mb-2">Nama Teknisi</label>
                                <input type="text" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-100" 
                                    id="nama_teknisi" 
                                    name="nama_teknisi"
                                    value="<?php echo e(old('nama_teknisi', $teknisi->nama_teknisi)); ?>" 
                                    readonly>
                            </div>
                            <div class="mb-6">
                                <label for="outlet_tujuan" class="block text-sm font-medium text-gray-700 mb-2">Pilih Outlet Tujuan</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    id="outlet_tujuan" 
                                    name="outlet_tujuan" 
                                    required>
                                    <option value="" selected disabled>Pilih Outlet Tujuan</option>
                                    <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($outlet->outlet_id); ?>" <?php echo e(old('outlet_tujuan') == $outlet->outlet_id ? 'selected' : ''); ?>>
                                            <?php echo e($outlet->outlet_name); ?> (<?php echo e($outlet->status); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['outlet_tujuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Pindah
                                </button>
                                <a href="/teknisi" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 ml-3">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/teknisi/pindahcabang.blade.php ENDPATH**/ ?>
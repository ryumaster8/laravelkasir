

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
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

    <!-- Panduan Penggunaan Menu Diskon -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg shadow-md mb-6">
        <h5 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i> Panduan Penggunaan Menu Diskon
        </h5>
        <ul class="space-y-3 text-gray-600">
            <li class="flex items-center">
                <span class="font-semibold mr-2">Tambah Diskon:</span> 
                Klik tombol <span class="inline-flex items-center px-2.5 py-0.5 ml-2 bg-blue-500 text-white text-sm rounded-md">
                    <i class="fas fa-plus mr-1"></i> Tambah Diskon
                </span>
            </li>
            <li class="flex items-center">
                <span class="font-semibold mr-2">Edit Diskon:</span>
                Gunakan tombol <span class="inline-flex items-center px-2 py-1 ml-2 bg-yellow-500 text-white text-sm rounded-md">
                    <i class="fas fa-edit"></i>
                </span>
            </li>
            <li class="flex items-center">
                <span class="font-semibold mr-2">Hapus Diskon:</span>
                Klik tombol <span class="inline-flex items-center px-2 py-1 ml-2 bg-red-500 text-white text-sm rounded-md">
                    <i class="fas fa-trash"></i>
                </span>
            </li>
            <li class="flex items-center">
                <span class="font-semibold mr-2">Aktifkan/Nonaktifkan Diskon:</span>
                Gunakan tombol <span class="inline-flex items-center px-2.5 py-0.5 ml-2 bg-blue-500 text-white text-sm rounded-md">
                    <i class="fas fa-toggle-on mr-1"></i> Aktifkan
                </span>
            </li>
            <li class="flex items-center">
                <span class="font-semibold mr-2">Detail Diskon:</span>
                Klik tombol <span class="inline-flex items-center px-2 py-1 ml-2 bg-blue-400 text-white text-sm rounded-md">
                    <i class="fas fa-eye"></i>
                </span>
            </li>
        </ul>
    </div>

    <!-- Header dan Tombol Tambah -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Daftar Diskon</h3>
        <a href="<?php echo e(route('discounts.form')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition duration-150">
            <i class="fas fa-plus mr-2"></i> Tambah Diskon
        </a>
    </div>

    <!-- Tabel Diskon -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Diskon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berlaku Untuk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berakhir</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__currentLoopData = $discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($index + 1); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($discount->discount_name); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($discount->category ? $discount->category->category_name : '-'); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($discount->product ? $discount->product->product_name : '-'); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php if($discount->type === 'percentage'): ?>
                                <span class="text-blue-600 font-medium"><?php echo e($discount->value); ?>%</span>
                            <?php else: ?>
                                <span class="text-green-600 font-medium">Rp <?php echo e(number_format($discount->value, 0, ',', '.')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e(ucfirst($discount->applies_to)); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($discount->start_date); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($discount->end_date); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($discount->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                <?php echo e($discount->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <div class="flex items-center space-x-2">
                                <a href="<?php echo e(route('discounts.form', $discount->discount_id)); ?>" 
                                   class="text-yellow-500 hover:text-yellow-600" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="<?php echo e(route('discounts.destroy', $discount->discount_id)); ?>" 
                                      method="POST" 
                                      class="inline-block">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-600" 
                                            title="Hapus"
                                            onclick="return confirm('Apakah anda akan menghapus diskon dengan ID <?php echo e($discount->discount_id); ?>, nama diskon <?php echo e($discount->discount_name); ?>?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <a href="<?php echo e(route('discounts.toggle', $discount->discount_id)); ?>" 
                                   class="text-blue-500 hover:text-blue-600" 
                                   title="<?php echo e($discount->is_active ? 'Nonaktifkan' : 'Aktifkan'); ?>">
                                    <i class="fas fa-toggle-<?php echo e($discount->is_active ? 'off' : 'on'); ?>"></i>
                                </a>

                                <a href="<?php echo e(route('discounts.show', $discount->discount_id)); ?>" 
                                   class="text-blue-400 hover:text-blue-500" 
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#discountsTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/discounts/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
            <div class="flex justify-between items-center">
                <h4 class="text-xl font-semibold text-white">Daftar Cabang - <?php echo e($outlet->outlet_name); ?></h4>
                <a href="<?php echo e(route('owner.outlets.index')); ?>" class="text-white hover:text-gray-200">
                    Kembali
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Outlet</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Admin</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $outlet->branchOutlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm"><?php echo e($index + 1); ?></td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900"><?php echo e($branch->outlet_name); ?></div>
                                    <div class="text-sm text-gray-500"><?php echo e($branch->address); ?></div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <?php echo e(optional($branch->adminUser)->name ?? 'N/A'); ?>

                                </td>
                                <td class="px-4 py-3 text-sm"><?php echo e($branch->email); ?></td>
                                <td class="px-4 py-3 text-sm"><?php echo e($branch->outlet_phone); ?></td>
                                <td class="px-4 py-3">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php echo e($branch->is_active 
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-red-100 text-red-800'); ?>">
                                        <?php echo e($branch->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="#" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada cabang yang tersedia
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts_dashboard_owner.layout_owner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/owner/outlets/branches.blade.php ENDPATH**/ ?>
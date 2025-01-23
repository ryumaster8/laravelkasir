

<?php $__env->startSection('title', 'Daftar Supplier'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="p-6 bg-blue-500 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-white">
                        <i class="fas fa-truck mr-2"></i> Data Supplier <?php echo e($outletName); ?>

                    </h3>
                    <a href="<?php echo e(route('suppliers.index')); ?>" 
                       class="bg-white text-blue-500 px-4 py-2 rounded-lg hover:bg-blue-50">
                        <i class="fas fa-plus mr-2"></i>Tambah Supplier
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table id="suppliersTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Supplier</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($index + 1); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($supplier->supplier_name); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($supplier->contact_info); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500"><?php echo e($supplier->address); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($supplier->created_at->format('d/m/Y H:i')); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="<?php echo e(route('suppliers.edit', $supplier->supplier_id)); ?>" 
                                       class="text-yellow-500 hover:text-yellow-700 mr-3">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="<?php echo e(route('suppliers.delete', $supplier->supplier_id)); ?>" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data supplier
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

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#suppliersTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
        },
        "pageLength": 25,
        "ordering": true
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/suppliers/list.blade.php ENDPATH**/ ?>
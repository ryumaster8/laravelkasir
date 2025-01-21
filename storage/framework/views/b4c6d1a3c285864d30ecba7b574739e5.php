

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
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Daftar Servis</h3>

        <a href="<?php echo e(route('services.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg mb-6">
            <span>Tambah Service</span>
        </a>

        <div class="overflow-x-auto shadow-md rounded-lg">
            <table id="serviceTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Faktur</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Teknisi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Perangkat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Serial/IMEI</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi Masalah</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Servis</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Perangkat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya Servis</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uang Muka</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Masuk</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Ambil</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Pembatalan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pembatalan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Pengambilan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if($services->isEmpty()): ?>
                        <tr>
                            <td colspan="21" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data servis.</td>
                        </tr>
                    <?php else: ?>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="<?php echo e(in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'text-red-600' : 'text-gray-900'); ?>">
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($key + 1); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->service_id); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->faktur); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->operator->username ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->outlet->outlet_name ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->teknisi->nama_teknisi ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->customer_name); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->device_name); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->serial_number); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->description); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->progress_status); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->status_servis); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->tipe_perangkat); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->biaya ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->uang_muka ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->tanggal_masuk); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->tanggal_ambil ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->operator_batal ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->tanggal_batal ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($item->operatorPengambilan->username ?? '-'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="<?php echo e(route('services.edit', $item->service_id)); ?>" 
                                           class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed
                                           <?php echo e(in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'opacity-50 cursor-not-allowed' : ''); ?>">
                                           Edit
                                        </a>

                                        <form action="<?php echo e(route('services.destroy', $item->service_id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed
                                                    <?php echo e(in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'opacity-50 cursor-not-allowed' : ''); ?>"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>

                                        <form action="<?php echo e(route('services.cancel.view', $item->service_id)); ?>" method="GET">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed
                                                    <?php echo e(in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'opacity-50 cursor-not-allowed' : ''); ?>">
                                                Batalkan
                                            </button>
                                        </form>

                                        <a href="<?php echo e(route('service.pengambilan', $item->service_id)); ?>" 
                                           class="inline-flex items-center px-3 py-1 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed
                                           <?php echo e(in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'opacity-50 cursor-not-allowed' : ''); ?>">
                                           Pengambilan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#serviceTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                pageLength: 10,
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/service/index.blade.php ENDPATH**/ ?>
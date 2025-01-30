<?php $__env->startSection('title', 'Pengajuan Pemindahan Stok'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Pengajuan Pemindahan Stok</h3>
    
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

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table id="transferRequestsTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barcode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Pengirim</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet Penerima</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Penerima</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $transits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($key + 1); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($transit->product_id); ?></td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo e($transit->product->product_name); ?>

                                      <br>
                                    <span class="badge bg-<?php echo e($transit->has_serial_number ? 'info' : 'secondary'); ?>">
                                      <?php echo e($transit->has_serial_number ? 'Serial' : 'Non-Serial'); ?>

                                    </span>
                                 </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                       <?php if($transit->has_serial_number): ?>
                                            <?php echo e($transit->serial?->serial_number ?? '-'); ?>

                                       <?php else: ?>
                                         <?php echo e($transit->product->product_code ?? '-'); ?>

                                       <?php endif; ?>
                                 </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($transit->operatorSender->username); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($transit->toOutlet->outlet_name); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($transit->operatorReceiver->username ?? '-'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($transit->quantity); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo e($transit->status === 'transit' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($transit->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                       'bg-red-100 text-red-800')); ?>">
                                    <?php echo e(ucfirst($transit->status)); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?php echo e($transit->created_at->format('d/m/Y H:i')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <?php if($transit->status === 'transit'): ?>
                                    <form action="<?php echo e(route('products.cancel-transfer', $transit->transit_id)); ?>" 
                                          method="POST" 
                                          onsubmit="return confirmCancel('<?php echo e($transit->product->product_name); ?>', <?php echo e($transit->quantity); ?>, '<?php echo e($transit->toOutlet->outlet_name); ?>')"
                                          class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">
                                            Batalkan
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="11" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function confirmCancel(productName, quantity, outletName) {
        return confirm(
            `Apakah Anda yakin ingin membatalkan pengajuan pemindahan stok ini?\n\n` +
            `Detail Pengajuan:\n` +
            `- Produk: ${productName}\n` +
            `- Jumlah: ${quantity}\n` +
            `- Tujuan: ${outletName}\n\n` +
            `Catatan: Stok akan dikembalikan ke outlet asal.`
        );
    }

    $(document).ready(function() {
        $('#transferRequestsTable').DataTable({
            responsive: true,
            pageLength: 10,
            ordering: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/products/transfer_requests_submission.blade.php ENDPATH**/ ?>
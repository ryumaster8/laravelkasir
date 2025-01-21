

<?php $__env->startSection('title', 'Pengajuan Pemindahan Stok'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h3 class="text-dark">Pengajuan Pemindahan Stok</h3>
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
        <div class="table-responsive">
            <table id="transferRequestsTable" class="table table-bordered table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Product ID</th>
                    <th>Produk</th>
                    <th>Barcode</th>
                    <th>Operator Pengirim</th>
                    <th>Outlet Penerima</th>
                    <th>Operator Penerima</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $transits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                          <td><?php echo e($key + 1); ?></td>
                            <td><?php echo e($transit->product_id); ?></td>
                                <td>
                                <?php echo e($transit->product->product_name); ?>

                                  <br>
                                <span class="badge bg-<?php echo e($transit->has_serial_number ? 'info' : 'secondary'); ?>">
                                  <?php echo e($transit->has_serial_number ? 'Serial' : 'Non-Serial'); ?>

                                </span>
                              </td>
                            <td>
                                  <?php if($transit->has_serial_number): ?>
                                        <?php echo e($transit->serial?->serial_number ?? '-'); ?>

                                   <?php else: ?>
                                     <?php echo e($transit->product->product_code ?? '-'); ?>

                                   <?php endif; ?>
                             </td>
                             <td><?php echo e($transit->operatorSender->username); ?></td>
                            <td><?php echo e($transit->toOutlet->outlet_name); ?></td>
                              <td><?php echo e($transit->operatorReceiver->username ?? '-'); ?></td>
                            <td><?php echo e($transit->quantity); ?></td>
                             <td><span class="badge  <?php echo e($transit->status == 'transit' ? 'bg-warning' : ($transit->status == 'rejected' ? 'bg-danger' : 'bg-success')); ?>">
                                  <?php echo e($transit->status); ?>

                                </span>
                            </td>
                            <td><?php echo e($transit->created_at); ?></td>
                         </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                               <tr>
                                  <td colspan="10" class="text-center">Tidak ada data</td>
                               </tr>
                         <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
      
      <script>
           $(document).ready( function () {
             $('#transferRequestsTable').DataTable();
           } );
      </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/products/transfer_requests_submission.blade.php ENDPATH**/ ?>
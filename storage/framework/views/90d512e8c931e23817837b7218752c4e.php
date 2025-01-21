

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Daftar Pengaturan Akses Pengguna</h1>
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
        <a href="<?php echo e(route('user-permissions.create')); ?>" class="btn btn-primary mb-3">Tambah Pengaturan Akses Pengguna</a>

        <table id="userPermissionsTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Operator Username</th>
                    <th>Outlet Name</th>
                    <th>Role</th>
                    <th>Tambah Supplier</th>
                    <th>Edit Supplier</th>
                    <th>Hapus Supplier</th>
                    <th>Tambah Kategori</th>
                    <th>Edit Kategori</th>
                    <th>Hapus Kategori</th>
                    <th>Tambah Produk</th>
                    <th>Edit Produk</th>
                    <th>Hapus Produk</th>
                    <th>Tambah Pengguna</th>
                    <th>Edit Pengguna</th>
                    <th>Hapus Pengguna</th>
                    <th>Tambah Lokasi Produk</th>
                    <th>Edit Lokasi Produk</th>
                    <th>Hapus Lokasi Produk</th>
                    <th>Lihat Harga Modal</th>
                    <th>Lihat Harga Jual</th>
                    <th>Lihat Supplier</th>
                    <th>Lihat Kategori</th>
                    <th>Lihat Operator</th>
                    <th>Lihat Outlet</th>
                    <th>Lihat Stok</th>
                    <th>Lihat Brand</th>
                    <th>Lihat Lokasi Produk</th>
                    <th>Lihat Barcode</th>
                    <th>Lihat Barcode Unit</th>
                    <th>Lihat Product ID</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $userPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                     <td><?php echo e($permission->operator ? $permission->operator->username : '-'); ?></td>
                     <td><?php echo e($permission->outlet ? $permission->outlet->outlet_name : '-'); ?></td>
                     <td><?php echo e($permission->role ? $permission->role->role_name : '-'); ?></td>
                    <td><?php echo e($permission->can_add_supplier ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_edit_supplier ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_delete_supplier ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_add_category ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_edit_category ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_delete_category ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_add_product ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_edit_product ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_delete_product ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_add_user ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_edit_user ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_delete_user ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_add_product_location ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_edit_product_location ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_delete_product_location ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_see_cost_price ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_see_sale_price ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_see_supplier ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_see_category ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_see_operator ? 'Ya' : 'Tidak'); ?></td>
                     <td><?php echo e($permission->can_see_outlet ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_see_stock ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_see_brand ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_see_product_location ? 'Ya' : 'Tidak'); ?></td>
                    <td><?php echo e($permission->can_see_barcode ? 'Ya' : 'Tidak'); ?></td>
                     <td><?php echo e($permission->can_see_unit_barcode ? 'Ya' : 'Tidak'); ?></td>
                     <td><?php echo e($permission->can_see_product_id ? 'Ya' : 'Tidak'); ?></td>
                    <td>
                    <div class="btn-group" role="group">
                         <a href="<?php echo e(route('user-permissions.edit', $permission->user_permission_id)); ?>" class="btn btn-sm btn-info">Edit</a>
                          <form action="<?php echo e(route('user-permissions.destroy', $permission->user_permission_id)); ?>" method="POST" style="display:inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                             <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaturan akses untuk User: <?php echo e($permission->operator ? $permission->operator->username : '-'); ?> dengan Role: <?php echo e($permission->role ? $permission->role->role_name : '-'); ?> dan Outlet: <?php echo e($permission->outlet ? $permission->outlet->outlet_name : '-'); ?>?')">Delete</button>
                        </form>
                    </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#userPermissionsTable').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/permissions/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Daftar Pengaturan Akses Pengguna</h1>
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
        <a href="<?php echo e(route('user-permissions.create')); ?>" class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 mb-6">
            Tambah Pengaturan Akses Pengguna
        </a>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table id="userPermissionsTable" class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tambah Supplier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edit Supplier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hapus Supplier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tambah Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edit Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hapus Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tambah Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edit Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hapus Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tambah Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edit Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hapus Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tambah Lokasi Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edit Lokasi Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hapus Lokasi Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Harga Modal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Harga Jual</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Supplier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Operator</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Outlet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Brand</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Lokasi Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Barcode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Barcode Unit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lihat Product ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $userPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($key + 1); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($permission->operator ? $permission->operator->username : '-'); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($permission->outlet ? $permission->outlet->outlet_name : '-'); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($permission->role ? $permission->role->role_name : '-'); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_add_supplier ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_add_supplier ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_edit_supplier ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_edit_supplier ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_delete_supplier ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_delete_supplier ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_add_category ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_add_category ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_edit_category ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_edit_category ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_delete_category ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_delete_category ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_add_product ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_add_product ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_edit_product ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_edit_product ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_delete_product ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_delete_product ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_add_user ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_add_user ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_edit_user ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_edit_user ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_delete_user ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_delete_user ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_add_product_location ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_add_product_location ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_edit_product_location ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_edit_product_location ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_delete_product_location ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_delete_product_location ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_cost_price ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_cost_price ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_sale_price ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_sale_price ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_supplier ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_supplier ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_category ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_category ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_operator ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_operator ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_outlet ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_outlet ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_stock ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_stock ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_brand ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_brand ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_product_location ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_product_location ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_barcode ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_barcode ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_unit_barcode ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_unit_barcode ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="<?php echo e($permission->can_see_product_id ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($permission->can_see_product_id ? 'Ya' : 'Tidak'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('user-permissions.edit', $permission->user_permission_id)); ?>" 
                                   class="inline-flex items-center px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md">
                                    Edit
                                </a>
                                <form action="<?php echo e(route('user-permissions.destroy', $permission->user_permission_id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengaturan akses untuk User: <?php echo e($permission->operator ? $permission->operator->username : '-'); ?> dengan Role: <?php echo e($permission->role ? $permission->role->role_name : '-'); ?> dan Outlet: <?php echo e($permission->outlet ? $permission->outlet->outlet_name : '-'); ?>?')">
                                        Delete
                                    </button>
                                </form>
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
            $('#userPermissionsTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/permissions/index.blade.php ENDPATH**/ ?>
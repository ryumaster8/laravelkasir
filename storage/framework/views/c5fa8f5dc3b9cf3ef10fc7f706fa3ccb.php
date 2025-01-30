<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-800">
                <?php echo e(isset($userPermission) ? 'Edit' : 'Tambah'); ?> Pengaturan Akses Pengguna
            </h3>
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
            <form action="<?php echo e(isset($userPermission) ? route('user-permissions.update', $userPermission->user_permission_id) : route('user-permissions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php if(isset($userPermission)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <!-- Operator Field -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Operator</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="<?php echo e(Auth::user()->username); ?>" readonly>
                </div>

                <!-- Role Selection -->
                <div class="mb-4">
                    <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select name="role_id" id="role_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Role</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($role->role_name !== 'owner' && $role->role_name !== 'superadmin'): ?>
                                <option value="<?php echo e($role->role_id); ?>" <?php echo e(old('role_id', isset($userPermission) ? $userPermission->role_id : '') == $role->role_id ? 'selected' : ''); ?>>
                                    <?php echo e($role->role_name); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Outlet Selection -->
                <div class="mb-4">
                    <label for="outlet_id" class="block text-sm font-medium text-gray-700 mb-2">Outlet</label>
                    <select name="outlet_id" id="outlet_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Outlet</option>
                        <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($outlet->outlet_id); ?>" <?php echo e(old('outlet_id', isset($userPermission) ? $userPermission->outlet_id : '') == $outlet->outlet_id ? 'selected' : ''); ?>>
                                <?php echo e($outlet->outlet_name); ?> (<?php echo e($outlet->status == 'induk' ? 'induk' : 'cabang'); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Permission Controls -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <!-- Quick Actions -->
                        <div class="flex space-x-4 justify-center mb-6">
                            <button type="button" class="select-all-permissions px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors text-sm">
                                BISA UNTUK SEMUA
                            </button>
                            <button type="button" class="unselect-all-permissions px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors text-sm">
                                TIDAK BISA UNTUK SEMUA
                            </button>
                        </div>

                        <!-- Permission Groups -->
                        <?php $__currentLoopData = ['supplier' => 'Supplier', 'product' => 'Produk', 'category' => 'Kategori']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h5 class="font-medium text-gray-900 mb-4">Kelompok <?php echo e($title); ?></h5>
                                <div class="space-y-3">
                                    <?php $__currentLoopData = ['add', 'edit', 'delete']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center">
                                            <label class="flex items-center space-x-3">
                                                <span class="text-sm text-gray-700">Bisa <?php echo e(ucfirst($action)); ?> <?php echo e($title); ?>?</span>
                                                <select name="can_<?php echo e($action); ?>_<?php echo e($key); ?>" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="0" <?php echo e(old("can_{$action}_{$key}", isset($userPermission) ? $userPermission->{"can_{$action}_{$key}"} : '') == 0 ? 'selected' : ''); ?>>Tidak</option>
                                                    <option value="1" <?php echo e(old("can_{$action}_{$key}", isset($userPermission) ? $userPermission->{"can_{$action}_{$key}"} : '') == 1 ? 'selected' : ''); ?>>Ya</option>
                                                </select>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- New Wholesale Customer Permission Group -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-4">Kelompok Pelanggan Grosir</h5>
                            <div class="space-y-3">
                                <?php $__currentLoopData = ['add' => 'Tambah', 'edit' => 'Edit', 'delete' => 'Hapus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center">
                                        <label class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-700">Bisa <?php echo e($title); ?> Pelanggan Grosir?</span>
                                            <select name="can_<?php echo e($action); ?>_wholesale_customer" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="0" <?php echo e(old("can_{$action}_wholesale_customer", isset($userPermission) ? $userPermission->{"can_{$action}_wholesale_customer"} : '') == 0 ? 'selected' : ''); ?>>Tidak</option>
                                                <option value="1" <?php echo e(old("can_{$action}_wholesale_customer", isset($userPermission) ? $userPermission->{"can_{$action}_wholesale_customer"} : '') == 1 ? 'selected' : ''); ?>>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    </div>

                    <!-- Continue with other permission groups similarly -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-4">Kelompok Tabel Produk</h5>
                            <div class="space-y-3">
                                <?php $__currentLoopData = ['product_id' => 'ID Produk', 'cost_price' => 'Harga Modal', 'sale_price' => 'Harga Jual', 'brand' => 'Merek Produk', 'stock' => 'Stok Produk', 'barcode' => 'Barcode Produk', 'unit_barcode' => 'Unit Barcode', 'supplier' => 'Supplier', 'category' => 'Kategori Produk', 'product_location' => 'Lokasi Produk', 'operator' => 'Operator', 'outlet' => 'Outlet']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center">
                                        <label class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-700">Bisa Lihat <?php echo e($title); ?>?</span>
                                            <select name="can_see_<?php echo e($key); ?>" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="0" <?php echo e(old("can_see_{$key}", isset($userPermission) ? $userPermission->{"can_see_{$key}"} : '') == 0 ? 'selected' : ''); ?>>Tidak</option>
                                                <option value="1" <?php echo e(old("can_see_{$key}", isset($userPermission) ? $userPermission->{"can_see_{$key}"} : '') == 1 ? 'selected' : ''); ?>>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-4">Kelompok Lokasi Produk</h5>
                            <div class="space-y-3">
                                <?php $__currentLoopData = ['add' => 'Tambah', 'edit' => 'Edit', 'delete' => 'Hapus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center">
                                        <label class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-700">Bisa <?php echo e($title); ?> Lokasi Produk?</span>
                                            <select name="can_<?php echo e($action); ?>_product_location" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="0" <?php echo e(old("can_{$action}_product_location", isset($userPermission) ? $userPermission->{"can_{$action}_product_location"} : '') == 0 ? 'selected' : ''); ?>>Tidak</option>
                                                <option value="1" <?php echo e(old("can_{$action}_product_location", isset($userPermission) ? $userPermission->{"can_{$action}_product_location"} : '') == 1 ? 'selected' : ''); ?>>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-4">Kelompok Pengguna</h5>
                            <div class="space-y-3">
                                <?php $__currentLoopData = ['add' => 'Tambah', 'edit' => 'Edit', 'delete' => 'Hapus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center">
                                        <label class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-700">Bisa <?php echo e($title); ?> Pengguna?</span>
                                            <select name="can_<?php echo e($action); ?>_user" class="permission-select ml-2 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="0" <?php echo e(old("can_{$action}_user", isset($userPermission) ? $userPermission->{"can_{$action}_user"} : '') == 0 ? 'selected' : ''); ?>>Tidak</option>
                                                <option value="1" <?php echo e(old("can_{$action}_user", isset($userPermission) ? $userPermission->{"can_{$action}_user"} : '') == 1 ? 'selected' : ''); ?>>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-6 flex justify-between border-t border-gray-200 pt-6">
                    <a href="<?php echo e(route('user-permissions.index')); ?>" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                        Kembali
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>

            <!-- Guide Card -->
            <div class="mt-8 bg-white rounded-lg shadow-md">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h5 class="font-medium text-gray-900">Panduan Penggunaan Fitur Pengaturan Akses Pengguna</h5>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">Fitur Pengaturan Akses Pengguna ini digunakan untuk mengatur hak akses dari setiap pengguna berdasarkan role yang diberikan. Fitur ini dapat mempermudah administrator untuk membatasi akses setiap user.</p>
                    <h6 class="font-medium text-gray-900 mb-2">Cara Menggunakan</h6>
                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                        <li>Pilih Role yang akan diatur hak aksesnya pada input <span class="font-semibold">Role</span></li>
                        <li>Pilih Outlet yang akan diatur hak aksesnya, jika tidak ada dapat dikosongkan</li>
                        <li>Pilih atau atur checkbox untuk hak akses yang dibutuhkan pada setiap kelompok</li>
                        <li>Klik tombol <span class="font-semibold">BISA UNTUK SEMUA</span> untuk memberikan semua hak akses</li>
                        <li>Klik tombol <span class="font-semibold">TIDAK BISA UNTUK SEMUA</span> untuk menghilangkan semua hak akses</li>
                        <li>Setelah selesai mengatur hak akses klik tombol <span class="font-semibold">Simpan</span></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function () {
        $('.select-all-permissions').click(function () {
            $('.permission-select').val('1').trigger('change');
        });
        $('.unselect-all-permissions').click(function () {
            $('.permission-select').val('0').trigger('change');
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/permissions/form.blade.php ENDPATH**/ ?>
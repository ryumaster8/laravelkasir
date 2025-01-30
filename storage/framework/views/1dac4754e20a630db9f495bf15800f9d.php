<?php $__env->startSection('title', 'Tambah Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-center mt-8 px-4">
    <div class="w-full max-w-4xl">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Tambah Product</h3>
            </div>
            <form action="<?php echo e(route('products.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
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
                <div class="p-6 space-y-6">
                    <div>
                        <label for="outlet_id" class="block text-sm font-medium text-gray-700">Outlet</label>
                        <input type="text" class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 text-base"
                               value="<?php echo e($outletName ?? ''); ?>" readonly>
                        <input type="hidden" name="outlet_id" value="<?php echo e(session('outlet_id')); ?>">
                    </div>

                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Operator</label>
                        <input type="text" class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 text-base"
                               value="<?php echo e($username ?? ''); ?>" readonly>
                        <input type="hidden" name="user_id" value="<?php echo e(session('user_id')); ?>">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" id="category_id" 
                                class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base">
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->category_id); ?>"
                                    <?php echo e(old('category_id') == $category->category_id ? 'selected' : ''); ?>>
                                    <?php echo e($category->category_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['category_id'];
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

                    <div>
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id" id="supplier_id" 
                                class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['supplier_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base">
                            <option value="" selected disabled>-- Pilih Supplier --</option>
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->supplier_id); ?>"
                                    <?php echo e(old('supplier_id') == $supplier->supplier_id ? 'selected' : ''); ?>>
                                    <?php echo e($supplier->supplier_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['supplier_id'];
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

                    <div>
                        <label for="product_name" class="block text-sm font-medium text-gray-700">Nama Product</label>
                        <input type="text" id="product_name" name="product_name" value="<?php echo e(old('product_name')); ?>"
                               class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base"
                               placeholder="Masukan nama product">
                        <?php $__errorArgs = ['product_name'];
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

                    <div class="hidden">
                        <label for="product_code" class="block text-sm font-medium text-gray-700">Kode Product</label>
                        <input type="text" id="product_code" name="product_code" value="<?php echo e(old('product_code')); ?>"
                               class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['product_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base"
                               placeholder="Masukan kode product">
                        <?php $__errorArgs = ['product_code'];
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

                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700">Merk</label>
                        <input type="text" id="brand" name="brand" value="<?php echo e(old('brand')); ?>"
                               class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base"
                               placeholder="Masukan merk">
                        <?php $__errorArgs = ['brand'];
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

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 text-base" name="description" id="description" placeholder="Masukan deskripsi product"><?php echo e(old('description')); ?></textarea>
                    </div>

                    <div>
                        <label for="price_modal" class="block text-sm font-medium text-gray-700">Harga Modal</label>
                        <input type="number" id="price_modal" name="price_modal" value="<?php echo e(old('price_modal')); ?>"
                               class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['price_modal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base"
                               placeholder="Masukan harga modal">
                        <?php $__errorArgs = ['price_modal'];
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

                    <div>
                        <label for="price_grosir" class="block text-sm font-medium text-gray-700">Harga Grosir</label>
                        <input type="number" id="price_grosir" name="price_grosir" value="<?php echo e(old('price_grosir')); ?>"
                               class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['price_grosir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base"
                               placeholder="Masukan harga grosir">
                        <?php $__errorArgs = ['price_grosir'];
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

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga Ecer</label>
                        <input type="number" id="price" name="price" value="<?php echo e(old('price')); ?>"
                               class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base"
                               placeholder="Masukan harga ecer">
                        <?php $__errorArgs = ['price'];
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

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" id="stock" name="stock" value="<?php echo e(old('stock')); ?>"
                               class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base"
                               placeholder="Masukan stok">
                        <?php $__errorArgs = ['stock'];
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

                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700">Satuan</label>
                        <select name="unit" id="unit" 
                                class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-3 text-base">
                            <option value="pcs" <?php echo e(old('unit') === 'pcs' ? 'selected' : ''); ?>>pcs</option>
                            <option value="dus" <?php echo e(old('unit') === 'dus' ? 'selected' : ''); ?>>dus</option>
                            <option value="kg" <?php echo e(old('unit') === 'kg' ? 'selected' : ''); ?>>kg</option>
                            <option value="bungkus" <?php echo e(old('unit') === 'bungkus' ? 'selected' : ''); ?>>bungkus</option>
                        </select>
                        <?php $__errorArgs = ['unit'];
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

                    <div>
                        <label for="has_serial_number" class="block text-sm font-medium text-gray-700">Produk memiliki serial number?</label>
                        <select name="has_serial_number" id="has_serial_number" 
                                class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 text-base">
                            <option value="0" <?php echo e(old('has_serial_number') === '0' ? 'selected' : ''); ?>>Tidak</option>
                            <option value="1" <?php echo e(old('has_serial_number') === '1' ? 'selected' : ''); ?>>Ya</option>
                        </select>
                    </div>

                    <div id="serial_number" class="hidden">
                        <label for="serial" class="block text-sm font-medium text-gray-700 mb-2">Serial Number</label>
                        <div id="serial-inputs" class="space-y-2">
                            <div class="flex">
                                <input type="text" 
                                    name="serial[]" 
                                    class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 text-base"
                                    placeholder="Masukkan Serial Number dan tekan Enter">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="price-error" class="text-red-600 text-sm mt-2"></div>

                <div class="bg-gray-50 px-6 py-4 flex justify-start space-x-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Submit
                    </button>
                    <a href="<?php echo e(url()->previous()); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#has_serial_number').change(function() {
            if ($(this).val() == '1') {
                $('#serial_number').removeClass('hidden');
                // Add first input field if none exists
                if ($('#serial-inputs').children().length === 0) {
                    addSerialInput();
                }
            } else {
                $('#serial_number').addClass('hidden');
                $('#serial-inputs').empty();
            }
        });

        function addSerialInput() {
            const newInput = `
                <div class="flex">
                    <input type="text" 
                        name="serial[]" 
                        class="mt-1 block w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 text-base"
                        placeholder="Masukkan Serial Number dan tekan Enter">
                </div>
            `;
            $('#serial-inputs').append(newInput);
        }

        // Handle enter key press on serial inputs
        $('#serial-inputs').on('keypress', 'input', function(e) {
            if (e.which == 13) { // Enter key
                e.preventDefault();
                const value = $(this).val().trim();
                if (value !== '') {
                    addSerialInput();
                    $('#serial-inputs input').last().focus();
                }
            }
        });

        // Clean up empty serial inputs before form submission
        $('form').on('submit', function() {
            $('#serial-inputs input').filter(function() {
                return !this.value.trim();
            }).remove();
            return true;
        });

        // Add price validation
        $('form').on('submit', function(e) {
            const price_modal = parseFloat($('#price_modal').val());
            const price_grosir = parseFloat($('#price_grosir').val());
            const price = parseFloat($('#price').val());

            if (price_modal >= price_grosir) {
                e.preventDefault();
                alert('Harga modal harus lebih kecil dari harga grosir');
                return false;
            }

            if (price_grosir >= price) {
                e.preventDefault();
                alert('Harga grosir harus lebih kecil dari harga ecer');
                return false;
            }
        });

        // Add real-time validation as user types
        $('#price_modal, #price_grosir, #price').on('input', function() {
            const price_modal = parseFloat($('#price_modal').val()) || 0;
            const price_grosir = parseFloat($('#price_grosir').val()) || 0;
            const price = parseFloat($('#price').val()) || 0;

            let errorMessage = '';
            if (price_modal >= price_grosir && price_grosir > 0) {
                errorMessage = 'Harga modal harus lebih kecil dari harga grosir';
            }
            if (price_grosir >= price && price > 0) {
                errorMessage = 'Harga grosir harus lebih kecil dari harga ecer';
            }

            // Display error message below price fields
            $('#price-error').text(errorMessage);
            
            // Disable submit button if there's an error
            $('button[type="submit"]').prop('disabled', errorMessage !== '');
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/products/add.blade.php ENDPATH**/ ?>
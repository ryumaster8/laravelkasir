

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

    <h3 class="text-2xl font-bold text-gray-800 mb-6"><?php echo e(isset($discount) ? 'Edit Diskon' : 'Tambah Diskon'); ?></h3>

    <form action="<?php echo e(isset($discount) ? route('discounts.update', $discount->discount_id) : route('discounts.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php if(isset($discount)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 space-y-4">
                <!-- Nama Diskon -->
                <div>
                    <label for="discount_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Diskon</label>
                    <input type="text" name="discount_name" id="discount_name" 
                           class="w-full px-3 py-2 text-gray-700 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                           placeholder="Masukkan nama diskon" 
                           value="<?php echo e(old('discount_name', $discount->discount_name ?? '')); ?>">
                </div>

                <!-- Tipe Diskon -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Diskon</label>
                    <select name="type" id="type" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                        <option value="percentage" <?php echo e(old('type', $discount->type ?? '') == 'percentage' ? 'selected' : ''); ?>>Persentase</option>
                        <option value="fixed" <?php echo e(old('type', $discount->type ?? '') == 'fixed' ? 'selected' : ''); ?>>Nominal Tetap</option>
                    </select>
                </div>

                <!-- Nilai Diskon -->
                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-1">Nilai Diskon</label>
                    <input type="number" name="value" id="value" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                           placeholder="Masukkan nilai diskon" 
                           value="<?php echo e(old('value', $discount->value ?? '')); ?>">
                </div>

                <!-- Berlaku Untuk -->
                <div>
                    <label for="applies_to" class="block text-sm font-medium text-gray-700 mb-1">Berlaku Untuk</label>
                    <select name="applies_to" id="applies_to" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="product" <?php echo e(old('applies_to', $discount->applies_to ?? '') == 'product' ? 'selected' : ''); ?>>Produk Tertentu</option>
                        <option value="category" <?php echo e(old('applies_to', $discount->applies_to ?? '') == 'category' ? 'selected' : ''); ?>>Kategori Produk</option>
                    </select>
                </div>

                <!-- Pilih Produk -->
                <div id="product_field" class="hidden">
                    <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Produk</label>
                    <select name="product_id[]" id="product_id" multiple="multiple"
                            class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500 select2">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $stock = $product->productStock->sum('stock');
                                $serialCount = $product->serials->count();
                                $totalStock = $product->has_serial_number ? $serialCount : $stock;
                                
                                $selectedProducts = old('product_id', isset($discount) ? $discount->products->pluck('product_id')->toArray() : []);
                            ?>
                            <option value="<?php echo e($product->product_id); ?>" 
                                    <?php echo e(in_array($product->product_id, $selectedProducts) ? 'selected' : ''); ?>>
                                <?php echo e($product->product_name); ?> 
                                (<?php echo e($product->has_serial_number ? 'Serial' : 'Non-Serial'); ?> - Stok: <?php echo e($totalStock); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Anda dapat memilih beberapa produk sekaligus</p>
                </div>

                <!-- Pilih Kategori -->
                <div id="category_field" class="hidden">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kategori</label>
                    <select name="category_id[]" id="category_id" multiple="multiple"
                            class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500 select2">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $selectedCategories = old('category_id', isset($discount) ? $discount->categories->pluck('category_id')->toArray() : []);
                            ?>
                            <option value="<?php echo e($category->category_id); ?>" 
                                    <?php echo e(in_array($category->category_id, $selectedCategories) ? 'selected' : ''); ?>>
                                <?php echo e($category->category_name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Anda dapat memilih beberapa kategori sekaligus</p>
                </div>

                <!-- Tanggal Mulai -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                           value="<?php echo e(old('start_date', $discount->start_date ?? '')); ?>">
                </div>

                <!-- Tanggal Berakhir -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                    <input type="date" name="end_date" id="end_date" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                           value="<?php echo e(old('end_date', $discount->end_date ?? '')); ?>">
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-between">
                <a href="<?php echo e(route('discounts.index')); ?>" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                    <?php echo e(isset($discount) ? 'Update Diskon' : 'Simpan Diskon'); ?>

                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Select2
        $('.select2').select2({
            theme: 'default',
            width: '100%',
            placeholder: 'Pilih item...',
            allowClear: true
        });

        const appliesToField = document.getElementById('applies_to');
        const productField = document.getElementById('product_field');
        const categoryField = document.getElementById('category_field');

        function toggleFields() {
            const appliesTo = appliesToField.value;
            
            // Reset selections when switching
            if (appliesTo === 'product') {
                productField.style.display = 'block';
                categoryField.style.display = 'none';
                $('#category_id').val(null).trigger('change');
            } else if (appliesTo === 'category') {
                productField.style.display = 'none';
                categoryField.style.display = 'block';
                $('#product_id').val(null).trigger('change');
            } else {
                productField.style.display = 'none';
                categoryField.style.display = 'none';
            }
        }

        appliesToField.addEventListener('change', toggleFields);
        toggleFields();
    });
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/discounts/form.blade.php ENDPATH**/ ?>
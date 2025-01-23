

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 mt-10">
    <div class="bg-white rounded-lg shadow-md">
        <div class="border-b border-gray-400 px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-800">Tambah Diskon</h3>
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
            <form action="<?php echo e(route('discounts.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <!-- Nama Diskon -->
                <div class="mb-4">
                    <label for="discount_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Diskon</label>
                    <input type="text" name="discount_name" id="discount_name" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           placeholder="Masukkan nama diskon" 
                           value="<?php echo e(old('discount_name')); ?>" 
                           required>
                </div>

                <!-- Tipe Diskon -->
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Diskon</label>
                    <select name="type" id="type" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            required>
                        <option value="percentage" <?php echo e(old('type') == 'percentage' ? 'selected' : ''); ?>>Persentase</option>
                        <option value="fixed" <?php echo e(old('type') == 'fixed' ? 'selected' : ''); ?>>Nominal Tetap</option>
                    </select>
                </div>

                <!-- Nilai Diskon -->
                <div class="mb-4">
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-2">Nilai Diskon</label>
                    <input type="number" name="value" id="value" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           placeholder="Masukkan nilai diskon" 
                           value="<?php echo e(old('value')); ?>" 
                           required>
                </div>

                <!-- Berlaku Untuk -->
                <div class="mb-4">
                    <label for="applies_to" class="block text-sm font-medium text-gray-700 mb-2">Berlaku Untuk</label>
                    <select name="applies_to" id="applies_to" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            required>
                        <option value="">-- Pilih --</option>
                        <option value="product" <?php echo e(old('applies_to') == 'product' ? 'selected' : ''); ?>>Produk Tertentu</option>
                        <option value="category" <?php echo e(old('applies_to') == 'category' ? 'selected' : ''); ?>>Kategori Produk</option>
                    </select>
                </div>

                <!-- Pilih Produk -->
                <div class="mb-4 <?php echo e(old('applies_to') == 'product' ? '' : 'hidden'); ?>" id="product_select">
                    <label for="product_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Produk</label>
                    <select name="product_id" id="product_id" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Produk --</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($product->product_id); ?>" <?php echo e(old('product_id') == $product->product_id ? 'selected' : ''); ?>>
                                <?php echo e($product->product_name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Pilih Kategori -->
                <div class="mb-4 <?php echo e(old('applies_to') == 'category' ? '' : 'hidden'); ?>" id="category_select">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kategori</label>
                    <select name="category_id" id="category_id" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->category_id); ?>" <?php echo e(old('category_id') == $category->category_id ? 'selected' : ''); ?>>
                                <?php echo e($category->category_name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Tanggal Mulai -->
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           value="<?php echo e(old('start_date')); ?>" 
                           required>
                </div>

                <!-- Tanggal Berakhir -->
                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir</label>
                    <input type="date" name="end_date" id="end_date" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           value="<?php echo e(old('end_date')); ?>" 
                           required>
                </div>

                <!-- Footer -->
                <div class="border-t border-gray-400 px-6 py-4 mt-6 flex justify-between">
                    <a href="<?php echo e(route('discounts.index')); ?>" 
                       class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                        Kembali
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const appliesToSelect = document.getElementById('applies_to');
        const productSelect = document.getElementById('product_select');
        const categorySelect = document.getElementById('category_select');
        const productInput = document.getElementById('product_id');
        const categoryInput = document.getElementById('category_id');

        appliesToSelect.addEventListener('change', function () {
            const value = this.value;

            if (value === 'product') {
                productSelect.classList.remove('hidden');
                categorySelect.classList.add('hidden');
                categoryInput.value = 0; // Set kategori ke 0 jika tidak relevan
            } else if (value === 'category') {
                productSelect.classList.add('hidden');
                categorySelect.classList.remove('hidden');
                productInput.value = 0; // Set produk ke 0 jika tidak relevan
            }
        });

        // Inisialisasi awal berdasarkan nilai applies_to
        appliesToSelect.dispatchEvent(new Event('change'));
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/discounts/create.blade.php ENDPATH**/ ?>
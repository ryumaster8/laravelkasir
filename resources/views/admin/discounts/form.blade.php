@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <x-flash-message />

    <h3 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($discount) ? 'Edit Diskon' : 'Tambah Diskon' }}</h3>

    <form action="{{ isset($discount) ? route('discounts.update', $discount->discount_id) : route('discounts.store') }}" method="POST">
        @csrf
        @if (isset($discount))
            @method('PUT')
        @endif

        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 space-y-4">
                <!-- Nama Diskon -->
                <div>
                    <label for="discount_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Diskon</label>
                    <input type="text" name="discount_name" id="discount_name" 
                           class="w-full px-3 py-2 text-gray-700 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                           placeholder="Masukkan nama diskon" 
                           value="{{ old('discount_name', $discount->discount_name ?? '') }}">
                </div>

                <!-- Tipe Diskon -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Diskon</label>
                    <select name="type" id="type" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                        <option value="percentage" {{ old('type', $discount->type ?? '') == 'percentage' ? 'selected' : '' }}>Persentase</option>
                        <option value="fixed" {{ old('type', $discount->type ?? '') == 'fixed' ? 'selected' : '' }}>Nominal Tetap</option>
                    </select>
                </div>

                <!-- Nilai Diskon -->
                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-1">Nilai Diskon</label>
                    <input type="number" name="value" id="value" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                           placeholder="Masukkan nilai diskon" 
                           value="{{ old('value', $discount->value ?? '') }}">
                </div>

                <!-- Berlaku Untuk -->
                <div>
                    <label for="applies_to" class="block text-sm font-medium text-gray-700 mb-1">Berlaku Untuk</label>
                    <select name="applies_to" id="applies_to" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="product" {{ old('applies_to', $discount->applies_to ?? '') == 'product' ? 'selected' : '' }}>Produk Tertentu</option>
                        <option value="category" {{ old('applies_to', $discount->applies_to ?? '') == 'category' ? 'selected' : '' }}>Kategori Produk</option>
                    </select>
                </div>

                <!-- Pilih Produk -->
                <div id="product_field" class="hidden">
                    <label for="product_search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                    <div class="relative">
                        <input type="text" id="product_search" 
                               class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                               placeholder="Ketik untuk mencari produk...">
                        <div id="product_results" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                            <!-- Results will be populated here -->
                        </div>
                    </div>
                    
                    <!-- Selected Products -->
                    <div id="selected_products" class="mt-3">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Produk Terpilih:</h4>
                        <div id="product_tags" class="flex flex-wrap gap-2">
                            <!-- Selected products will be shown here -->
                        </div>
                        <input type="hidden" name="product_id[]" id="product_ids">
                    </div>
                </div>

                <!-- Pilih Kategori -->
                <div id="category_field" class="hidden">
                    <label for="category_search" class="block text-sm font-medium text-gray-700 mb-1">Cari Kategori</label>
                    <div class="relative">
                        <input type="text" id="category_search" 
                               class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                               placeholder="Ketik untuk mencari kategori...">
                        <div id="category_results" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                            <!-- Results will be populated here -->
                        </div>
                    </div>
                    
                    <!-- Selected Categories -->
                    <div id="selected_categories" class="mt-3">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Kategori Terpilih:</h4>
                        <div id="category_tags" class="flex flex-wrap gap-2">
                            <!-- Selected categories will be shown here -->
                        </div>
                        <input type="hidden" name="category_id[]" id="category_ids">
                    </div>
                </div>

                <!-- Tanggal Mulai -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                           value="{{ old('start_date', $discount->start_date ?? '') }}">
                </div>

                <!-- Tanggal Berakhir -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                    <input type="date" name="end_date" id="end_date" 
                           class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                           value="{{ old('end_date', $discount->end_date ?? '') }}">
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-between">
                <a href="{{ route('discounts.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                    {{ isset($discount) ? 'Update Diskon' : 'Simpan Diskon' }}
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let selectedProducts = new Map();
        let selectedCategories = new Map();
        
        // Product Search
        $('#product_search').on('input', function() {
            const searchTerm = $(this).val();
            if (searchTerm.length >= 2) {
                $.get(`/api/products/search?term=${searchTerm}`, function(data) {
                    let html = '';
                    data.forEach(product => {
                        if (!selectedProducts.has(product.product_id)) {
                            html += `<div class="product-item p-2 hover:bg-gray-100 cursor-pointer" 
                                        data-id="${product.product_id}" 
                                        data-name="${product.product_name}"
                                        data-stock="${product.stock_total}">
                                        ${product.product_name} (Stok: ${product.stock_total})
                                    </div>`;
                        }
                    });
                    $('#product_results').html(html).removeClass('hidden');
                });
            } else {
                $('#product_results').addClass('hidden');
            }
        });

        // Category Search
        $('#category_search').on('input', function() {
            const searchTerm = $(this).val();
            if (searchTerm.length >= 2) {
                $.get(`/api/categories/search?term=${searchTerm}`, function(data) {
                    let html = '';
                    data.forEach(category => {
                        if (!selectedCategories.has(category.category_id)) {
                            html += `<div class="category-item p-2 hover:bg-gray-100 cursor-pointer" 
                                        data-id="${category.category_id}" 
                                        data-name="${category.category_name}">
                                        ${category.category_name}
                                    </div>`;
                        }
                    });
                    $('#category_results').html(html).removeClass('hidden');
                });
            } else {
                $('#category_results').addClass('hidden');
            }
        });

        // Select Product
        $(document).on('click', '.product-item', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const stock = $(this).data('stock');
            
            selectedProducts.set(id, {name, stock});
            updateProductTags();
            $('#product_search').val('');
            $('#product_results').addClass('hidden');
        });

        // Select Category
        $(document).on('click', '.category-item', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            
            selectedCategories.set(id, {name});
            updateCategoryTags();
            $('#category_search').val('');
            $('#category_results').addClass('hidden');
        });

        function updateProductTags() {
            let html = '';
            let ids = [];
            selectedProducts.forEach((data, id) => {
                html += `
                    <div class="inline-flex items-center bg-blue-100 text-blue-800 rounded px-2 py-1">
                        <span>${data.name}</span>
                        <button type="button" class="ml-1 text-blue-600 hover:text-blue-800 remove-product" data-id="${id}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                `;
                ids.push(id);
            });
            $('#product_tags').html(html);
            $('#product_ids').val(ids.join(','));
        }

        function updateCategoryTags() {
            let html = '';
            let ids = [];
            selectedCategories.forEach((data, id) => {
                html += `
                    <div class="inline-flex items-center bg-green-100 text-green-800 rounded px-2 py-1">
                        <span>${data.name}</span>
                        <button type="button" class="ml-1 text-green-600 hover:text-green-800 remove-category" data-id="${id}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                `;
                ids.push(id);
            });
            $('#category_tags').html(html);
            $('#category_ids').val(ids.join(','));
        }

        // Remove Product
        $(document).on('click', '.remove-product', function() {
            const id = $(this).data('id');
            selectedProducts.delete(id);
            updateProductTags();
        });

        // Remove Category
        $(document).on('click', '.remove-category', function() {
            const id = $(this).data('id');
            selectedCategories.delete(id);
            updateCategoryTags();
        });

        // Initialize with existing selections if any
        @if(isset($discount))
            @foreach($discount->products as $product)
                selectedProducts.set({{ $product->product_id }}, {
                    name: '{{ $product->product_name }}',
                    stock: '{{ $product->productStock->sum("stock") }}'
                });
            @endforeach
            @foreach($discount->categories as $category)
                selectedCategories.set({{ $category->category_id }}, {
                    name: '{{ $category->category_name }}'
                });
            @endforeach
            updateProductTags();
            updateCategoryTags();
        @endif

        // Toggle fields function
        const appliesToField = document.getElementById('applies_to');
        const productField = document.getElementById('product_field');
        const categoryField = document.getElementById('category_field');

        function toggleFields() {
            const appliesTo = appliesToField.value;
            
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
@endpush

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
@endsection



<?php $__env->startSection('title', 'Daftar Transaksi'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<style>
.btn-group .btn {
    padding: 0.375rem 1rem;
    font-size: 0.9rem;
}
.btn-group .btn i {
    margin-right: 5px;
}
.alert i {
    margin-right: 5px;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Transaksi</h2>
                
                <?php if($isParentUser): ?>
                    <div class="flex space-x-4 mb-4">
                        <a href="<?php echo e(route('transactions.index')); ?>" 
                           class="<?php echo e(!isset($showingGroupData) 
                                ? 'bg-indigo-600 text-white' 
                                : 'bg-white text-indigo-600 border border-indigo-600'); ?> 
                                px-4 py-2 rounded-md hover:opacity-90 flex items-center">
                            <i class="fas fa-store mr-2"></i>
                            Data Outlet Ini
                        </a>
                        <a href="<?php echo e(route('transactions.group')); ?>" 
                           class="<?php echo e(isset($showingGroupData) 
                                ? 'bg-indigo-600 text-white' 
                                : 'bg-white text-indigo-600 border border-indigo-600'); ?> 
                                px-4 py-2 rounded-md hover:opacity-90 flex items-center">
                            <i class="fas fa-store-alt mr-2"></i>
                            Data Semua Outlet
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="p-6">
                <?php if(isset($showingGroupData)): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Menampilkan data transaksi dari semua outlet dalam group
                    </div>
                <?php endif; ?>

                <!-- Filter -->
                <div class="mb-6">
                    <form action="<?php echo e(route('transactions.index')); ?>" method="GET" class="flex items-center space-x-4">
                        <div class="flex items-center space-x-4">
                            <!-- Date Filter -->
                            <div class="flex items-center space-x-2">
                                <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" 
                                       class="form-input rounded-md shadow-sm border-gray-300">
                                <span class="text-gray-500">sampai</span>
                                <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" 
                                       class="form-input rounded-md shadow-sm border-gray-300">
                            </div>

                            <!-- Operator Filter -->
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-500">Operator:</span>
                                <select name="operator_id" class="form-select rounded-md shadow-sm border-gray-300">
                                    <option value="">Semua Operator</option>
                                    <?php $__currentLoopData = $operators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($operator->user_id); ?>" <?php echo e(request('operator_id') == $operator->user_id ? 'selected' : ''); ?>>
                                            <?php echo e($operator->username); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Filter
                        </button>
                        
                        <?php if(request()->anyFilled(['start_date', 'end_date', 'operator_id'])): ?>
                            <a href="<?php echo e(route('transactions.index')); ?>" 
                               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                Reset
                            </a>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table id="transactionsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Operator</th>
                                <?php if(isset($showingGroupData)): ?>
                                    <th>Outlet</th>
                                <?php endif; ?>
                                <th>Jenis Penjualan</th>
                                <th>Total Amount</th>
                                <th>Jumlah Produk</th>
                                <th>Tanggal Transaksi</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo e($index + 1); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        #<?php echo e($transaction->transaction_id); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo e(optional($transaction->user)->username ?? '-'); ?>

                                    </td>
                                    <?php if(isset($showingGroupData)): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo e(optional($transaction->outlet)->outlet_name ?? '-'); ?>

                                        </td>
                                    <?php endif; ?>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo e(ucfirst($transaction->sale_type)); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp <?php echo e(number_format($transaction->total_amount, 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo e($transaction->items_count ?? count($transaction->items)); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo e($transaction->created_at->format('d/m/Y H:i')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo e(ucfirst($transaction->payment_method)); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?php echo e($transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                            <?php echo e(ucfirst($transaction->status)); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="<?php echo e(route('transactions.show', $transaction->transaction_id)); ?>" 
                                               class="bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700 flex items-center">
                                                <i class="fas fa-eye mr-1"></i>
                                                Detail
                                            </a>
                                            <a href="<?php echo e(route('receipt.print', $transaction->transaction_id)); ?>" 
                                               target="_blank"
                                               class="bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700 flex items-center">
                                                <i class="fas fa-print mr-1"></i>
                                                Cetak
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="11" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada transaksi
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transactionsTable').DataTable({
            responsive: true,
            processing: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            order: [[0, 'asc']],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/transactions/index.blade.php ENDPATH**/ ?>
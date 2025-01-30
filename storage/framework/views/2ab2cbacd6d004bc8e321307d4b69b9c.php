<?php $__env->startSection('title', 'Detail Penjualan Harian'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Detail Penjualan Tanggal <?php echo e(\Carbon\Carbon::parse($date)->format('d/m/Y')); ?>

            </h1>
            <a href="<?php echo e(route('sales.report')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <!-- Transaction Overview -->
        <div class="overflow-x-auto">
            <table class="min-w-full mb-6 border">
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <!-- Left side -->
                        <td class="p-4">
                            <table class="w-full">
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium w-1/3">Outlet</td>
                                    <td class="py-2 text-gray-800 w-2/3">: <?php echo e($transactions->first()->outlet->outlet_name); ?></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium">Operator</td>
                                    <td class="py-2 text-gray-800">: <?php echo e($transactions->first()->user->username); ?></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium">Total Transaksi</td>
                                    <td class="py-2 text-gray-800">: <?php echo e($transactions->count()); ?></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium">Total Penjualan</td>
                                    <td class="py-2 text-gray-800">: Rp <?php echo e(number_format($transactions->sum('total_amount'), 0, ',', '.')); ?></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 text-gray-600 font-medium">Total Item</td>
                                    <td class="py-2 text-gray-800">: <?php echo e($transactions->sum(function($t) { return $t->items->count(); })); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Transactions Table -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-list mr-2"></i>Daftar Transaksi
            </h2>
            <table id="transactionsTable" class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Item</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($index + 1); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($transaction->created_at->format('d/m/Y')); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($transaction->created_at->format('H:i:s')); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">#<?php echo e($transaction->transaction_id); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($transaction->user->username); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php echo e($transaction->sale_type === 'grosir' 
                                ? $transaction->wholesaleCustomer->customer_name ?? '-'
                                : '-'); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($transaction->items->count()); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp <?php echo e(number_format($transaction->total_amount, 0, ',', '.')); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full <?php echo e($transaction->payment_method === 'tunai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'); ?>">
                                <?php echo e(ucfirst($transaction->payment_method)); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full <?php echo e($transaction->sale_type === 'grosir' ? 'bg-purple-100 text-purple-800' : 'bg-indigo-100 text-indigo-800'); ?>">
                                <?php echo e(ucfirst($transaction->sale_type)); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full <?php echo e($transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                <?php echo e(ucfirst($transaction->status)); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <a href="<?php echo e(route('transactions.detail', ['id' => $transaction->transaction_id])); ?>" 
                               class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i> Detail Produk
                            </a>
                            <a href="<?php echo e(route('receipt.print', $transaction->transaction_id)); ?>" 
                               target="_blank"
                               class="text-green-600 hover:text-green-900">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    $('#transactionsTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[1, 'asc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/transactions/show.blade.php ENDPATH**/ ?>
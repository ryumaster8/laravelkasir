<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk #<?php echo e($transaction->transaction_id); ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            margin: 0;
            padding: 10px;
        }
        .receipt {
            width: 80mm;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .item {
            margin: 5px 0;
        }
        .total {
            margin-top: 10px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        @media print {
            body {
                width: 80mm;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt">
        <div class="header">
            <h2><?php echo e($transaction->outlet->outlet_name); ?></h2>
            <p><?php echo e($transaction->outlet->address); ?></p>
            <p><?php echo e($transaction->outlet->contact_info); ?></p>
            <p>================================</p>
            <p>No: #<?php echo e($transaction->transaction_id); ?></p>
            <p><?php echo e($transaction->created_at->format('d/m/Y H:i')); ?></p>
            <p>Kasir: <?php echo e($transaction->user->username); ?></p>
            <p>================================</p>
        </div>

        <?php $__currentLoopData = $transaction->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item">
            <div><?php echo e($item->product->product_name); ?></div>
            <div><?php echo e($item->quantity); ?> x <?php echo e(number_format($item->price, 0, ',', '.')); ?></div>
            <div style="text-align: right">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="total">
            <p>Total: Rp <?php echo e(number_format($transaction->total_amount, 0, ',', '.')); ?></p>
            <p>Bayar: Rp <?php echo e(number_format($transaction->paid_amount, 0, ',', '.')); ?></p>
            <p>Kembali: Rp <?php echo e(number_format($transaction->change_amount, 0, ',', '.')); ?></p>
            <p>================================</p>
            <p style="text-align: center">Terima Kasih</p>
            <p style="text-align: center">Atas Kunjungan Anda</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/transactions/receipt.blade.php ENDPATH**/ ?>
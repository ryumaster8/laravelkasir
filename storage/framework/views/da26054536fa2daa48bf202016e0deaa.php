<?php if(is_array($data)): ?>
    <div class="text-sm">
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-1">
                <span class="font-medium"><?php echo e(ucwords(str_replace('_', ' ', $key))); ?>:</span>
                <?php if(is_array($value)): ?>
                    <pre class="text-xs"><?php echo e(json_encode($value, JSON_PRETTY_PRINT)); ?></pre>
                <?php else: ?>
                    <span><?php echo e($value); ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <?php echo e($data); ?>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/activity-logs/description.blade.php ENDPATH**/ ?>
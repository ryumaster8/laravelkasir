

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
            <h4 class="text-xl font-semibold text-white">Permintaan Perubahan Membership</h4>
        </div>
        <div class="p-6">
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Outlet</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Membership</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Request</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Request</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Pembayaran</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm"><?php echo e($index + 1); ?></td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo e(optional($request->outlet)->outlet_name ?? 'N/A'); ?>

                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php echo e(optional($request->outlet)->phone ?? 'N/A'); ?>

                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($request->change_type === 'downgrade'
                                        ? 'bg-yellow-100 text-yellow-800' 
                                        : 'bg-green-100 text-green-800'); ?>">
                                        <?php echo e(ucfirst($request->change_type)); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm text-gray-900">
                                        From: <?php echo e(optional($request->currentMembership)->membership_name ?? 'N/A'); ?>

                                        <span class="text-xs text-gray-500">(Rank: <?php echo e(optional($request->currentMembership)->rank); ?>)</span>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        To: <?php echo e(optional($request->requestedMembership)->membership_name ?? 'N/A'); ?>

                                        <span class="text-xs text-gray-500">(Rank: <?php echo e(optional($request->requestedMembership)->rank); ?>)</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Rp <?php echo e(number_format($request->change_fee, 0, ',', '.')); ?>

                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <?php echo e($request->requested_at ? $request->requested_at->format('d/m/Y H:i') : 'N/A'); ?>

                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php switch($request->status):
                                            case ('pending'): ?>
                                                bg-yellow-100 text-yellow-800
                                                <?php break; ?>
                                            <?php case ('approved'): ?>
                                                bg-blue-100 text-blue-800
                                                <?php break; ?>
                                            <?php case ('rejected'): ?>
                                                bg-red-100 text-red-800
                                                <?php break; ?>
                                        <?php endswitch; ?>
                                    ">
                                        <?php echo e(ucfirst($request->status)); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php switch($request->payment_status):
                                            case ('unpaid'): ?>
                                                bg-red-100 text-red-800
                                                <?php break; ?>
                                            <?php case ('paid'): ?>
                                                bg-yellow-100 text-yellow-800
                                                <?php break; ?>
                                            <?php case ('verified'): ?>
                                                bg-green-100 text-green-800
                                                <?php break; ?>
                                        <?php endswitch; ?>
                                    ">
                                        <?php switch($request->payment_status):
                                            case ('unpaid'): ?>
                                                Belum Dibayar
                                                <?php break; ?>
                                            <?php case ('paid'): ?>
                                                Menunggu Verifikasi
                                                <?php break; ?>
                                            <?php case ('verified'): ?>
                                                Terverifikasi
                                                <?php break; ?>
                                        <?php endswitch; ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        
                                        <?php if($request->status === 'pending'): ?>
                                            <form action="<?php echo e(route('owner.membership.approve-request', $request->request_id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                                    Setujui
                                                </button>
                                            </form>
                                            
                                            <button onclick="openRejectionModal('<?php echo e($request->request_id); ?>')" 
                                                    type="button" 
                                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                Tolak
                                            </button>
                                        <?php endif; ?>

                                        
                                        <?php if($request->payment_proof): ?>
                                            <a href="<?php echo e(asset('storage/bukti_transfer/' . $request->payment_proof)); ?>" 
                                               target="_blank"
                                               class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">
                                                Bukti
                                            </a>
                                        <?php endif; ?>

                                        
                                        <?php if($request->status === 'approved' && $request->payment_status === 'paid'): ?>
                                            <form action="<?php echo e(route('owner.membership.verify-payment', $request->request_id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                                    Verifikasi
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        
                                        
                                        <?php if($request->status === 'approved' && $request->payment_status === 'verified' && !$request->processed_at): ?>
                                            <form action="<?php echo e(route('owner.membership.process-request', $request->request_id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                    Proses
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        
                                        <?php if($request->status === 'rejected' || ($request->processed_at && $request->payment_status === 'verified')): ?>
                                            <form action="<?php echo e(route('owner.membership.delete-request', $request->request_id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Hapus
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada permintaan perubahan membership
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="rejectionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" role="dialog">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900">Alasan Penolakan</h3>
            <form id="rejectionForm" method="POST" class="mt-4">
                <?php echo csrf_field(); ?>
                <textarea name="reason" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" required></textarea>
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectionModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openRejectionModal(requestId) {
        const modal = document.getElementById('rejectionModal');
        const form = document.getElementById('rejectionForm');
        form.action = `<?php echo e(url('owner/membership/reject-request')); ?>/${requestId}`;
        modal.classList.remove('hidden');
    }

    function closeRejectionModal() {
        const modal = document.getElementById('rejectionModal');
        modal.classList.add('hidden');
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts_dashboard_owner.layout_owner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/membership/change-requests.blade.php ENDPATH**/ ?>
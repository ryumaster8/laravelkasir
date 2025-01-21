

<?php $__env->startSection('title', 'Log Aktivitas'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Log Aktivitas</h2>

    <div class="overflow-x-auto">
        <table id="activityLogsTable" class="min-w-full bg-white">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Operator</th>
                    <th>Outlet</th>
                    <th>Aksi</th>
                    <th>Deskripsi</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    $('#activityLogsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo e(route('activity-logs.index')); ?>",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'operator', name: 'operator'},
            {data: 'outlet', name: 'outlet'},
            {data: 'action', name: 'action'},
            {data: 'description', name: 'description'},
            {data: 'timestamp', name: 'timestamp'},
        ],
        order: [[5, 'desc']],
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
            },
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/activity-logs/index.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4299e1;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            border: 1px solid #e2e8f0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #718096;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .details-table th, .details-table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .details-table th {
            background-color: #f8f9fa;
        }
        .signature {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Persetujuan Perubahan Membership</h1>
        </div>
        <div class="content">
            <p>Yth. <?php echo e($outletName); ?>,</p>
            
            <p>Permintaan perubahan membership Anda telah disetujui.</p>
            
            <h3>Detail Membership:</h3>
            <table class="details-table">
                <tr>
                    <th>Membership Saat Ini</th>
                    <td><?php echo e($membershipRequest->currentMembership->membership_name); ?></td>
                </tr>
                <tr>
                    <th>Membership Baru</th>
                    <td><?php echo e($newMembership); ?></td>
                </tr>
                <tr>
                    <th>Biaya <?php echo e(ucfirst($membershipRequest->change_type)); ?></th>
                    <td>Rp <?php echo e($changeFee); ?></td>
                </tr>
                <tr>
                    <th>Biaya Bulanan</th>
                    <td>Rp <?php echo e(number_format($membershipRequest->requestedMembership->biaya_bulanan, 0, ',', '.')); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Aktivasi</th>
                    <td><?php echo e($membershipRequest->outlet->membership_started_at->format('d F Y')); ?></td>
                </tr>
                <tr>
                    <th>Jatuh Tempo</th>
                    <td><?php echo e($membershipRequest->outlet->membership_expires_at->format('d F Y')); ?></td>
                </tr>
            </table>

            <p>Silakan melakukan pembayaran sesuai dengan biaya yang tertera untuk mengaktifkan membership baru Anda.</p>

            <p>Jika Anda memiliki pertanyaan, silakan hubungi tim support kami.</p>
        </div>
        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami</p>
            <div class="signature">
                <p>DigisoftStudio</p>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/emails/membership-request-approved.blade.php ENDPATH**/ ?>
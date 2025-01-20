<!DOCTYPE html>
<html>
<head>
    <style>
        /* ...existing styles from membership-request-approved.blade.php... */
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Notifikasi Persetujuan Membership</h1>
        </div>
        <div class="content">
            <p>Halo Owner,</p>
            
            <p>Perubahan membership telah disetujui untuk outlet berikut:</p>
            
            <ul>
                <li>Nama Outlet: {{ $outletName }}</li>
                <li>Membership Baru: {{ $newMembership }}</li>
                <li>Biaya Perubahan: Rp {{ $changeFee }}</li>
            </ul>

            <p>Mohon pantau pembayaran dan proses aktivasi membership baru.</p>
        </div>
        <div class="footer">
            <p>Sistem Notifikasi Manajemen Membership</p>
        </div>
    </div>
</body>
</html>

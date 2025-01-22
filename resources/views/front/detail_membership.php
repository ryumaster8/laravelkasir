<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Membership - <?= esc($membership['membership_name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center">Detail Membership: <?= esc($membership['membership_name']); ?></h1>
        <div class="card my-4">
            <div class="card-body">
                <h3 class="card-title">Rp<?= number_format($membership['biaya_bulanan'], 0, ',', '.'); ?> / bulan</h3>
                <p class="card-text">Biaya Pendaftaran: Rp<?= number_format($membership['biaya_pendaftaran'], 0, ',', '.'); ?></p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Limit Cabang: <?= esc($membership['branch_limit']); ?></li>
                    <li class="list-group-item">Limit Transaksi Harian: <?= esc($membership['daily_transaction_limit']); ?></li>
                    <li class="list-group-item">Limit Penambahan Produk Harian: <?= esc($membership['daily_product_addition_limit']); ?></li>
                    <li class="list-group-item">Limit Pengguna: <?= esc($membership['user_limit']); ?></li>
                    <li class="list-group-item">Fitur Grosir: <?= $membership['wholesale_feature'] ? 'Ya' : 'Tidak'; ?></li>
                    <li class="list-group-item">Fitur Chat: <?= $membership['chat_feature'] ? 'Ya' : 'Tidak'; ?></li>
                    <li class="list-group-item">Fitur Diskon: <?= $membership['discount_feature'] ? 'Ya' : 'Tidak'; ?></li>
                    <li class="list-group-item">Fitur Audit Stok: <?= $membership['stock_audit_feature'] ? 'Ya' : 'Tidak'; ?></li>
                    <li class="list-group-item">Fitur Log Aktivitas: <?= $membership['log_activity_feature'] ? 'Ya' : 'Tidak'; ?></li>
                </ul>
                <a href="<?= base_url('/'); ?>" class="btn btn-primary mt-4">Kembali</a>
            </div>
        </div>
    </div>
</body>

</html>
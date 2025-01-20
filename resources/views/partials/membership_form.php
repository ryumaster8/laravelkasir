<?php
// Memastikan bahwa variabel $prefix ada dan memiliki nilai default jika belum ada
if (!isset($prefix)) {
    $prefix = ''; // Atur nilai default jika belum ada
}
?>

<div class="mb-3">
    <label for="<?= $prefix ?>_branch_limit" class="form-label">Batas Cabang</label>
    <input type="number" class="form-control" id="<?= $prefix ?>_branch_limit" name="<?= $prefix ?>_branch_limit" value="<?= esc(isset($membership['branch_limit']) ? $membership['branch_limit'] : 0) ?>" required>
</div>

<div class="mb-3">
    <label for="<?= $prefix ?>_daily_transaction_limit" class="form-label">Batas Transaksi Perhari</label>
    <input type="number" class="form-control" id="<?= $prefix ?>_daily_transaction_limit" name="<?= $prefix ?>_daily_transaction_limit" value="<?= esc(isset($membership['daily_transaction_limit']) ? $membership['daily_transaction_limit'] : 0) ?>" required>
</div>

<div class="mb-3">
    <label for="<?= $prefix ?>_daily_product_addition_limit" class="form-label">Batas Penambahan Produk Perhari</label>
    <input type="number" class="form-control" id="<?= $prefix ?>_daily_product_addition_limit" name="<?= $prefix ?>_daily_product_addition_limit" value="<?= esc(isset($membership['daily_product_addition_limit']) ? $membership['daily_product_addition_limit'] : 0) ?>" required>
</div>

<div class="mb-3">
    <label for="<?= $prefix ?>_user_limit" class="form-label">Batas Pengguna</label>
    <input type="number" class="form-control" id="<?= $prefix ?>_user_limit" name="<?= $prefix ?>_user_limit" value="<?= esc(isset($membership['user_limit']) ? $membership['user_limit'] : 0) ?>" required>
</div>

<div class="mb-3">
    <label for="<?= $prefix ?>_service_feature" class="form-label">Fitur Servis</label>
    <select class="form-select" id="<?= $prefix ?>_service_feature" name="<?= $prefix ?>_service_feature">
        <option value="0" <?= isset($membership['service_feature']) && $membership['service_feature'] == 0 ? 'selected' : '' ?>>Tidak</option>
        <option value="1" <?= isset($membership['service_feature']) && $membership['service_feature'] == 1 ? 'selected' : '' ?>>Ya</option>
    </select>
</div>

<div class="mb-3">
    <label for="<?= $prefix ?>_wholesale_feature" class="form-label">Fitur Grosir</label>
    <select class="form-select" id="<?= $prefix ?>_wholesale_feature" name="<?= $prefix ?>_wholesale_feature">
        <option value="0" <?= isset($membership['wholesale_feature']) && $membership['wholesale_feature'] == 0 ? 'selected' : '' ?>>Tidak</option>
        <option value="1" <?= isset($membership['wholesale_feature']) && $membership['wholesale_feature'] == 1 ? 'selected' : '' ?>>Ya</option>
    </select>
</div>

<div class="mb-3">
    <label for="<?= $prefix ?>_service_receipt_printing" class="form-label">Fitur Cetak Nota Servis</label>
    <select class="form-select" id="<?= $prefix ?>_service_receipt_printing" name="<?= $prefix ?>_service_receipt_printing">
        <option value="0" <?= isset($membership['service_receipt_printing']) && $membership['service_receipt_printing'] == 0 ? 'selected' : '' ?>>Tidak</option>
        <option value="1" <?= isset($membership['service_receipt_printing']) && $membership['service_receipt_printing'] == 1 ? 'selected' : '' ?>>Ya</option>
    </select>
</div>
<?php
include "../../config/dbkoneksi.php";
date_default_timezone_set('Asia/Jakarta');

$id = $_GET['id'] ?? 0;
$stmt = $dbh->prepare("SELECT transaksi.*, kendaraan.nopol FROM transaksi JOIN kendaraan ON transaksi.kendaraan_id = kendaraan.id WHERE transaksi.id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan!</div>";
    include "../templates/footer.php";
    exit;
}

?>

<h1>Parkiran Management</h1>
<h3>Konfirmasi Keluar Kendaraan</h3>

<form method="POST" action="selesai.php">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="mb-3">
        <label>No Polisi</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($data['nopol']) ?>" disabled>
    </div>
    <div class="mb-3">
        <label>Jam Keluar</label>
        <input type="time" name="jam_keluar" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Selesaikan</button>
</form>
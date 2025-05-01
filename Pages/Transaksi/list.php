<?php
include "../../config/dbkoneksi.php";
date_default_timezone_set('Asia/Jakarta');

$stmt = $dbh->query('
    SELECT transaksi.*, kendaraan.nopol, kendaraan.jenis_kendaraan_id, biaya, area_parkir.nama AS nama 
    FROM transaksi 
    JOIN kendaraan ON transaksi.kendaraan_id = kendaraan.id 
    JOIN area_parkir ON transaksi.area_parkir_id = area_parkir.id
    ORDER BY transaksi.id DESC
');
$rs = $stmt->fetchAll();

function getJenis($jenis_id) {
    return ($jenis_id == 1) ? "Motor" : (($jenis_id == 2) ? "Mobil" : "Sepeda / Lainnya");
}
?>

<h1>Parkiran Management</h1> <hr>
<h3>Daftar Kendaraan Parkir Aktif</h3>
<div>
    <a href="masuk.php">+ Tambah Kendaraan</a>
    <a href="../../index.php"><- Kembali Ke Beranda</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>No Polisi</th>
            <th>Jenis</th>
            <th>Jam Masuk</th>
            <th>Biaya</th>
            <th>Area Parkir</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rs as $i => $row): ?>
        <tr>
            <td><?= $i+1 ?></td>
            <td><?= htmlspecialchars($row['nopol']) ?></td>
            <td><?= getJenis($row['jenis_kendaraan_id']) ?></td>
            <td><?= $row['mulai'] ?></td>
            <td>
                <?php 
                    if ($row['biaya'] > 0) {
                        echo "<span class='badge bg-success'>Rp" . number_format($row['biaya'], 0, ",", ".") . "</span>";
                    } else {
                        echo "<span class='badge bg-secondary'>Belum Bayar</span>";
                    }
                ?>
            </td>
            <td><?= htmlspecialchars($row['nama'])?></td>

            <td>
                <a href="keluar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Keluar</a>
                <a href="selesai.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
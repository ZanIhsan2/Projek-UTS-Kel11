<?php

// Koneksi Database
include "../../config/dbkoneksi.php";

// Mengambil data dari Database
$sql = "SELECT k.*, jk.nama AS nama 
        FROM kendaraan k
        JOIN jenis jk ON k.jenis_kendaraan_id = jk.id";
$rs = $dbh->query($sql);

?>

<!-- Table untuk menampilkan data -->
 <div>
    <div>
        <h1>Daftar Kendaraan</h1>
        <a href="form.php">+ Kendaraan</a>
        <a href="../../index.php"><- Kembali ke Beranda</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Merek</th>
                <th>Pemilik</th>
                <th>Nopol</th>
                <th>Tahun Beli</th>
                <th>Deskripsi</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rs as $i => $row): ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><?= htmlspecialchars($row['merk']) ?></td>
                <td><?= htmlspecialchars($row['pemilik']) ?></td>
                <td><?= htmlspecialchars($row['nopol']) ?></td>
                <td><?= htmlspecialchars($row['tahun_beli']) ?></td>
                <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>
                    <a href="form.php?id=<?= $row['id']?>">Edit</a>
                    <a href="proses.php?hapus=true&id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 </div>
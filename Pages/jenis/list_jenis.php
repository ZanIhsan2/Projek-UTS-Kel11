<?php

// Koneksi Database
include "../../config/dbkoneksi.php";

// Mengambil data dari Database
$sql = "SELECT * FROM jenis";
$rs = $dbh->query($sql);

?>

<!-- Table untuk menampilkan data -->
 <div>
    <div>
        <h1>Daftar Jenis Kendaraan</h1>
        <a href="form_jenis.php">+ Jenis</a>
        <a href="../../index.php"><- Kembali ke Beranda</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rs as $i => $row): ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>
                    <a href="form_jenis.php?id=<?= $row['id']?>">Edit</a>
                    <a href="proses_jenis.php?hapus=true&id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 </div>
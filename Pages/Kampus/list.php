<?php

// Koneksi Database
include "../../config/dbkoneksi.php";

// Mengambil data dari Database
$sql = "SELECT * FROM kampus";
$rs = $dbh->query($sql);

?>

<!-- Table untuk menampilkan data -->
 <div>
    <div>
        <h1>Daftar Kampus</h1>
        <a href="tambah.php">+ Kampus</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kampus</th>
                <th>Lokasi</th>
                <th>latitude</th>
                <th>longitude</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rs as $i => $row): ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td><?= htmlspecialchars($row['latitude']) ?></td>
                <td><?= htmlspecialchars($row['longitude']) ?></td>
                <td>
                    <a href="">Edit</a>
                    <a href="?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 </div>
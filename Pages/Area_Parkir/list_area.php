<?php 

// Koneksi Database
require_once '../../config/dbkoneksi.php';

// Mengambil data dari table Database
$sql = "SELECT ap.*, k.nama AS kampus 
        FROM area_parkir ap
        JOIN kampus k ON ap.kampus_id = k.id";
$rs = $dbh->query($sql);

?>

<!-- Table Untuk menampilkan data -->
 <div>
    <div>
        <h1>Daftar Area Parkir</h1>
        <a href="form_area.php">+ Area Parkir</a>
        <a href="../../index.php"><- Kembali ke Beranda</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kapasitas</th>
                <th>Keterangan</th>
                <th>Kampus</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rs as $i => $row): ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= htmlspecialchars($row['nama'])?></td>
                    <td><?= htmlspecialchars($row['kapasitas'])?></td>
                    <td><?= htmlspecialchars($row['keterangan'])?></td>
                    <td><?= htmlspecialchars($row['kampus'])?></td>
                    <td>
                        <a href="form_area.php?id=<?= $row['id'] ?> ">Edit</a>
                        <a href="proses_area.php?hapus=true&id=<?= $row['id'] ?>" onclick="return confirm('Yakin Ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach;?>    
        </tbody>
    </table>
 </div>

<?php

// Koneksi Database
include "./config/dbkoneksi.php";

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
    </table>
 </div>
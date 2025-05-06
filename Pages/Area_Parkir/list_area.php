<?php

// Koneksi Database
require_once '../../config/dbkoneksi.php';

// Mengambil data dari table Database beserta nama kampus
$sql = "SELECT ap.*, k.nama AS kampus
        FROM area_parkir ap
        JOIN kampus k ON ap.kampus_id = k.id";
$rs = $dbh->query($sql);

?>

  <!DOCTYPE html>
     <html lang="id">
         <head>
           <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Daftar Area Parkir</title>
                <style>
                    body {
                        font-family: sans-serif;
                        background-color:rgb(35, 38, 41); /* Warna latar belakang awal */
                        margin: 20px;
                    }

                    .container {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        overflow-x: auto; /* Agar tabel responsif jika lebar layar kecil */
                    }

                    h1 {
                        text-align: center;
                        color: #333;
                        margin-bottom: 20px;
                    }

                    .action-buttons {
                        margin-bottom: 15px;
                    }

                    .action-buttons a {
                        display: inline-block;
                        padding: 8px 12px;
                        margin-right: 10px;
                        text-decoration: none;
                        color: white;
                        border-radius: 4px;
                    }

                    .btn-tambah {
                        background-color: #28a745;
                    }

                    .btn-kembali {
                        background-color: #007bff;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }

                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }

                    th {
                        background-color:rgb(106, 164, 197);
                        font-weight: bold;
                    }

                    tbody tr:nth-child(even) {
                        background-color:rgb(255, 255, 255);
                    }

                    .aksi-column {
                        white-space: nowrap; /* Mencegah tombol aksi pecah baris */
                    }

                    .aksi-column a {
                        display: inline-block;
                        padding: 6px 10px;
                        margin-right: 5px;
                        text-decoration: none;
                        border-radius: 4px;
                        font-size: 14px;
                    }

                    .btn-edit {
                        background-color: #ffc107;
                        color: #333;
                    }

                    .btn-hapus {
                        background-color: #dc3545;
                        color: white;
                    }

                    .btn-edit:hover {
                        background-color: #e0a800;
                    }

                    .btn-hapus:hover {
                        background-color: #c82333;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Daftar Area Parkir</h1>
                    <div class="action-buttons">
                        <a href="form_area.php" class="btn-tambah">+ Area Parkir</a>
                        <a href="../../index.php" class="btn-kembali">← Kembali ke Beranda</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kapasitas</th>
                                <th>Keterangan</th>
                                <th>Kampus</th>
                                <th class="aksi-column">Aksi</th>
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
                                    <td class="aksi-column">
                                        <a href="form_area.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                                        <a href="proses_area.php?hapus=true&id=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <script>
                    // Anda bisa menambahkan JavaScript di sini jika diperlukan
                </script>
            </body>
            </html>
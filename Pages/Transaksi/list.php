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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Parkiran Management</title>
    <style>
        body {
            font-family: sans-serif;
            background-color:rgb(117, 112, 112);
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1, h3 {
            color: #333;
            text-align: center;
            margin-bottom: 15px;
        }

        hr {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            width: 80%;
        }

        .controls {
            margin-bottom: 15px;
        }

        .controls a {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            margin-right: 10px;
        }

        .controls a:first-child {
            background-color: #28a745; /* Green for Add */
        }

        .controls a:last-child {
            background-color: #6c757d; /* Grey for Back */
        }

        .table-container {
            width: 100%;
            overflow-x: auto; /* Enable horizontal scrolling for small screens */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap; /* Prevent text wrapping in cells */
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-secondary {
            background-color: #6c757d !important;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            font-size: 0.9em;
            font-weight: 400;
            line-height: 1.5;
            color: #fff;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            margin-right: 5px;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #333;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        @media (max-width: 768px) {
            .table th, .table td {
                white-space: normal; /* Allow text wrapping on smaller screens */
                padding: 8px;
                font-size: 0.9em;
            }

            .controls a {
                padding: 8px 10px;
                font-size: 0.9em;
                margin-right: 5px;
            }

            .btn {
                padding: 6px 10px;
                font-size: 0.8em;
                margin-right: 3px;
            }
        }
    </style>
</head>
<body>
    <h1>Parkiran Management</h1>
    <hr>
    <h3>Daftar Kendaraan Parkir Aktif</h3>
    <div class="controls">
        <a href="masuk.php">+ Tambah Kendaraan</a>
        <a href="../../admin.php"><- Kembali Ke Beranda</a>
    </div>

    <div class="table-container">
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
    </div>
</body>
</html>
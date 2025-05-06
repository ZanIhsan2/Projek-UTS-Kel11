<?php
// Koneksi Database
include "../../config/dbkoneksi.php";

// Mengambil data dari Database
$sql = "SELECT k.*, jk.nama AS nama
          FROM kendaraan k
          JOIN jenis jk ON k.jenis_kendaraan_id = jk.id";
$rs = $dbh->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kendaraan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to bottom,rgb(102, 102, 109), #ffffff); /* Gradien biru muda ke putih */
        }
    </style>
</head>
<body class="text-gray-800 font-sans min-h-screen py-10">
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Kendaraan</h1>
        <div class="space-x-2">
            <a href="form.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:ring focus:ring-blue-300 focus:outline-none transition duration-300">+ Tambah Kendaraan</a>
            <a href="../../index.php" class="text-blue-600 hover:underline focus:outline-none transition duration-300">← Kembali ke Beranda</a>
        </div>
    </div>
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-200 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Merek</th>
                    <th class="px-4 py-3">Pemilik</th>
                    <th class="px-4 py-3">Nopol</th>
                    <th class="px-4 py-3">Tahun Beli</th>
                    <th class="px-4 py-3">Deskripsi</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($rs as $i => $row): ?>
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-4 py-3"><?= $i+1 ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($row['merk']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($row['pemilik']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($row['nopol']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($row['tahun_beli']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($row['deskripsi']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($row['nama']) ?></td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <a href="form.php?id=<?= $row['id']?>" class="text-blue-600 hover:underline focus:outline-none transition duration-300">Edit</a>
                        <a href="proses.php?hapus=true&id=<?= $row['id'] ?>"
                           onclick="return confirm('Yakin ingin menghapus data ini?')"
                           class="text-red-600 hover:underline focus:outline-none transition duration-300">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if ($rs->rowCount() === 0): ?>
                <tr>
                    <td colspan="8" class="text-center px-4 py-6 text-gray-500">Tidak ada data kendaraan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

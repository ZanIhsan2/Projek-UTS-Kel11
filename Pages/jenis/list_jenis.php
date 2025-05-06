<?php
include "../../config/dbkoneksi.php";

// Ambil data jenis
$sql = "SELECT * FROM jenis";
$rs = $dbh->query($sql);
?>
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Daftar Jenis Kendaraan</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                function ubahWarna() {
                    const selectedColor = document.getElementById('bgColor').value;
                    document.body.className = selectedColor + " min-h-screen py-10 px-6 transition-all duration-300";
                }
            </script>
            <style>
                body {
                    background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');
                    background-repeat: repeat;
                }
            </style>
        </head>
        <body class="bg-gray-100 min-h-screen py-10 px-6 transition-all duration-300">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">🚗 Daftar Jenis Kendaraan</h1>
                <div class="flex items-center gap-2">
                    <label for="bgColor" class="text-sm">Latar:</label>
                    <select id="bgColor" onchange="ubahWarna()" class="border rounded px-2 py-1">
                        <option value="bg-gray-100">Abu-Abu</option>
                        <option value="bg-red-100">Merah Muda</option>
                        <option value="bg-orange-100">Oranye Pastel</option>
                        <option value="bg-yellow-100">Kuning Lembut</option>
                        <option value="bg-green-100">Hijau Pastel</option>
                        <option value="bg-blue-100">Biru Muda</option>
                        <option value="bg-indigo-100">Indigo</option>
                        <option value="bg-purple-100">Ungu</option>
                        <option value="bg-pink-100">Pink Lembut</option>
                        <option value="bg-white">Putih</option>
                    </select>
                    <a href="form_jenis.php" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Jenis</a>
                    <a href="../../index.php" class="text-gray-600 hover:underline ml-2">← Beranda</a>
                </div>
            </div>
            <table class="w-full border border-gray-300 rounded overflow-hidden">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="border px-4 py-2 text-left">No</th>
                        <th class="border px-4 py-2 text-left">Nama</th>
                        <th class="border px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rs as $i => $row): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2"><?= $i + 1 ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['nama']) ?></td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="form_jenis.php?id=<?= $row['id']?>" class="text-blue-600 hover:underline">Edit</a>
                            <a href="proses_jenis.php?hapus=true&id=<?= $row['id'] ?>" 
                            onclick="return confirm('Yakin ingin menghapus data ini?')" 
                            class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </body>
        </html>

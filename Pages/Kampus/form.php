<?php
// Koneksi ke database
require_once '../../config/dbkoneksi.php';

// Ambil data kampus jika ada ID
$id = $_GET['id'] ?? '';
$data = [];
if ($id) {
    $sql = "SELECT * FROM kampus WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-400 via-blue-500 to-indigo-600">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800"><?= $id ? 'Edit' : 'Tambah' ?> Data Kampus</h2>

        <!-- Tombol Kembali -->
        <div class="mb-4 text-right">
            <a href="list.php" class="text-blue-500 hover:text-blue-700">← Kembali ke Daftar Kampus</a>
        </div>

        <!-- Formulir Kampus -->
        <form method="POST" action="proses.php">
            <input type="hidden" name="id_edit" value="<?= $data['id'] ?? '' ?>">

            <div class="mb-4">
                <label class="block text-gray-700">Nama Kampus:</label>
                <input type="text" name="nama" value="<?= $data['nama'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Alamat:</label>
                <input type="text" name="alamat" value="<?= $data['alamat'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Latitude:</label>
                <input type="number" step="any" name="latitude" value="<?= $data['latitude'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Longitude:</label>
                <input type="number" step="any" name="longtitude" value="<?= $data['longtitude'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex justify-between items-center mt-6">
                <button type="submit" name="proses" value="<?= $id ? 'Update' : 'Simpan' ?>" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none">
                    <?= $id ? 'Update' : 'Simpan' ?>
                </button>
                <a href="list.php" class="text-gray-500 hover:text-gray-700">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>

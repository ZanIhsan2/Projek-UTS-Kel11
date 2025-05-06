<?php
// Koneksi ke database
require_once '../../config/dbkoneksi.php';

// Query jenis
$sqlJenis = "SELECT * FROM jenis";
$rsJenis = $dbh->query($sqlJenis);

// Query data kendaraan jika ada ID
$id = $_GET['id'] ?? '';
$data = [];
if ($id) {
    $sql = "SELECT * FROM kendaraan WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Kendaraan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen flex items-center justify-center /* Ganti bagian ini untuk latar belakang */ bg-gradient-to-r from-green-400 via-blue-500 to-indigo-600">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800"><?= $id ? 'Edit' : 'Tambah' ?> Data Kendaraan</h2>
        <!-- Tombol Kembali -->
        <div class="mb-4 text-right">
            <a href="list.php" class="text-blue-500 hover:text-blue-700">← Kembali ke Daftar Kendaraan</a>
        </div>
        <!-- Formulir -->
        <form method="POST" action="proses.php">
            <input type="hidden" name="id_edit" value="<?= $data['id'] ?? '' ?>">
            <div class="mb-4">
                <label class="block text-gray-700">Merek Kendaraan:</label>
                <input type="text" name="merk" value="<?= $data['merk'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Pemilik:</label>
                <input type="text" name="pemilik" value="<?= $data['pemilik'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Nopol:</label>
                <input type="text" name="nopol" value="<?= $data['nopol'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Tahun Beli:</label>
                <input type="text" name="tahun_beli" value="<?= $data['tahun_beli'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Deskripsi:</label>
                <input type="text" name="deskripsi" value="<?= $data['deskripsi'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Jenis Kendaraan:</label>
                <select name="jenis_kendaraan_id" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <?php
                    foreach ($rsJenis as $jenis) {
                        $selected = ($data['jenis_kendaraan_id'] ?? '') == $jenis['id'] ? 'selected' : '';
                        echo "<option value='{$jenis['id']}' $selected>{$jenis['nama']}</option>";
                    }
                    ?>
                </select>
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

<?php
// Koneksi ke database
require_once '../../config/dbkoneksi.php';

// Query jenis
$sqlJenis = "SELECT * FROM jenis";
$rsJenis = $dbh->query($sqlJenis);

// Query data pasien jika ada ID
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
</head>
<body class="bg-gray-100 text-gray-800">

<div class="container mx-auto px-4 py-6 max-w-2x1">
    <h2 class="text-2x1 font-bold mb-4"><?= $id ? 'Edit' : 'Tambah' ?>Data Kendaraan</h2>

    <!-- Tombol Kembali -->
     <a href="list.php" class="inline-block mb-4 text-blue-600 hover:underline">← Kembali ke Daftar Kendaraan</a>

     <!-- Formulir -->
    <form method="POST" action="proses.php" class="bg-white shdow-md rounded px-8 pt-6 pb-8 mb-4">
        <input type="hidden" name="id_edit" value="<?= $data['id'] ?? '' ?>">

        <div class="mb-4">
            <label class="block text-gray-700">Merek Kendaraan:</label>
            <input type="text" name="merk" value="<?= $data['merk'] ?? '' ?>" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Pemilik:</label>
            <input type="textarea" name="pemilik" value="<?= $data['pemilik'] ?? '' ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Nopol:</label>
            <input type="text" name="nopol" value="<?= $data['nopol'] ?? '' ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Tahun Beli:</label>
            <input type="text" name="tahun_beli" value="<?= $data['tahun_beli'] ?? '' ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Deskripsi:</label>
            <input type="text" name="deskripsi" value="<?= $data['deskripsi'] ?? '' ?>">
        </div>

        <label for="">Jenis Kendaraan:</label>
        <select name="jenis_kendaraan_id">
            <?php
                foreach ($rsJenis as $jenis) {
                $selected = ($data['jenis_kendaraan_id'] ?? '') == $jenis['id'] ? 'selected' : '';
                echo "<option value='{$jenis['id']}' $selected>{$jenis['nama']}</option>";
            }?>
        </select>

        <div class="flex justify-between">
            <button type="submit" name="proses" value="<?= $id ? 'Update' : 'Simpan' ?>"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                <?= $id ? 'Update' : 'Simpan' ?>
            </button>
            <a href="list.php" class="text-gray-600 hover:underline mt-2">Batal</a>
        </div>
    </form>
</div>

</body>
</html>

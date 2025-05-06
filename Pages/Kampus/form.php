<?php
// Koneksi ke database
require_once '../../config/dbkoneksi.php';

// Query data pasien jika ada ID
$id = $_GET['id'] ?? '';
$data = [];
if ($id) {
    $sql = "SELECT * FROM kampus WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}


?>
<div>
    <h2><?= $id ? 'Edit' : 'Tambah' ?>Data Kampus</h2>

    <!-- Tombol Kembali -->
     <a href="list.php">← Kembali ke Daftar Kampus</a>

     <!-- Formulir -->
    <form method="POST" action="proses.php">
        <input type="hidden" name="id_edit" value="<?= $data['id'] ?? '' ?>">

        <div>
            <label>Nama Kampus:</label>
            <input type="text" name="nama" value="<?= $data['nama'] ?? '' ?>">
        </div>

        <div>
            <label>Alamat:</label>
            <input type="textarea" name="alamat" value="<?= $data['alamat'] ?? '' ?>">
        </div>

        <div>
            <label>Latitude:</label>
            <input type="text" name="latitude" value="<?= $data['latitude'] ?? '' ?>">
        </div>

        <div>
            <label>Longtitude:</label>
            <input type="text" name="longtitude" value="<?= $data['longtitude'] ?? '' ?>">
        </div>

        <div>
            <button type="submit" name="proses" value="<?= $id ? 'Update' : 'Simpan' ?>">
                <?= $id ? 'Update' : 'Simpan' ?>
            </button>
            <a href="list.php">Batal</a>
        </div>
    </form>
</div>



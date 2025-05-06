<?php 

// Include Database
require_once '../../config/dbkoneksi.php';

// Query
$id = $_GET['id'] ?? '';
$data = [];
if ($id) {
    $sql = "SELECT * FROM jenis WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>


<h2><?= $id ? 'Edit' : 'Tambah' ?>Data Jenis</h2>

<!-- Tombol Kembali -->
 <a href="list_jenis.php"><- Kembali ke Daftar Jenis</a>

 <!-- Formulir -->
  <form action="proses_jenis.php" method="POST">
    <input type="hidden" name="id_edit" value="<?= $data['id'] ?? '' ?>">

    <div>
        <label for="">Jenis Kendaraan</label>
        <input type="text" name="nama" value="<?= $data['nama'] ?? '' ?>">
    </div>

    <div>
        <button type="submit" name="proses" value="<?= $id ? 'Update' : 'Simpan' ?>">
            <?= $id ? 'Update' : 'Simpan' ?>
        </button>
        <a href="list_jenis.php">Batal</a>
    </div>
  </form>
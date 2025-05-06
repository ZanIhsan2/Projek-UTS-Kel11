<?php
// Koneksi ke database
require_once '../../config/dbkoneksi.php';

// Query data area_parkir jika ada ID
$id = $_GET['id'] ?? '';
$data = [];
if ($id) {
    $sql = "SELECT * FROM area_parkir WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Ambil daftar kampus dari database
$sqlKampus = "SELECT id, nama FROM kampus";
$stmtKampus = $dbh->query($sqlKampus);
$kampusList = $stmtKampus->fetchAll(PDO::FETCH_ASSOC);
?>

<div>
    <h2><?= $id ? 'Edit' : 'Tambah' ?> Data Area Parkir</h2>

    <!-- Tombol Kembali -->
    <a href="list_area.php">← Kembali ke Daftar Area Parkir</a>

    <!-- Formulir -->
    <form method="POST" action="proses_area.php">
        <input type="hidden" name="id_edit" value="<?= $data['id'] ?? '' ?>">

        <div>
            <label>Nama Parkiran:</label>
            <input type="text" name="nama" value="<?= $data['nama'] ?? '' ?>" required>
        </div>

        <div>
            <label>Kapasitas:</label>
            <input type="number" name="kapasitas" value="<?= $data['kapasitas'] ?? '' ?>" required>
        </div>

        <div>
            <label>Keterangan:</label>
            <input type="text" name="keterangan" value="<?= $data['keterangan'] ?? '' ?>">
        </div>

        <div>
            <label>Kampus:</label>
            <select name="kampus_id" required>
                <option value="">-- Pilih Kampus --</option>
                <?php foreach ($kampusList as $kampus): ?>
                    <option value="<?= $kampus['id'] ?>" 
                        <?= ($data['kampus_id'] ?? '') == $kampus['id'] ? 'selected' : '' ?>>
                        <?= $kampus['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <button type="submit" name="proses" value="<?= $id ? 'Update' : 'Simpan' ?>">
                <?= $id ? 'Update' : 'Simpan' ?>
            </button>
            <a href="list_area.php">Batal</a>
        </div>
    </form>
</div>

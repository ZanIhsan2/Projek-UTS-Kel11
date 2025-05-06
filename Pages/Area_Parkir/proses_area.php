<?php
require_once '../../config/dbkoneksi.php';

// Tangkap data dati Form
$_nama = $_POST['nama'] ?? '';
$_kapasitas = $_POST['kapasitas'] ?? '';
$_keterangan = $_POST['keterangan'] ?? '';
$_kampus = $_POST['kampus_id'] ?? '';
$_proses = $_POST['proses'] ?? '';

// Fungsi Untuk Create, Update dan Delete
if ($_proses == "Simpan") {
    $sql = "INSERT INTO area_parkir (nama, kapasitas, keterangan, kampus_id)
            VALUES (?, ?, ?, ?)";
    $ar_data = [$_nama, $_kapasitas, $_keterangan, $_kampus];
} elseif ($_proses == "Update") {
    $id_edit = $_POST['id_edit'] ?? NULL;
    $sql = "UPDATE area_parkir SET nama=?, kapasitas=?, keterangan=?, kampus_id=? WHERE id=?";
    $ar_data = [$_nama, $_kapasitas, $_keterangan, $_kampus, $id_edit];
} elseif (isset($_GET['hapus']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM area_parkir WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    header("Location: list_area.php");
    exit;
} else {
    die("Proses tidak diketahui.");
}

// Jalankan query
$stmt = $dbh->prepare($sql);
$stmt->execute($ar_data);

// Redirect ke index
header("Location: list_area.php");
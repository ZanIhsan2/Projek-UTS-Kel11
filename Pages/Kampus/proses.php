<?php
require_once '../../config/dbkoneksi.php';

// Tangkap data dati Form
$_nama = $_POST['nama'] ?? '';
$_alamat = $_POST['alamat'] ?? '';
$_latitude = $_POST['latitude'] ?? '';
$_longtitude = $_POST['longtitude'] ?? '';
$_proses = $_POST['proses'] ?? '';

if ($_proses == "Simpan") {
    $sql = "INSERT INTO kampus (nama, alamat, latitude, longtitude)
            VALUES (?, ?, ?, ?)";
    $ar_data = [$_nama, $_alamat, $_latitude, $_longtitude];
} elseif ($_proses == "Update") {
    $id_edit = $_POST['id_edit'] ?? NULL;
    $sql = "UPDATE kampus SET nama=?, alamat=?, latitude=?, longtitude=? WHERE id=?";
    $ar_data = [$_nama, $_alamat, $_latitude, $_longtitude, $_id_edit];
} elseif (isset($_GET['hapus']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM kampus WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    header("Location: list.php");
    exit;
} else {
    die("Proses tidak diketahui.");
}

// Jalankan query
$stmt = $dbh->prepare($sql);
$stmt->execute($ar_data);

// Redirect ke index
header("Location: list.php");
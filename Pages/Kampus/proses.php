<?php
require_once '../../config/dbkoneksi.php';

// Tangkap data dari form
$id_edit = $_POST['id_edit'] ?? null;
$nama = $_POST['nama'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$latitude = $_POST['latitude'] ?? 0;
$longtitude = $_POST['longtitude'] ?? 0; // <- perbaiki di sini
$proses = $_POST['proses'] ?? '';
$id_hapus = $_GET['hapus'] ?? null;

if ($proses === 'Simpan') {
    // Proses INSERT
    $sql = "INSERT INTO kampus (nama, alamat, latitude, longtitude) VALUES (?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nama, $alamat, $latitude, $longtitude]);

} elseif ($proses === 'Update' && $id_edit) {
    // Proses UPDATE
    $sql = "UPDATE kampus SET nama = ?, alamat = ?, latitude = ?, longtitude = ? WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nama, $alamat, $latitude, $longtitude, $id_edit]);

} elseif ($id_hapus) {
    // Proses DELETE
    $sql = "DELETE FROM kampus WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id_hapus]);
}

// Redirect kembali ke halaman list
header('Location: list.php');
exit;

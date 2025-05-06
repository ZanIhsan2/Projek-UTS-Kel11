<?php
require_once '../../config/dbkoneksi.php';

// Tangkap data dati Form
$_merk = $_POST['merk'] ?? '';
$_pemilik = $_POST['pemilik'] ?? '';
$_nopol = $_POST['nopol'] ?? '';
$_thn_beli = $_POST['tahun_beli'] ?? '';
$_deskripsi = $_POST['deskripsi'] ?? '';
$_jenis = $_POST['jenis_kendaraan_id'] ?? '';
$_proses = $_POST['proses'] ?? '';

if ($_proses == "Simpan") {
    $sql = "INSERT INTO kendaraan (merk, pemilik, nopol, tahun_beli, deskripsi, jenis_kendaraan_id)
            VALUES (?, ?, ?, ?, ?, ?)";
    $ar_data = [$_merk, $_pemilik, $_nopol, $_thn_beli, $_deskripsi, $_jenis];
} elseif ($_proses == "Update") {
    $id_edit = $_POST['id_edit'] ?? NULL;
    $sql = "UPDATE kendaraan SET merk=?, pemilik=?, nopol=?, tahun_beli=?, deskripsi=?, jenis_kendaraan_id=? WHERE id=?";
    $ar_data = [$_merk, $_pemilik, $_nopol, $_thn_beli, $_deskripsi, $_jenis, $id_edit];
} elseif (isset($_GET['hapus']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM kendaraan WHERE id = ?";
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
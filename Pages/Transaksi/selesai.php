<?php
include "../../config/dbkoneksi.php";
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $jam_keluar = $_POST['jam_keluar'];
    $tanggal = date('Y-m-d');

    $stmt = $dbh->prepare("SELECT mulai FROM transaksi WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();

    if (!$data) {
        $_SESSION['notif'] = "Transaksi tidak ditemukan.";
        header("Location: list.php");
        exit();
    }

    $jam_masuk = strtotime($data['mulai']);
    $jam_keluar_time = strtotime($jam_keluar);

    $durasi = ($jam_keluar_time - $jam_masuk) / 3600; // durasi jam
    $durasi = ceil($durasi); // pembulatan ke atas

    $biaya = 5000; // harga dasar
    if ($durasi > 3) {
        $biaya += ($durasi - 3) * 2000; // denda per jam lewat 3 jam
    }

    $stmt = $dbh->prepare("UPDATE transaksi SET akhir = ?, keterangan = 'Selesai', biaya = ? WHERE id = ?");
    $stmt->execute([$jam_keluar, $biaya, $id]);

    $_SESSION['notif'] = "Transaksi berhasil diselesaikan. Biaya: Rp" . number_format($biaya,0,",",".");
    header("Location: list.php");
    exit();
}else{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        // Hapus data berdasarkan ID
        $stmt = $dbh->prepare("DELETE FROM transaksi WHERE id = ?");
        $stmt->execute([$id]);
    
        // Setelah hapus, kembali ke list
        header("Location: list.php");
        exit();
    } else {
        echo "ID tidak ditemukan!";
    }
}
?>
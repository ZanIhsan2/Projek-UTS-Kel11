<?php 

// Koneksi Database
require_once '../../config/dbkoneksi.php';

// Query Untuk Form
$nama = $_POST['nama'] ?? '';
$proses = $_POST['proses'] ?? '';

        // Fungsi Untuk Create, Update dan Delete
        if ($proses == 'Simpan') {
            $sql = "INSERT INTO jenis (nama) VALUES (?)";
            $ar_data = [$nama];
        } elseif ($proses == 'Update') {
            $id_edit = $_POST['id_edit'] ?? '';
            $sql = "UPDATE jenis SET nama = ? WHERE id = ?";
            $ar_data = [$nama, $id_edit];
        } elseif (isset($_GET['hapus']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM jenis WHERE id = ?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$id]);
            header("Location: list_jenis.php");
            exit;
        } else {
            die("Proses tidak diketahui");
        }
        // Jalankan Query
        $stmt = $dbh->prepare($sql);
        $stmt->execute($ar_data);

        // Redirect Ke List
        header("Location: list_jenis.php");
?>
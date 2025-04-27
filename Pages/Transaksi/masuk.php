<?php
include "../../config/dbkoneksi.php";
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nopol = $_POST['nopol'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $jam_masuk = $_POST['jam_masuk'];
    $tanggal = date('Y-m-d');

    $stmt = $dbh->prepare("SELECT id FROM kendaraan WHERE nopol = ?");
    $stmt->execute([$nopol]);
    $kendaraan = $stmt->fetch();

    if ($kendaraan) {
        $kendaraan_id = $kendaraan['id'];
    } else {
        $jenis_id = ($jenis_kendaraan == 'motor') ? 1 : (($jenis_kendaraan == 'mobil') ? 2 : 3);

        $stmt = $dbh->prepare("INSERT INTO kendaraan (merk, pemilik, nopol, thn_beli, deskripsi, jenis_kendaraan_id) 
                               VALUES ('-', '-', ?, 0, '-', ?)");
        $stmt->execute([$nopol, $jenis_id]);
        $kendaraan_id = $dbh->lastInsertId();
    }

    $stmt = $dbh->query("SELECT id FROM area_parkir LIMIT 1");
    $area = $stmt->fetch();
    if ($area) {
        $area_parkir_id = $area['id'];
    } else {
        die('Tidak ada area parkir tersedia.');
    }


    $stmt = $dbh->prepare("INSERT INTO transaksi (tanggal, masuk, keluar, keterangan, biaya, kendaraan_id, area_parkir_id) 
                           VALUES (?, ?, NULL, 'Belum Selesai', 0, ?, ?)");
    $stmt->execute([$tanggal, $jam_masuk, $kendaraan_id, $area_parkir_id]);

    $_SESSION['notif'] = "Kendaraan berhasil masuk!";
    header("Location: masuk_kendaraan.php");
    exit();
}
?>

<h1>Parkiran Management</h1> <hr>
<h3>Form Masuk Kendaraan</h3>

<?php if (!empty($_SESSION['notif'])): ?>
    <div class="alert alert-success"><?= $_SESSION['notif']; unset($_SESSION['notif']); ?></div>
<?php endif; ?>

<form method="POST">

    <div>
        <a href="list.php"><- Kembali</a>
    </div>

    <div class="mb-3">
        <label>No Kendaraan</label>
        <input type="text" name="nopol" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" class="form-control" required>
            <option value="mobil">Mobil</option>
            <option value="sepeda motor">Sepeda Motor</option>
            <option value="sepeda">Sepeda</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Jam Masuk</label>
        <input type="time" name="jam_masuk" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>